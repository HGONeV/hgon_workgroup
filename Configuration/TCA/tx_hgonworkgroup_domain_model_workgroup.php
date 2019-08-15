<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup',
        'label' => 'title',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,description,short_description,address,zip,city,district,contact_person,wg_event,std_event,tx_news',
        'iconfile' => 'EXT:hgon_workgroup/Resources/Public/Icons/tx_hgonworkgroup_domain_model_workgroup.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, short_description, address, zip, city, district, contact_person, wg_event, std_event, tx_news',
    ],
    'types' => [
        '1' => [
            'showitem' => '
            sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, description, short_description, address, zip, city, district, contact_person, 
            --div--;LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.tab_stdevents,
            std_event,
            --div--;LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.tab_wgevents,
            wg_event,
             --div--;LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.tab_news,
            tx_news
            '
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'special' => 'languages',
                'items' => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages',
                        -1,
                        'flags-multiple'
                    ]
                ],
                'default' => 0,
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_hgonworkgroup_domain_model_workgroup',
                'foreign_table_where' => 'AND tx_hgonworkgroup_domain_model_workgroup.pid=###CURRENT_PID### AND tx_hgonworkgroup_domain_model_workgroup.sys_language_uid IN (-1,0)',
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        '0' => 'LLL:EXT:lang/Resources/Private/Language/locallang_core.xlf:labels.enabled'
                    ]
                ],
            ],
        ],

        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            
        ],
        'short_description' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.short_description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'address' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.address',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'zip' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.zip',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'city' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.city',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'district' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.district',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'contact_person' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.contact_person',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_rkwauthors_domain_model_authors',
                'foreign_table_where' => 'AND tx_rkwauthors_domain_model_authors.deleted = 0 AND tx_rkwauthors_domain_model_authors.hidden = 0 ORDER BY tx_rkwauthors_domain_model_authors.last_name ASC',
                'maxitems'      => 3,
                'minitems' 		=> 0,
                'size'          => 5,
            ],

        ],
        'wg_event' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.event',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_rkwevents_domain_model_event',
                'foreign_field' => 'tx_hgon_workgroup_wgevent',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        'std_event' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.event',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_rkwevents_domain_model_event',
                'foreign_field' => 'tx_hgon_workgroup_stdevent',
                'maxitems' => 9999,
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        /*
        'tx_news' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.news',
            'config' => [

                'type' => 'inline',
                'foreign_table' => 'tx_news_domain_model_news',
                'MM' => 'tx_hgonworkgroup_domain_model_workgroup_news_mm',
                'maxitems' => 9999,
                'minitems' => 0,
                'multiple' => 1,
                //'foreign_table_where' => ' AND (tx_news_domain_model_tag.sys_language_uid IN (-1,0) OR tx_news_domain_model_tag.l10n_parent = 0) ORDER BY tx_news_domain_model_tag.title',

                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1
                ],
            ],
        ],
        */
    ],
];
