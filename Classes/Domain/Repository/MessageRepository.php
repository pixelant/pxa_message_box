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
		$query->matching(
			$query->logicalNot(
				$query->in('uid', $messagesUids)
			)
		);
		
		return $query->execute();
	}
}
?>