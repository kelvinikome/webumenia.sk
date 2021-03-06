<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Language Lines for autor.blade.php template
    |--------------------------------------------------------------------------
    */

    'artworks'    => '{0}    <a href=":artworks_url"><strong>:artworks_count</strong></a> artworks
                     |{1}    <a href=":artworks_url"><strong>:artworks_count</strong></a> artwork
                     |[2,Inf]<a href=":artworks_url"><strong>:artworks_count</strong></a> artworks',
    'collections' => '{0}    in <strong>:collections_count</strong> collections
                     |{1}    in <strong>:collections_count</strong> collection
                     |[2,Inf]in <strong>:collections_count</strong> collections',
    'views'       => '{0}    <strong>:view_count</strong> views
                     |{1}    <strong>:view_count</strong> view
                     |[2,Inf]<strong>:view_count</strong> views',
    
    'tags'              => 'tags',
    'back-to-artists'   => 'back to artists page',
    'alternative_names' => 'alternatively',
    'places'            => 'has been active in',
    'links'             => 'external links',
    'relationships'     => 'relationships',
    
    'artworks_by_artist' => 'artworks by this artist',
    
    'button_show-all-artworks' => '{0}    show <strong>0</strong> artworks
                                  |{1}    show <strong>1</strong> artwork
                                  |[2,Inf]show all <strong>:artworks_count</strong> artworks',
);
