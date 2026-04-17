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
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * CheckDateOfEventListViewHelper
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @copyright HGON
 * @package HGON_HgonWorkgroup
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
final class CheckDateOfEventListViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument(
            'eventList',
            'iterable',
            'Array oder ObjectStorage von Events',
            true
        );
    }

    public function render(): bool
    {
        /** @var iterable $eventList */
        $eventList = $this->arguments['eventList'];

        foreach ($eventList as $event) {
            $date = null;
            if (method_exists($event, 'getEnddate') && method_exists($event, 'getStartdate')) {
                $date = $event->getEnddate() ?: $event->getStartdate();
                if ($date instanceof \DateTimeInterface && $date->getTimestamp() >= time()) {
                    return true;
                }
                continue;
            }

            if (method_exists($event, 'getStart')) {
                $date = $event->getEnd() ?: $event->getStart();
            }

            if ((int)$date >= time()) {
                return true;
            }
        }

        return false;
    }
}
