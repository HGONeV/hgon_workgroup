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
use HGON\HgonTemplate\Utility\Common;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * WorkGroupController
 */
class WorkGroupController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected \HGON\HgonWorkgroup\Domain\Repository\WorkGroupRepository $workGroupRepository;

    protected \HGON\HgonWorkgroup\Domain\Repository\EventRepository $eventRepository;

    protected \HGON\HgonWorkgroup\Domain\Repository\NewsRepository $newsRepository;

    public function __construct(
        ?\HGON\HgonWorkgroup\Domain\Repository\WorkGroupRepository $workGroupRepository = null,
        ?\HGON\HgonWorkgroup\Domain\Repository\EventRepository $eventRepository = null,
        ?\HGON\HgonWorkgroup\Domain\Repository\NewsRepository $newsRepository = null
    ) {
        $this->workGroupRepository = $workGroupRepository ?? \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\HGON\HgonWorkgroup\Domain\Repository\WorkGroupRepository::class);
        $this->eventRepository = $eventRepository ?? \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\HGON\HgonWorkgroup\Domain\Repository\EventRepository::class);
        $this->newsRepository = $newsRepository ?? \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\HGON\HgonWorkgroup\Domain\Repository\NewsRepository::class);
    }

    public function injectWorkGroupRepository(\HGON\HgonWorkgroup\Domain\Repository\WorkGroupRepository $workGroupRepository): void
    {
        $this->workGroupRepository = $workGroupRepository;
    }

    public function injectEventRepository(\HGON\HgonWorkgroup\Domain\Repository\EventRepository $eventRepository): void
    {
        $this->eventRepository = $eventRepository;
    }

    public function injectNewsRepository(\HGON\HgonWorkgroup\Domain\Repository\NewsRepository $newsRepository): void
    {
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
            $request = $this->request->getQueryParams()['tx_hgonworkgroup_search'] ?? null;
            if (is_array($request) && array_key_exists('searchTerm', $request)) {
                $searchTerm = intval($request['searchTerm']);
            }
        }

        if ($searchTerm) {
            $workGroup = $this->workGroupRepository->findOneByZip($searchTerm);
            // if $searchTerm is set and something was found -> redirect to view
            if ($workGroup) {
                return $this->redirect('show', null, null, array('workGroup' => $workGroup), $this->settings['showPid']);
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
     * @return \Psr\Http\Message\ResponseInterface
     */
    #[IgnoreValidation(['argumentName' => 'workGroup'])]
    public function showAction(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup)
    {
        $this->view->assign('workGroup', $workGroup);

        return $this->htmlResponse();
    }



    /**
     * action header
     * Template helper
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function headerAction()
    {
        $getParams = $this->request->getQueryParams()['tx_hgonworkgroup_detail'] ?? [];
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
        $getParams = $this->request->getQueryParams()['tx_hgonworkgroup_detail'] ?? [];


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
