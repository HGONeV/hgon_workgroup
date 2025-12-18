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
use \HGON\HgonTemplate\Utility\Common;
use \TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * WorkGroupController
 */
class WorkGroupController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \HGON\HgonWorkgroup\Domain\Repository\WorkGroupRepository
     */
    protected $workGroupRepository;

    /**
     * @var \HGON\HgonWorkgroup\Domain\Repository\EventRepository
     */
    protected $eventRepository;

    /**
     * @var \HGON\HgonWorkgroup\Domain\Repository\NewsRepository
     */
    protected $newsRepository;

    /**
     * @param \HGON\HgonWorkgroup\Domain\Repository\WorkGroupRepository $workGroupRepository
     */
    public function injectWorkGroupRepository(\HGON\HgonWorkgroup\Domain\Repository\WorkGroupRepository $workGroupRepository): void {
        $this->workGroupRepository = $workGroupRepository;
    }

    /**
     * @param \HGON\HgonWorkgroup\Domain\Repository\EventRepository $eventRepository
     */
    public function injectEventRepository(\HGON\HgonWorkgroup\Domain\Repository\EventRepository $eventRepository): void {
        $this->eventRepository = $eventRepository;
    }

    /**
     * @param \HGON\HgonWorkgroup\Domain\Repository\NewsRepository $newsRepository
     */
    public function injectNewsRepository(\HGON\HgonWorkgroup\Domain\Repository\NewsRepository $newsRepository): void {
        $this->newsRepository = $newsRepository;
    }

    /**
     * action list
     *
     * @param integer $searchTerm
     * @return \Psr\Http\Message\ResponseInterface
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
            }

            // if no workGroup was found: A message will be shown via template

        } else {
            $this->view->assign('workGroupList', $this->workGroupRepository->findAll());
        }

        return $this->htmlResponse();
    }



    /**
     * action show
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup
     * @TYPO3\CMS\Extbase\Annotation\IgnoreValidation("workGroup")
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function showAction(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup)
    {
        $this->view->assign('workGroup', $workGroup);

        return $this->htmlResponse();

        /*
        $rkwEventsSettings = $this->getRkwEventsSettings();
        // workaround: Add RkwEvents showPid for event link building
        $this->view->assign('showPid', $rkwEventsSettings['showPid']);

        $stdEventToShow = [];
        // @var \HGON\HgonWorkgroup\Domain\Model\Event $stdEvent
        $stdEventIter = 0;
        foreach ($workGroup->getStdEvent() as $stdEvent) {
            // show until two months but minimum two items
            if (
                $stdEvent->getStart() > time()
                && $stdEvent->getStart() < strtotime(date("Y-m-d", strtotime("+2 months")))
            ) {

                $stdEventToShow[] = $stdEvent;
            }
            $stdEventIter++;
        }
        $this->view->assign('sortedEventList', DivUtility::groupEventsByMonth($stdEventToShow));


        $wgEventToShow = [];
        // @var \HGON\HgonWorkgroup\Domain\Model\Event $wgEvent
        $wgEventIter = 0;
        foreach ($workGroup->getWgEvent() as $wgEvent) {
            // show until two months but minimum two items
            if (
                $wgEvent->getStart() > time()
                && $wgEvent->getStart() < strtotime(date("Y-m-d", strtotime("+2 months")))
            ) {
                $wgEventToShow[] = $wgEvent;
            }
            $wgEventIter++;
        }
        $this->view->assign('sortedWorkgroupEventList', DivUtility::groupEventsByMonth($wgEventToShow));
        */
    }



    /**
     * action header
     * Template helper
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function headerAction()
    {
        $getParams = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_hgonworkgroup_detail');
        // Key kann fehlen oder null sein → sauber abfangen
        $raw = (string)($getParams['workGroup'] ?? '');
        // nur Ziffern behalten
        $workGroupUid = (int)preg_replace('/\D+/', '', $raw);
        $workGroup = $this->workGroupRepository->findByIdentifier(filter_var($workGroupUid, FILTER_SANITIZE_NUMBER_INT));

        $this->view->assign('workGroup', $workGroup);

        return $this->htmlResponse();
    }



    /**
     * action sidebar
     * Template helper
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sidebarAction()
    {
        $getParams = \TYPO3\CMS\Core\Utility\GeneralUtility::_GP('tx_hgonworkgroup_detail');


        // fehlenden oder null-Wert robust abfangen
        $raw = (string)($getParams['workGroup'] ?? '');

        // nur Ziffern behalten, anschließend sauber als int
        $workGroupUid = (int)preg_replace('/\D+/', '', $raw);
        $workGroup = $this->workGroupRepository->findByIdentifier(filter_var($workGroupUid, FILTER_SANITIZE_NUMBER_INT));

        $this->view->assign('workGroup', $workGroup);
        // only if workGroup is also set
        if ($workGroup instanceof \HGON\HgonWorkgroup\Domain\Model\WorkGroup) {
            $this->view->assign('newsList', $this->newsRepository->findByFilter([], [$workGroup], [], 1, 20));
        }

        $this->view->assign('settingsHgonTemplate', $this->getHgonTemplateSettings());

        return $this->htmlResponse();
    }



    /**
     * action search
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function searchAction()
    {
        // do nothing special here. Just show the search form

        return $this->htmlResponse();
    }


    /**
     * Returns TYPO3 settings
     *
     * @param string $which Which type of settings will be loaded
     * @return array
     * @throws \TYPO3\CMS\Extbase\Configuration\Exception\InvalidConfigurationTypeException
     */
    protected function getHgonTemplateSettings($which = ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS)
    {
        return Common::getTyposcriptConfiguration('Hgontemplate', $which);
    }
}
