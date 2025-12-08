<?php
namespace HGON\HgonWorkgroup\ViewHelpers;
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * CheckDateOfEventListViewHelper
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @copyright HGON
 * @package HGON_HgonWorkgroup
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class CheckDateOfEventListViewHelper extends AbstractViewHelper
{
    /**
     * Checks if minimum one event in list is not expired
     *
     * @param array | \TYPO3\CMS\Extbase\Persistence\ObjectStorage $eventList
     *
     * @return boolean
     */
    public function render($eventList)
    {
        // if minimum one element is not expired, return true
        foreach ($eventList as $event) {

            $date = $event->getEnd() ? $event->getEnd() : $event->getStart();

            /** @var \RKW\RkwEvents\Domain\Model\Event $event */
            if ($date >= time()) {
                return true;
            }
        }

        return false;
    }
}
