<?php
namespace Resultify\ResultifyMessageBox\Utility;

/***
 *
 * This file is part of the "Responsible" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2017 Alex <alex@pixelant.se>, Pixelant
 *
 ***/

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Database\Query\QueryBuilder;

/**
 * Access to the Database
 *
 * Class DatabaseUtility
 *
 * @package Resultify\ResultifyMessageBox\Utility
 */
class DatabaseUtility
{
    /**
     * update user by uid
     * @param $uid
     * @param $messagesUids
     *
     * @return void
     */
    public static function updateUser($uid, $messagesUids)
    {
        $res = self::getQueryBuilder()->update('fe_users')
                ->where(self::getQueryBuilder()->expr()->eq('uid',$uid))
                ->set('seen_messages_ids', $messagesUids)
                ->execute();
        if($res){
            return true;
        }else{
            return false;
        }
    }

    /**
     * update user by uid
     * @param $uid
     *
     * @return void
     */
    public static function getUserData($uid)
    {
        $res = self::getQueryBuilder()->select('seen_messages_ids')
        ->from('fe_users')
        ->where(
           self::getQueryBuilder()->expr()->eq('uid', $uid)
        )
        ->execute()->fetchColumn(0);
        return $res;
    }

    /**
     * Returns QueryBuilder
     *
     * @return \TYPO3\CMS\Core\Database\Query\QueryBuilder
     */
    public static function getQueryBuilder()
    {
        return GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
    }
}
