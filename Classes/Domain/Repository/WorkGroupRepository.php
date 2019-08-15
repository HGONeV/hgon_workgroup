<?php
namespace HGON\HgonWorkgroup\Domain\Repository;

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
 * The repository for WorkGroups
 */
class WorkGroupRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{
    /**
     * Returns a working group by zip
     * -> if the zip is written in multiple working groups, the first entry will shown
     *
     * @param integer $zip
     * @return mixed
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\InvalidQueryException
     */
    public function findOneByZip($zip)
    {
        $query = $this->createQuery();

        return $query->matching(
            $query->like('zip', '%' . intval($zip) . '%')
        )
        ->execute()->getFirst();
    }
}
