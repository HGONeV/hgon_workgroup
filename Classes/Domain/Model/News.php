<?php

namespace HGON\HgonWorkgroup\Domain\Model;
    /*
     * This file is part of the TYPO3 CMS project.
     *
     * It is free software; you can redistribute it and/or modify it under
     * the terms of the GNU General Public License, either version 3
     * of the License, or any later version.
     *
     * For the full copyright and license information, please read the
     * LICENSE.txt file that was distributed with this source code.
     *
     * The TYPO3 project - inspiring people to share!
     */

/**
 * Class News
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @copyright HGON
 * @package HGON_HgonWorkgroup
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class News extends \GeorgRinger\News\Domain\Model\News
{
    /**
     * __construct
     */
    public function __construct()
    {
        parent::__construct();
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->txHgonWorkgroup = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * txHgonWorkgroup
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup>
     */
    protected $txHgonWorkgroup = null;

    /**
     * Adds a $txHgonWorkgroup
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroup
     * @return void
     */
    public function addTxHgonWorkgroup(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroup)
    {
        $this->txHgonWorkgroup->attach($txHgonWorkgroup);
    }

    /**
     * Removes a $txHgonWorkgroup
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\Authors $txHgonWorkgroupToRemove The Authors to be removed
     * @return void
     */
    public function removeTxHgonWorkgroup(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupToRemove)
    {
        $this->txHgonWorkgroup->detach($txHgonWorkgroupToRemove);
    }

    /**
     * Returns the $txHgonWorkgroup
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup> $txHgonWorkgroup
     */
    public function getTxHgonWorkgroup()
    {
        return $this->txHgonWorkgroup;
    }

    /**
     * Sets the $txHgonWorkgroup
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup> $txHgonWorkgroup
     * @return void
     */
    public function setContactPerson(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $txHgonWorkgroup)
    {
        $this->txHgonWorkgroup = $txHgonWorkgroup;
    }


}