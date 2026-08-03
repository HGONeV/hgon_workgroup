<?php

namespace HGON\HgonWorkgroup\Domain\Model;

use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Event extends \DERHANSEN\SfEventMgt\Domain\Model\Event
{
    /**
     * @var ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\WorkGroup>
     */
    protected ObjectStorage $txHgonWorkgroup;

    public function initializeObject(): void
    {
        parent::initializeObject();
        $this->txHgonWorkgroup = new ObjectStorage();
    }

    public function addTxHgonWorkgroup(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup): void
    {
        $this->txHgonWorkgroup->attach($workGroup);
    }

    public function removeTxHgonWorkgroup(\HGON\HgonWorkgroup\Domain\Model\WorkGroup $workGroup): void
    {
        $this->txHgonWorkgroup->detach($workGroup);
    }

    public function getTxHgonWorkgroup(): ObjectStorage
    {
        return $this->txHgonWorkgroup;
    }

    public function setTxHgonWorkgroup(ObjectStorage $workGroups): void
    {
        $this->txHgonWorkgroup = $workGroups;
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
