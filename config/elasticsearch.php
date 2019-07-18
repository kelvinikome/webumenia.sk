<?php

return [
    'hosts' => [
        sprintf('http://%s:%s', env('ES_HOST', 'localhost'), env('ES_PORT', '9200'))
    ]
];
