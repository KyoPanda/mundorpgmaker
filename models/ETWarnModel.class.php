<?php
// Copyright 2013+ Gabriel "Gab!" Teles
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * 
 *
 * @package esoTalk
 */
class ETWarnModel extends ETModel {
/**
 * Sets up the base model functions to use the table.
 *
 * @return void
 */
public function __construct()
{
        parent::__construct("warn");
}

/**
 * Create new warn to member
 * 
 * @param int $memberId Member Id
 * @param string $reason Reason of the warn
 * @param int $points Total of points
 * @return int New warn ID    
 */
public function create($memberId, $reason, $points) {
    
    $lastTotalWarn = $this->getTotalWarnPoints($memberId);
    $delta = $points - $lastTotalWarn;
    
    $total = max(0, min(100, $points));
    
    $values = array(
        'memberId' => $memberId,
        'moderatorId' => ET::$session->userId,
        'time' => time(),
        'reason' => $reason,
        'variation' => $delta,
        'total' => $total
    );
    
    $id = parent::create($values);
    return $id;
}

/**
 * Get all user warns
 * 
 * @param int $memberId Member ID
 * @param array $select Array with columns to be selected
 * @return array Array with all warns
 */
public function getWarns($memberId, $select=array('*')){
    $sql = ET::SQL();
    
    foreach ($select as $column) $sql->select($column);
           
    return $sql->from($this->table)
               ->where("memberId=:memberId")
               ->bind(":memberId", $memberId)
               ->orderBy('time DESC')
               ->exec()
               ->allRows();   
}

/**
 * Get total points of user (with per-day decrease)
 * 
 * @param int $memberId Member Id
 * @return int Total warn points
 */
public function getTotalWarnPoints($memberId){
    $sql = ET::SQL();
        
    $result = $sql->select('total - (:decrease * ROUND((UNIX_TIMESTAMP() - time)/86400))', 'totalWarn')
                  ->select('memberId')
                  ->from($this->table)
                  ->where('memberId=:memberId')
                  ->orderBy('time DESC')
                  ->bind(':decrease', 5)
                  ->bind(':memberId', $memberId)
                  ->limit(1)
                  ->exec()
                  ->result();
                 
    return max(0, min(100, (int)$result));
}

/*
 * Get channel ID from channels that have unapproved posts (and user can see)
 * @param int $from Offset
 * @param int $limit Limit
 * @return array Channels IDs
 */
public function unapprovedPostChannels($from = 0, $limit = -1){
    $sql = ET::SQL()
        ->select('c.channelId')
        ->from('post p')
        ->from('conversation c', 'p.conversationId=c.conversationId')
        ->where('p.approved=0');
    
    if ($from > 0)
        $sql->offset($from);
    
    if ($limit > 0)
        $sql->limit($limit);
    
    if (!ET::$session->isAdmin())
        $sql->from('channel_group ch', 'ch.channelId=c.channelId AND ch.groupId IN (:groupIds)', 'left')
            ->bind(':groupIds', ET::$session->getGroupIds())
            ->where("ch.moderate");

    return $sql->exec()->allRows('channelId');
}

}