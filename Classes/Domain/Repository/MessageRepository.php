<?php
namespace Resultify\ResultifyMessageBox\Domain\Repository;

/***
 *
 * This file is part of the "Message Box" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Alex <alex@pixelant.se>, Resultify
 *
 ***/

use TYPO3\CMS\Extbase\Persistence\QueryInterface;

/**
 *
 *
 * MessageRepository
 *
 */
class MessageRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {
	/**
	 * Initializes the repository.
	 *
	 * @return void
	 * @see \TYPO3\CMS\Extbase\Persistence\Repository::initializeObject()
	 */
	public function initializeObject() {
		/** @var $querySettings Typo3QuerySettings */
		$querySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings');
		$querySettings->setRespectStoragePage(TRUE);
		$this->setDefaultQuerySettings($querySettings);
	}

	/**
	 * Find messages
	 *
	 * @param int $storagePid storagePid to get messages from
	 * @param array[String] $messagesUids
	 * @return QueryResult<Message> found comments
	 */
	public function findByUidRespectStorage($storagePid, $messagesUids) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setStoragePageIds($storagePid);
		$query->setOrderings(
		    array(
		        'date' => $this->getSortingDirection()
		    )
		);
		$query->matching(
			$query->logicalNot(
				$query->in('uid', $messagesUids)
			)
		);
		
		return $query->execute();
	}

	/**
	 * Returns order direction
	 *
	 * @return string
	 */
	public function getSortingDirection() {
		if ($this->getInvertSorting() === TRUE) {
			return QueryInterface::ORDER_DESCENDING;
		}
		return QueryInterface::ORDER_ASCENDING;
	}

	/**
	 * Gets invert sorting flag
	 *
	 * @return bool
	 */
	public function getInvertSorting() {
		return $this->invertSorting;
	}

	/**
	 * Sets invert sorting flag
	 *
	 * @param bool $invertSorting
	 * @return void
	 */
	public function setInvertSorting($invertSorting) {
		$this->invertSorting = $invertSorting;
	}
}
?>