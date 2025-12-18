<?php
defined('TYPO3') or die("Access denied.");

call_user_func(
    function($extKey)
    {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'List',
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'list'
            ],
            // non-cacheable actions
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'list'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'Detail',
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'show'
            ],
            // non-cacheable actions
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'show'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'Header',
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'header'
            ],
            // non-cacheable actions
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'header'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'Sidebar',
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'sidebar'
            ],
            // non-cacheable actions
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'sidebar'
            ]
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            $extKey,
            'Search',
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'search'
            ],
            // non-cacheable actions
            [
                \HGON\HgonWorkgroup\Controller\WorkGroupController::class => 'search'
            ]
        );



        // Hooks
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['typo3/class.db_list_extra.inc']['getTable'][] = \HGON\HgonWorkgroup\Hooks\WorkGroupListHook::class;



    },
    'hgon_workgroup'
);

