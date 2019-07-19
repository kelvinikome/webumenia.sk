<?php

namespace App;

use App\Repositories\AuthorityRepository;
use App\Repositories\ItemRepository;

class Subtitle
{
    protected $itemRepository;

    protected $authorityRepository;

    public function __construct(
        ItemRepository $itemRepository,
        AuthorityRepository $authorityRepository
    ) {
        $this->itemRepository = $itemRepository;
        $this->authorityRepository = $authorityRepository;
    }

    public function random()
    {
        $choices = [
            ['intro.from_galleries_start', 'intro.from_galleries_end', route('info'), 9],
            ['intro.from_galleries_start', 'intro.from_authors_end', route('author.index'), $this->authorityRepository->count()],
            ['intro.in_high_res_start', 'intro.in_high_res_end', route('catalog.index', ['has_iip' => true]), $this->itemRepository->count(['has_iip' => true])],
            ['intro.are_free_start', 'intro.are_free_end', route('catalog.index', ['is_free' => true]), $this->itemRepository->count(['is_free' => true])],
        ];

        $choice = $choices[array_rand($choices)];
        $choice[0] = trans($choice[0]);
        $choice[1] = trans($choice[1]);
        $choice[3] = formatNum($choice[3]);

        return vsprintf('%1$s <strong><a href="%3$s">%4$s</a></strong> %2$s', $choice);
    }
}
