<?php

namespace App\Repositories;

use App\SearchQuery;
use App\SearchResponse;
use Elasticsearch\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class AbstractRepository
{
    /** @var string */
    protected $index;

    /** @var string */
    protected $modelClass;

    public function __construct(Client $elasticsearch) {
        $this->elasticsearch = $elasticsearch;
    }

    public function searchQuery(SearchQuery $query) {
        $response = $this->elasticsearch->search([
            'index' => $this->index,
            'body' => $query->getBody(),
        ]);

        $searchResponse = new SearchResponse(
            $this->elasticToModels($response),
            $response['hits']['total']['value']
        );

        return $searchResponse;
    }

    public function search($from, $size, array $filter = [], array $sort = []) {
        $query = new SearchQuery();
        $query->setSize($size);
        $query->setFilter($filter);
        $query->setSort($sort);

        return $this->searchQuery($query);
    }

    public function getRandom($size, array $filter = []) {
        return $this->search($size, $filter, ['_script' => [
            'script' => 'Math.random() * 200000',
            'type' => 'number',
            'order' => 'asc',
        ]]);
    }

    public function listValues($attribute, SearchQuery $query) {
        $body = $query->getBody();
        $body['aggs'][$attribute]['terms'] = [
            'field' => $attribute,
            'size' => 1000, // ?
        ];

        $response = $this->elasticsearch->search([
            'index' => $this->index,
            'size' => 0,
            'body' => $body,
        ]);

        return $response['aggregations'][$attribute]['buckets'];
    }

    public function count(array $filter = []) {
        $query = new SearchQuery();
        $query->setFilter($filter);

        $response = $this->elasticsearch->count([
            'index' => $this->index,
            'body' => $query->getBody()
        ]);

        return $response['count'];
    }

    protected function elasticToModels(array $response) {
        $models = [];

        foreach ($response['hits']['hits'] as $hit) {
            $models[] = $this->newFromElasticResults($hit);
        }

        return collect($models);
    }

    protected function newFromElasticResults(array $hit) {
        /** @var Model $model */
        $model = new $this->modelClass;
        $model->setRawAttributes($hit['_source'], true);
        return $model;
    }
}