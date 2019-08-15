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
            if (array_key_exists('searchTerm', $request)) {
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
}
