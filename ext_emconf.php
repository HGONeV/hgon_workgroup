<?php

/***************************************************************
 * Extension Manager/Repository config file for ext: "hgon_workgroup"
 *
 * Auto generated by Extension Builder 2019-05-08
 *
 * Manual updates:
 * Only the data in the array - anything else is removed by next write.
 * "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = [
    'title' => 'HGON WorkGroup',
    'description' => 'For managing working groups',
    'category' => 'plugin',
    'author' => 'Maximilian Fäßler',
    'author_email' => 'maximilian@faesslerweb.de',
    'state' => 'alpha',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '8.7.0',
    'constraints' => [
        'depends' => [
            'typo3' => '8.7.0-8.7.99',
            'rkw_authors' => '7.6.13-8.7.99',
            'rkw_events' => '8.7.11-8.7.99',
            'news' => '7.2.0-7.2.99',
            'hgon_template' => '8.7.0-8.7.9'
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
];
