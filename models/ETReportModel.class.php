<?php
// Copyright 2013 Gabriel "Gab!" Teles
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * The report model provides functions for retrieving and managing report data.
 * It also provides methods to register new reports and close it.
 *
 * @package esoTalk
 */
class ETReportModel extends ETModel {
        
/**
 * Class constructor; sets up the base model functions to use the table.
 *
 * @return void
 */
public function __construct()
{
        parent::__construct("report");
}

/**
 * Create a new report 
 * 
 * @param int $postId Reported post id
 * @param int $memberId Id from member who opened the report
 * @param string $message Reason
 * @return int New report ID      
 */
public function create($postId, $memberId, $message)
{
    
    $query = ET::SQL()
            ->select('*')
            ->from($this->table)
            ->where('postId=:postId')
            ->where("open=1")
            ->bind(':postId', $postId)
            ->exec();
    
    // Se existir uma denúncia ativa e do mesmo post, seleciona
    if ($query->numRows() != 0) {
        $data = $query->allRows()[0];
        $reportId = $data['reportId'];
        
        
    // Caso contrário, cria uma
    } else {
        $conversation = ET::conversationModel()->getByPostId($postId);
        $postMemberId = ET::postModel()->getById($postId)['memberId'];
        
        $data = array(
            'postId'            => $postId,
            'conversationTitle' => $conversation['title'],
            'memberId'          => $postMemberId,
        );
        $reportId = parent::create($data);
    }
    
    // Cria comentário
    ET::SQL()
        ->insert('report_comment')
        ->set(array(
            'reportId' => $reportId,
            'memberId' => $memberId,
            'comment'  => $message,
            'time'     => time()
        ))
        ->exec();
    
    return $reportId;
}

/**
 * Returns all reports
 * 
 * @param int $from Starting report id
 * @param int $limit Limit
 * @return array Array with all reports
 */
public function getAll($from = 0, $limit = -1) {
    $sql = ET::SQL()
        ->select("r.*")
        ->from('report r')
        ->orderBy("time");
    
    if ($from > 0)
        $sql->offset($from);
    
    if ($limit > 0)
        $sql->limit($limit);
    
    if (!ET::$session->isAdmin())
        $sql->from('post p', 'p.postId=r.postId', 'left')
            ->from('conversation c', 'c.conversationId=p.conversationId', 'left')
            ->from('channel_group ch', 'ch.channelId=c.channelId AND ch.groupId IN (:groupIds)', 'left')
            ->bind(':groupIds', ET::$session->getGroupIds())
            ->where("ch.moderate");

    return $sql->exec()->allRows();
}

/**
 * Return comments related to report
 * 
 * @param int $postId ID of the post
 * @return array Array with the comments
 */
public function getComments($reportId) {
    return ET::SQL()
            ->select("*")
            ->where("reportId=:reportId")
            ->bind(":reportId", $reportId)
            ->from('report_comment')
            ->exec()
            ->allRows();
}

/**
 * Open all reports associated with the post id 
 * 
 * @param int $reportId ID of the report
 * @return int Number of affected rows
 */
public function open($reportId) {
    return ET::SQL()
        ->update($this->table)
        ->set(array('open' => 1))
        ->where("reportId=:reportId")
        ->where(array('open' => 0))
        ->bind(":reportId", $reportId)
        ->exec()
        ->numRows();
}

/**
 * Close all reports associated with the post id 
 * 
 * @param int $reportId ID of the report
 * @return int Number of affected rows
 */
public function close($reportId) {
    return ET::SQL()
        ->update($this->table)
        ->set(array('open' => 0))
        ->where("reportId=:reportId")
        ->where(array('open' => 1))
        ->bind(":reportId", $reportId)
        ->exec()
        ->numRows();
}

/**
 * Get formatted post data from report
 * 
 * @param int $reportId ID of the report
 * @return string Fromatted data
 */
public function getPostData($reportId){
    $data = ET::SQL()
            ->select('postId')
            ->from('report')
            ->where('reportId=:reportId')
            ->bind(':reportId', $reportId)
            ->exec()
            ->result();
        
    $post = ET::postModel()->getById($data);
    return ET::formatter()->init($post["content"])->format()->get();
    
    //if ($data->numRows() > 0)
      //  return ET::formatter()->init($data->result())->format()->get();
    
    return '';
}

/**
 * Verify report state (open/closed)
 * 
 * @param int $reportId ID of the report
 * @return bool Report state (open = true // closed = false)
 */
public function isOpen($reportId) {
    return ET::SQL()
            ->select("COUNT(*)")
            ->where("reportId=:reportId")
            ->where('open=1')
            ->bind(":reportId", $reportId)
            ->exec()
            ->result() > 0;
}

/**
 * Check if active user can see report
 * 
 * @param int $reportId Report ID to check
 * @return bool Permission to see or not
 */
public function userCanSee($reportId){
    if (ET::$session->isAdmin())
        return true;
    else
        return (bool)ET::SQL()
            ->from('report r')
            ->from('post p', 'p.postId=r.postId', 'left')
            ->from('conversation c', 'c.conversationId=p.conversationId', 'left')
            ->from('channel_group ch', 'ch.channelId=c.channelId AND ch.groupId IN (:groupIds)', 'left')
            ->where('ch.moderate')
            ->where('r.reportId=:reportId')
            ->bind(':groupIds', ET::$session->getGroupIds())
            ->bind(':reportId', $reportId)
            ->exec()
            ->result();
}

}
?>
