<?php
namespace HGON\HgonWorkgroup\Domain\Model;

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

/**
 * WorkGroup
 */
class WorkGroup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * description
     *
     * @var string
     */
    protected $description = '';

    /**
     * shortDescription
     *
     * @var string
     */
    protected $shortDescription = '';

    /**
     * address
     *
     * @var string
     */
    protected $address = '';

    /**
     * zip
     *
     * @var string
     */
    protected $zip = '';

    /**
     * city
     *
     * @var string
     */
    protected $city = '';

    /**
     * district
     *
     * @var string
     */
    protected $district = '';

    /**
     * contactPerson
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Authors>
     * @cascade remove
     */
    protected $contactPerson = null;

    /**
     * wgEvent
     * (workGroupEvent)
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Event>
     * @cascade remove
     */
    protected $wgEvent = null;

    /**
     * stdEvent
     * (standardEvent)
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Event>
     * @cascade remove
     */
    protected $stdEvent = null;

    /**
     * txNews
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\News>
     * @cascade remove
     */
    protected $txNews = null;

    /**
     * __construct
     */
    public function __construct()
    {
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
        $this->contactPerson = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->wgEvent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->stdEvent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->txNews = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Sets the description
     *
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Returns the shortDescription
     *
     * @return string $shortDescription
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Sets the shortDescription
     *
     * @param string $shortDescription
     * @return void
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * Returns the address
     *
     * @return string $address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets the address
     *
     * @param string $address
     * @return void
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Returns the district
     *
     * @return string $district
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Sets the district
     *
     * @param string $district
     * @return void
     */
    public function setDistrict($district)
    {
        $this->district = $district;
    }

    /**
     * Adds a Authors
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\Authors $contactPerson
     * @return void
     */
    public function addContactPerson(\HGON\HgonWorkgroup\Domain\Model\Authors $contactPerson)
    {
        $this->contactPerson->attach($contactPerson);
    }

    /**
     * Removes a contactPerson
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\Authors $contactPersonToRemove The Authors to be removed
     * @return void
     */
    public function removeContactPerson(\HGON\HgonWorkgroup\Domain\Model\Authors $contactPersonToRemove)
    {
        $this->contactPerson->detach($contactPersonToRemove);
    }

    /**
     * Returns the contactPerson
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Authors> $contactPerson
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Sets the contactPerson
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Authors> $contactPerson
     * @return void
     */
    public function setContactPerson(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $contactPerson)
    {
        $this->contactPerson = $contactPerson;
    }

    /**
     * Adds a wgEvent
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\Event $wgEvent
     * @return void
     */
    public function addWgEvent(\HGON\HgonWorkgroup\Domain\Model\Event $wgEvent)
    {
        $this->wgEvent->attach($wgEvent);
    }

    /**
     * Removes a wgEvent
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\Event $wgEventToRemove The Event to be removed
     * @return void
     */
    public function removeWgEvent(\HGON\HgonWorkgroup\Domain\Model\Event $wgEventToRemove)
    {
        $this->wgEvent->detach($wgEventToRemove);
    }

    /**
     * Returns the wgEvent
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Event> $wgEvent
     */
    public function getWgEvent()
    {
        return $this->wgEvent;
    }

    /**
     * Sets the wgEvent
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Event> $wgEvent
     * @return void
     */
    public function setWgEvent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $wgEvent)
    {
        $this->wgEvent = $wgEvent;
    }

    /**
     * Adds a stdEvent
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\Event $stdEvent
     * @return void
     */
    public function addStdEvent(\HGON\HgonWorkgroup\Domain\Model\Event $stdEvent)
    {
        $this->stdEvent->attach($stdEvent);
    }

    /**
     * Removes a stdEvent
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\Event $stdEventToRemove The Event to be removed
     * @return void
     */
    public function removeStdEvent(\HGON\HgonWorkgroup\Domain\Model\Event $stdEventToRemove)
    {
        $this->stdEvent->detach($stdEventToRemove);
    }

    /**
     * Returns the stdEvent
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Event> $stdEvent
     */
    public function getStdEvent()
    {
        return $this->stdEvent;
    }

    /**
     * Sets the stdEvent
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\Event> $stdEvent
     * @return void
     */
    public function setStdEvent(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $stdEvent)
    {
        $this->stdEvent = $stdEvent;
    }

    /**
     * Adds a txNews
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\News $txNews
     * @return void
     */
    public function addTxNews(\HGON\HgonWorkgroup\Domain\Model\News $txNews)
    {
        $this->stdEvent->attach($txNews);
    }

    /**
     * Removes a txNews
     *
     * @param \HGON\HgonWorkgroup\Domain\Model\News $txNewsToRemove The News to be removed
     * @return void
     */
    public function removeTxNews(\HGON\HgonWorkgroup\Domain\Model\News $txNewsToRemove)
    {
        $this->stdEvent->detach($txNewsToRemove);
    }

    /**
     * Returns the txNews
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\News> $txNews
     */
    public function getTxNews()
    {
        return $this->txNews;
    }

    /**
     * Sets the txNews
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\HGON\HgonWorkgroup\Domain\Model\News> $txNews
     * @return void
     */
    public function setTxNews(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $txNews)
    {
        $this->txNews = $txNews;
    }
}
