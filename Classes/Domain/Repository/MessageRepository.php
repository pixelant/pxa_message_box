<?php

namespace Pixelant\PxaMessageBox\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

/**
 *
 *
 * MessageRepository
 *
 */
class MessageRepository extends Repository
{
    /**
     * Initializes the repository.
     *
     * @return void
     */
    public function initializeObject()
    {
        $this->setDefaultOrderings([
            'date' => QueryInterface::ORDER_DESCENDING
        ]);
    }

    /**
     * Find messages not seen by user
     *
     * @param int $userId
     * @return QueryResultInterface found comments
     */
    public function findByNotSeen(int $userId): QueryResultInterface
    {
        $query = $this->createQuery();

        $query->matching($query->logicalNot(
            $query->contains('seenBy', $userId)
        ));

        return $query->execute();
    }
}
