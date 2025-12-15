<?php
declare(strict_types = 1);

return [
    \HGON\HgonWorkgroup\Domain\Model\Event::class => [
        'tableName' => 'tx_rkwevents_domain_model_event',
    ],

    \HGON\HgonWorkgroup\Domain\Model\Authors::class => [
        'tableName' => 'tx_rkwauthors_domain_model_authors',
    ],

    // News: recordType 0 auf eigenes Model umbiegen
    \GeorgRinger\News\Domain\Model\News::class => [
        'subclasses' => [
            0 => \HGON\HgonWorkgroup\Domain\Model\News::class,
        ],
    ],

    \HGON\HgonWorkgroup\Domain\Model\News::class => [
        'tableName'  => 'tx_news_domain_model_news',
        'recordType' => 0,
    ],
];


