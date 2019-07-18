<?php

return [
    'id' => 'ID',
    'title' => 'názov',
    'description' => 'popis',
    'description_source' => 'popis - zdroj',
    'work_type' => 'výtvarný druh',
    'work_level' => 'stupeň spracovania',
    'topic' => 'žáner',
    'subject' => 'objekt',
    'measurement' => 'miery',
    'dating' => 'datovanie',
    'medium' => 'materiál',
    'technique' => 'technika',
    'inscription' => 'značenie',
    'place' => 'geografická oblasť',
    'state_edition' => 'stupeň spracovania',
    'gallery' => 'galéria',
    'relationship_type' => 'typ integrity',
    'related_work' => 'názov integrity',
    'description_user_id' => 'popis - autor',
    'description_source_link' => 'popis - link na zdroj',
    'identifier' => 'inventárne číslo',
    'author' => 'autor',
    'tags' => 'tagy',
    'tag' => 'tag',
    'date_earliest' => 'datovanie najskôr',
    'date_latest' => 'datovanie najneskôr',
    'lat' => 'latitúda',
    'lng' => 'longitúda',
    'related_work_order' => 'poradie',
    'related_work_total' => 'z počtu',
    'primary_image' => 'hlavný obrázok',
    'images' => 'obrázky',
    'iipimg_url' => 'IIP URL',
    'filter' => [
        'year_from' => 'od roku',
        'year_to' => 'do roku',
        'has_image' => 'len s obrázkom',
        'has_iip' => 'len so zoom',
        'is_free' => 'len voľné',
        'color' => 'farba',
        'sort_by' => 'podľa',
        'sorting' => [
            'created_at' => 'dátumu pridania',
            'title' => 'názvu',
            'relevance' => 'relevancie',
            'updated_at' => 'poslednej zmeny',
            'author' => 'autora',
            'newest' => 'datovania – od najnovšieho',
            'oldest' => 'datovania – od najstaršieho',
            'view_count' => 'počtu videní',
        ],
        'title_generator' => [
            'search' => 'výsledky vyhľadávania pre: ":value"',
            'author' => 'autor: :value',
            'work_type' => 'výtvarný druh: :value',
            'tag' => 'tag: :value',
            'gallery' => 'galéria: :value',
            'topic' => 'žáner: :value',
            'medium' => 'materiál: :value',
            'technique' => 'technika: :value',
            'related_work' => 'zo súboru: :value',
            'years' => [
                'from' => 'po :value',
                'to' => 'do :value'
            ],
        ],
    ],
];