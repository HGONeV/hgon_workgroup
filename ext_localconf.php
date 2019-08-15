<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'HGON.HgonWorkgroup',
            'List',
            [
                'WorkGroup' => 'list, show'
            ],
            // non-cacheable actions
            [
                'WorkGroup' => 'list, show'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'HGON.HgonWorkgroup',
            'Search',
            [
                'WorkGroup' => 'search'
            ],
            // non-cacheable actions
            [
                'WorkGroup' => 'search'
            ]
        );

    },
    $_EXTKEY
);

