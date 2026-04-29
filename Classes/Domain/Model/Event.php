<?php

namespace HGON\HgonWorkgroup\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Event extends \DERHANSEN\SfEventMgt\Domain\Model\Event
{
    /**
     * @var ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup>
     */
    protected ObjectStorage $txHgonWorkgroupStdevent;

    /**
     * @var ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup>
     */
    protected ObjectStorage $txHgonWorkgroupWgevent;

    public function initializeObject(): void
    {
        parent::initializeObject();
        $this->txHgonWorkgroupStdevent = new ObjectStorage();
        $this->txHgonWorkgroupWgevent = new ObjectStorage();
    }

    public function addTxHgonWorkgroupStdevent(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup): void
    {
        $this->txHgonWorkgroupStdevent->attach($workGroup);
    }

    public function removeTxHgonWorkgroupStdevent(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup): void
    {
        $this->txHgonWorkgroupStdevent->detach($workGroup);
    }

    public function getTxHgonWorkgroupStdevent(): ObjectStorage
    {
        return $this->txHgonWorkgroupStdevent;
    }

    public function setTxHgonWorkgroupStdevent(ObjectStorage $workGroups): void
    {
        $this->txHgonWorkgroupStdevent = $workGroups;
    }

    public function addTxHgonWorkgroupWgevent(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup): void
    {
        $this->txHgonWorkgroupWgevent->attach($workGroup);
    }

    public function removeTxHgonWorkgroupWgevent(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup): void
    {
        $this->txHgonWorkgroupWgevent->detach($workGroup);
    }

    public function getTxHgonWorkgroupWgevent(): ObjectStorage
    {
        return $this->txHgonWorkgroupWgevent;
    }

    public function setTxHgonWorkgroupWgevent(ObjectStorage $workGroups): void
    {
        $this->txHgonWorkgroupWgevent = $workGroups;
    }

    public function removeTxHgonWorkgroup(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup): void
    {
        $this->removeTxHgonWorkgroupWgevent($workGroup);
    }

    public function getTxHgonWorkgroup(): ObjectStorage
    {
        return $this->getTxHgonWorkgroupWgevent();
    }

    public function setTxHgonWorkgroup(ObjectStorage $workGroups): void
    {
        $this->setTxHgonWorkgroupWgevent($workGroups);
    }

    public function getStart(): int
    {
        return $this->getStartdate()?->getTimestamp() ?? 0;
    }

    public function getEnd(): int
    {
        return $this->getEnddate()?->getTimestamp() ?? 0;
    }

    public function getPlace(): ?\DERHANSEN\SfEventMgt\Domain\Model\Location
    {
        return $this->getLocation();
    }
}
