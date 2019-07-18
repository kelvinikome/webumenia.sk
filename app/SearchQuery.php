<?php


namespace App;


class SearchQuery
{
    /** @var int */
    protected $from;

    /** @var int */
    protected $size;

    /** @var array */
    protected $filter;

    /** @var array */
    protected $sort;

    public function setFrom($from) {
        $this->from = $from;
        return $this;
    }

    public function setSize($size) {
        $this->size = $size;
        return $this;
    }

    public function setFilter(array $filter) {
        $this->filter = $filter;
        return $this;
    }

    public function setSort(array $sort) {
        $this->sort = $sort;
        return $this;
    }

    public function getBody() {
        $body = [];

        if ($this->from !== null) {
            $body['from'] = $this->from;
        }

        if ($this->size !== null) {
            $body['size'] = $this->size;
        }

        if ($this->filter) {
            $body['query']['bool']['filter'] = [];
            foreach ($this->filter as $name => $value) {
                $body['query']['bool']['filter'][] = ['term' => [$name => $value]];
            }
        }

        if ($this->sort) {
            $body['sort'] = $this->sort;
        }

        return $body;
    }
}