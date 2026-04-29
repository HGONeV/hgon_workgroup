<?php

use TYPO3\CMS\Core\Resource\File;

return [
    'ctrl' => [
        'title' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup',
        'label' => 'title',
        'rootLevel' => 0,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'versioningWS' => true,
        'languageField' => 'sys_language_uid',
        'transOrigPointerField' => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'title,description,short_description,address,zip,city,district,bank_institute,bank_iban,bank_bic,image,files,contact_person,wg_event,std_event,tx_news',
        'iconfile' => 'EXT:hgon_workgroup/Resources/Public/Icons/tx_hgonworkgroup_domain_model_workgroup.gif'
    ],
    'types' => [
        '1' => [
            'showitem' => '
            sys_language_uid, l10n_diffsource, hidden, image, files, title, description, short_description, address, zip, city, district, bank_institute, bank_iban, bank_bic, contact_person,
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
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
            'config' => [
                'type' => 'language',
            ],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'default' => 0,
                'items' => [
                    [
                        'label' => '',
                        'value' => 0,
                    ],
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
                    [
                        'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_core.xlf:labels.enabled',
                        'value' => 1,
                    ],
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
        'bank_institute' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.bank_institute',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bank_iban' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.bank_iban',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'bank_bic' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.bank_bic',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'image' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.image',
            'config' => [
                'type' => 'file',
                'allowed' => 'jpg,jpeg,png,gif',
                'minitems' => 0,
                'maxitems' => 1,
                'overrideChildTca' => [
                    'types' => [
                        File::FILETYPE_IMAGE => [
                            'showitem' => '
                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette',
                        ],
                    ],
                ],
            ],
        ],
        'files' => [
            'exclude' => 0,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.files',
            'config' => [
                'type' => 'file',
                'allowed' => 'pdf',
                'minitems' => 0,
                'maxitems' => 9999,
                'overrideChildTca' => [
                    'types' => [
                        File::FILETYPE_APPLICATION => [
                            'showitem' => '
                        --palette--;LLL:EXT:core/Resources/Private/Language/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                        --palette--;;filePalette',
                        ],
                    ],
                ],
            ],
        ],
        'contact_person' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.contact_person',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_mdnewsauthor_domain_model_newsauthor',
                'foreign_table_where' => 'AND tx_mdnewsauthor_domain_model_newsauthor.deleted = 0 AND tx_mdnewsauthor_domain_model_newsauthor.hidden = 0 ORDER BY tx_mdnewsauthor_domain_model_newsauthor.lastname ASC, tx_mdnewsauthor_domain_model_newsauthor.firstname ASC',
                'maxitems'      => 3,
                'minitems' 		=> 0,
                'size'          => 5,
            ],

        ],
        'wg_event' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.event',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_sfeventmgt_domain_model_event',
                'foreign_table_where' => 'AND tx_sfeventmgt_domain_model_event.deleted = 0 AND tx_sfeventmgt_domain_model_event.hidden = 0 ORDER BY tx_sfeventmgt_domain_model_event.startdate ASC, tx_sfeventmgt_domain_model_event.title ASC',
                'maxitems' => 9999,
                'minitems' => 0,
                'size' => 10,
            ],
        ],
        'std_event' => [
            'exclude' => true,
            'label' => 'LLL:EXT:hgon_workgroup/Resources/Private/Language/locallang_db.xlf:tx_hgonworkgroup_domain_model_workgroup.event',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_sfeventmgt_domain_model_event',
                'foreign_table_where' => 'AND tx_sfeventmgt_domain_model_event.deleted = 0 AND tx_sfeventmgt_domain_model_event.hidden = 0 ORDER BY tx_sfeventmgt_domain_model_event.startdate ASC, tx_sfeventmgt_domain_model_event.title ASC',
                'maxitems' => 9999,
                'minitems' => 0,
                'size' => 10,
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
