<?php
namespace Resultify\ResultifyMessageBox\Domain\Model;

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
 * User
 */
class User extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * date
     *
     * @var integer
     */
    protected $seenMessagesIds = null;

    /**
     * Returns the seenMessagesIds
     *
     * @return integer $seenMessagesIds
     */
    public function getSeenMessagesIds()
    {
        return $this->seenMessagesIds;
    }

    /**
     * Sets the seenMessagesIds
     *
     * @param integer $seenMessagesIds
     * @return void
     */
    public function setSeenMessagesIds($seenMessagesIds)
    {
        $this->seenMessagesIds = $seenMessagesIds;
    }
}
