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
 * Class Event
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @copyright HGON
 * @package HGON_HgonWorkgroup
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Event extends \RKW\RkwEvents\Domain\Model\Event
{
    /**
     * txHgonWorkgroupStdevent
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup>
     */
    protected $txHgonWorkgroupStdevent = null;

    /**
     * txHgonWorkgroupWgevent
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup>
     */
    protected $txHgonWorkgroupWgevent = null;

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
        $this->txHgonWorkgroupStdeventStdevent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->txHgonWorkgroupStdeventWgevent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Adds a $txHgonWorkgroupStdevent
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupStdevent
     * @return void
     */
    public function addTxHgonWorkgroupStdevent(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupStdevent)
    {
        $this->txHgonWorkgroupStdevent->attach($txHgonWorkgroupStdevent);
    }

    /**
     * Removes a $txHgonWorkgroupStdevent
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupStdeventToRemove The Worktpiü to be removed
     * @return void
     */
    public function removeTxHgonWorkgroupStdevent(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupStdeventToRemove)
    {
        $this->txHgonWorkgroupStdevent->detach($txHgonWorkgroupStdeventToRemove);
    }

    /**
     * Returns the $txHgonWorkgroupStdevent
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup> $txHgonWorkgroupStdevent
     */
    public function getTxHgonWorkgroupStdevent()
    {
        return $this->txHgonWorkgroupStdevent;
    }

    /**
     * Sets the $txHgonWorkgroupStdevent
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup> $txHgonWorkgroupStdevent
     * @return void
     */
    public function setTxHgonWorkgroupStdevent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $txHgonWorkgroupStdevent)
    {
        $this->txHgonWorkgroupStdevent = $txHgonWorkgroupStdevent;
    }

    /**
     * Adds a $txHgonWorkgroupWgevent
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupWgevent
     * @return void
     */
    public function addTxHgonWorkgroupWgevent(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupWgevent)
    {
        $this->txHgonWorkgroupWgevent->attach($txHgonWorkgroupWgevent);
    }

    /**
     * Removes a $txHgonWorkgroupWgevent
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupWgeventToRemove The Worktpiü to be removed
     * @return void
     */
    public function removeTxHgonWorkgroup(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $txHgonWorkgroupWgeventToRemove)
    {
        $this->txHgonWorkgroupWgevent->detach($txHgonWorkgroupWgeventToRemove);
    }

    /**
     * Returns the $txHgonWorkgroupWgevent
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup> $txHgonWorkgroupWgevent
     */
    public function getTxHgonWorkgroup()
    {
        return $this->txHgonWorkgroupWgevent;
    }

    /**
     * Sets the $txHgonWorkgroupWgevent
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup> $txHgonWorkgroupWgevent
     * @return void
     */
    public function setTxHgonWorkgroup(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $txHgonWorkgroupWgevent)
    {
        $this->txHgonWorkgroupWgevent = $txHgonWorkgroupWgevent;
    }

}