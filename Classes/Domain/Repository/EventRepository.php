<?php

namespace HGON\HgonWorkgroup\Domain\Repository;

use HGON\HgonWorkgroup\Domain\Model\WorkGroup;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

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
 * Class EventRepository
 * The repository for events
 *
 * @author Maximilian Fäßler <maximilian@faesslerweb.de>
 * @copyright HGON
 * @package HGON_HgonWorkgroup
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class EventRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * @return QueryResultInterface<\HGON\HgonWorkgroup\Domain\Model\Event>
     */
    public function findByWorkGroup(WorkGroup $workGroup): QueryResultInterface
    {
        $query = $this->createQuery();
        // The workgroup plugin uses PID 42, while sf_event_mgt records live on PID 37.
        $query->getQuerySettings()->setRespectStoragePage(false);
        $query->matching($query->contains('txHgonWorkgroup', $workGroup));
        $query->setOrderings(['startdate' => QueryInterface::ORDER_ASCENDING]);

        return $query->execute();
    }
}
