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
use TYPO3\CMS\Core\Database\Query\Restriction\DeletedRestriction;

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
     * @return string
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
     * update user by uid
     *
     * @return array
     */
    public static function getFeUsers()
    {
        // get FE users data with hidden too
        $res = self::getQueryBuilderHidden()->select('uid', 'seen_messages_ids')
        ->from('fe_users')
        ->execute()->fetchAll();
        return $res;
    }

    /**
     * clean up fe_users
     *
     * @return boolean
     */
    public static function cleanUpFeUsers()
    {
        $allMessagesIds = self::getAllMessageIds();

        // get FE users
        $feUsers = self::getFeUsers();

        foreach ($feUsers as $key => $value) {

            if($value['seen_messages_ids'] != ''){
                // get intval array items
                $feUsersMessages = array_map('intval', explode(',', $value['seen_messages_ids']));
                
                // get array diff to get items that needs to be removed from updateArray
                $arrayDiff = array_diff($feUsersMessages,$allMessagesIds);
                
                if(count($arrayDiff) > 0){
                    // get array of cleanup array
                    $arrayToUpdate = array_diff($feUsersMessages,$arrayDiff);
                    
                    // get string from $arrayToUpdate to be able to update fe_users
                    $stringToUpdate = implode(',', $arrayToUpdate);
                    
                    $res = self::getQueryBuilderHidden()->update('fe_users')
                    ->where(self::getQueryBuilderHidden()->expr()->eq('uid', $value['uid']))
                    ->set('seen_messages_ids', $stringToUpdate)
                    ->execute();
                    
                    if(!$res){
                        return false;
                    }
                }
                
            }
        }
        return true;
    }

    /**
     * get all not hidden and not deleted messages
     *
     * @return array
     */
    public static function getAllMessageIds()
    {
        $result = array();
        $res = self::getQueryBuilder()->select('uid')
        ->from('tx_resultifymessagebox_domain_model_message')
        ->where(
           self::getQueryBuilder()->expr()->eq('deleted', 0),
           self::getQueryBuilder()->expr()->eq('hidden', 0)
        )
        ->execute();
        while ($row = $res->fetch()) {
           $result[] = $row['uid'];
        }
        
        return $result;
    }

    /**
     * Returns QueryBuilder
     *
     * @return \TYPO3\CMS\Core\Database\Query\QueryBuilder
     */
    public static function getQueryBuilder()
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        return $queryBuilder;
    }

    /**
     * Returns QueryBuilder with deleted restrictions only
     *
     * @return \TYPO3\CMS\Core\Database\Query\QueryBuilder
     */
    public static function getQueryBuilderHidden()
    {
        $queryBuilder = GeneralUtility::makeInstance(ConnectionPool::class)->getQueryBuilderForTable('fe_users');
        $queryBuilder
           ->getRestrictions()
           ->removeAll()
           ->add(GeneralUtility::makeInstance(DeletedRestriction::class));
        return $queryBuilder;
    }

}
