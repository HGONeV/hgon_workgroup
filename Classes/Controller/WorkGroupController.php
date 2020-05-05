<?php
namespace HGON\HgonWorkgroup\Controller;

/***
 *
 * This file is part of the "HGON WorkGroup" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2019 Maximilian Fäßler <maximilian@faesslerweb.de>, Fäßler Web UG
 *
 ***/
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use RKW\RkwEvents\Helper\DivUtility;
use \RKW\RkwBasics\Helper\Common;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * WorkGroupController
 */
class WorkGroupController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * workGroupRepository
     *
     * @var \HGON\HgonWorkgroup\Domain\Repository\WorkGroupRepository
     * @inject
     */
    protected $workGroupRepository = null;

    /**
     * eventRepository
     *
     * @var \HGON\HgonWorkgroup\Domain\Repository\EventRepository
     * @inject
     */
    protected $eventRepository = null;

    /**
     * newsRepository
     *
     * @var \HGON\HgonWorkgroup\Domain\Repository\NewsRepository
     * @inject
     */
    protected $newsRepository = null;

    /**
     * action list
     *
     * @param integer $searchTerm
     * @return void
     */
    public function listAction($searchTerm = null)
    {
        if (!$searchTerm) {
            // if called by search-plugin
            $request = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_hgonworkgroup_search');
            if (is_array($request) && array_key_exists('searchTerm', $request)) {
                $searchTerm = intval($request['searchTerm']);
            }
        }

        if ($searchTerm) {
            $workGroup = $this->workGroupRepository->findOneByZip($searchTerm);
            // if $searchTerm is set and something was found -> redirect to view
            if ($workGroup) {
                $this->redirect('show', null, null, array('workGroup' => $workGroup), $this->settings['showPid']);
                //===
            }

            // if no workGroup was found: A message will be shown via template

        } else {
            $this->view->assign('workGroupList', $this->workGroupRepository->findAll());
        }
    }



    /**
     * action show
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup
     * @ignorevalidation $workGroup
     * @return void
     */
    public function showAction(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup)
    {
        $this->view->assign('workGroup', $workGroup);

        $rkwEventsSettings = $this->getRkwEventsSettings();
        // workaround: Add RkwEvents showPid for event link building
        $this->view->assign('showPid', $rkwEventsSettings['showPid']);

        $stdEventToShow = [];
        /** @var \HGON\HgonWorkgroup\Domain\Model\Event $stdEvent */
        $stdEventIter = 0;
        foreach ($workGroup->getStdEvent() as $stdEvent) {
            // show until two months but minimum two items
            if (
                $stdEvent->getStart() > time()
                && $stdEvent->getStart() < date("Y-m-d", strtotime("+2 months")) || $stdEventIter < 2
            ) {
                $stdEventToShow[] = $stdEvent;
            }
            $stdEventIter++;
        }
        $this->view->assign('sortedEventList', DivUtility::groupEventsByMonth($stdEventToShow));

        $wgEventToShow = [];
        /** @var \HGON\HgonWorkgroup\Domain\Model\Event $wgEvent */
        $wgEventIter = 0;
        foreach ($workGroup->getWgEvent() as $wgEvent) {
            // show until two months but minimum two items
            if (
                $wgEvent->getStart() > time()
                && $wgEvent->getStart() < date("Y-m-d", strtotime("+2 months"))  || $wgEventIter < 2
            ) {
                $wgEventToShow[] = $wgEvent;
            }
            $wgEventIter++;
        }
        $this->view->assign('sortedWorkgroupEventList', DivUtility::groupEventsByMonth($wgEventToShow));
    }



    /**
     * action header
     * Template helper
     *
     * @return void
     */
    public function headerAction()
    {

        $getParams = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_hgonworkgroup_detail');

        $workGroupUid = preg_replace('/[^0-9]/', '', $getParams['workGroup']);
        $workGroup = $this->workGroupRepository->findByIdentifier(filter_var($workGroupUid, FILTER_SANITIZE_NUMBER_INT));

        $this->view->assign('workGroup', $workGroup);
    }



    /**
     * action sidebar
     * Template helper
     *
     * @return void
     */
    public function sidebarAction()
    {

        $getParams = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_hgonworkgroup_detail');

        $workGroupUid = preg_replace('/[^0-9]/', '', $getParams['workGroup']);
        $workGroup = $this->workGroupRepository->findByIdentifier(filter_var($workGroupUid, FILTER_SANITIZE_NUMBER_INT));

        $this->view->assign('workGroup', $workGroup);
        $this->view->assign('newsList', $this->newsRepository->findByFilter([], [$workGroup]));
    }



    /**
     * action search
     *
     * @return void
     */
    public function searchAction()
    {
        // do nothing special here. Just show the search form
    }



    /**
     * Returns TYPO3 settings
     *
     * @param string $which Which type of settings will be loaded
     * @return array
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    protected function getRkwEventsSettings($which = ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS)
    {
        return Common::getTyposcriptConfiguration('Rkwevents', $which);
        //===
    }
}
