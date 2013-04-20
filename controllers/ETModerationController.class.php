<?php


if (!defined("IN_ESOTALK")) exit;

/**
 * The channels controller handles the channel list page, and subscribing/unsubscribing to channels.
 *
 * @package esoTalk
 */

class ETModerationController extends ETController {
   /**
    * Show the moderator's area.
    * 
    * @return void
    */
   public function index() {
       $this->reports();
   }
   
   /**
    * Show monitorated members
    */
   public function monitorated() {
       if (!ET::$session->isModerator()){
           $this->render404(T("message.noPermission"));
           return;
       }
       
       $menu = $this->createMenu("monitorated");
       $this->data("lateralMenu", $menu->getContents());
       
       // Get monitorated members
       $members = ET::SQL()
               ->select('m.*')
               ->select('(w.total - (:decrease * ROUND((UNIX_TIMESTAMP() - w.time)/86400)))', 'totalWarn')
               ->from('warn w')
               ->from('member m', 'm.memberId=w.memberId', 'left')
               ->where('(w.total - (:decrease * ROUND((UNIX_TIMESTAMP() - w.time)/86400)))<:monitoratedMax')
               ->where('(w.total - (:decrease * ROUND((UNIX_TIMESTAMP() - w.time)/86400)))>0')
               ->where('time=(SELECT max(time) FROM et_warn WHERE memberId=w.memberId)')
               ->bind(':monitoratedMax', C('esoTalk.warnLevels')[2][0])
               ->bind(':decrease', 5)
               ->orderBy('lastActionTime DESC')
               ->groupBy('memberId')
               ->exec()
               ->allRows();
       
       $this->data('members', $members);
       
       $this->render("moderation/monitoratedList");
   }
   
   /**
    * Show open and closed reports
    * 
    * @return void
    */
   public function reports() {
       if (!ET::$session->isModerator()){
           $this->render404(T("message.noPermission"));
           return;
       }
       
       $menu = $this->createMenu("reports");
       $this->data("lateralMenu", $menu->getContents());
       
       $openControls = $this->getReportControls(true);
       $this->data("reportOpenControls", $openControls->getContents());
       $closedControls = $this->getReportControls(false);
       $this->data("reportClosedControls", $closedControls->getContents());
               
       $reports = ET::reportModel()->getAll();
       $open   = [];
       $closed = [];
       
       foreach ($reports as $report){
           $report['conversationUrl'] = $conversationUrl = postURL($report['postId']);
           
           $member = ET::memberModel()->getById($report['memberId']);
           $report['memberLink'] = "<a href='" . memberURL($member['memberId']) . "'>" . $member['username'] . '</a>';
           
           $report['comments'] = ET::reportModel()->getComments($report['reportId']);
           
           if ($report['open'] == '1') {
               $open[] = $report;
           } else {
               $closed[] = $report;
           }
       }
       
       
       $this->data("openReports", $open);
       $this->data("closedReports", $closed);
       
       $this->addJSLanguage('Are you sure you want to close the report?', 'Are you sure you want to open the report?', 'Open', 'Close');
       $this->addJSFile("js/reports.js");
       
       $this->render("moderation/reportList");
   }

   /**
    * Close an report
    * 
    * @return void 
    */
   public function reportClose() {
       if (!$this->validateToken()) return;
       
       $reportId = R('reportId');
       if (!ET::reportModel()->userCanSee($reportId)) return;
       
       $close = ET::reportModel()->close($reportId);
       $this->responseType = RESPONSE_TYPE_JSON;
       $this->json("sucess", count($close) > 0);
       $this->render();
   }
   
   /**
    * Open an report
    * 
    * @return void 
    */
   public function reportOpen() {
       if (!$this->validateToken()) return;

       $reportId = R('reportId');
       if (!ET::reportModel()->userCanSee($reportId)) return;
       
       $open = ET::reportModel()->open($reportId);
       $this->responseType = RESPONSE_TYPE_JSON;
       $this->json("sucess", count($open) > 0);
       $this->render();
   }
   
   /**
    * Get report details (comments and post content)
    * 
    * @return void
    */
   public function reportDetail() {
       if (!$this->validateToken()) return;

       $reportId = R('reportId');
       if (!ET::reportModel()->userCanSee($reportId)) return;
       
       $this->responseType = RESPONSE_TYPE_JSON;
       
       $comments = ET::reportModel()->getComments($reportId);
       foreach ($comments as &$comment){
            $date = (time() - $comment["time"] < 24 * 60 * 60) ? relativeTime($comment["time"], true): date("M j", $comment["time"]);

           $comment['final'] = '';
           
           $member = ET::memberModel()->getById($comment['memberId']);
           
           $comment['final'] .= "<a href='" . memberURL($comment['memberId']) . "'>" . $member['username'] . '</a>';
           $comment['final'] .= ' ' . T('in') . ' ';
           $comment['final'] .= "<span class='time' title='".date(T("date.full"), $comment["time"])."'>".$date."</span>: ";
           $comment['final'] .= '<span>' . $comment['comment'] . '</span>';
           
           $comment = $comment['final'];
       }
       
       $this->json('comments', $comments);
       $this->json('postData', ET::reportModel()->getPostData($reportId));
       $this->render();
   }

   /* 
    * Approves an post
    * 
    * @param int $postId  Post Id
    * @return bool success or not
    */
   public function approve($postId){
       if (!$this->validateToken()) return;
       
       if (ET::postModel()->approve((int)$postId)){
           $this->message(T("Post successfully approved"), 'success');
       } else {
           $this->message(T("Fail at message approving"), 'warning');
       }
       
       $this->redirect(URL(postURL($postId)));
   }
   
      
   /**
    * Show the report post page
    *
    * @return void
    */
   public function report($postId = false) {
        if (!($conversation = $this->getConversation($postId,true))) return;
        if (!($post = $this->getPost($postId))) return;
        
        $member = ET::memberModel()->getById($post["memberId"]);
        $conversationUrl = postURL($postId);
        
        $form = ETFactory::make("form");
        if ($form->validPostBack("report")){
            ET::reportModel()->create(
               $post["postId"],
               $member['memberId'],
               $form->getValue("reportReason")
            );
            
            $this->message(T("Report Sent"), "success");
            $this->redirect(URL($conversationUrl));
        } else {
            $this->trigger("renderBefore");
            
            $this->data("conversation", $conversation);
            $this->data("member", $member);
            $this->data("memberUrl", memberURL($member["memberId"]));
            $this->data("postId", $postId);
            $this->data("postUrl", $conversationUrl); 
            $this->data("formattedPost", ET::formatter()->init($post["content"])->format()->get());
            $this->data("form", $form);
            
            $this->render("moderation/reportPost");
       }
   }
   
   /**
    * Show a sheet to change member warn level
    *
    * @param int $memberId The member's ID.
    * @return void
    */
   public function warn($memberId = "")
   {
           if (!($member = $this->getMember($memberId))) return;

           // If we don't have permission to rename the member, throw an error.
           if (!ET::memberModel()->canWarn($member)) {
                   $this->renderMessage(T("Error"), T("message.noPermission"));
                   return;
           }
           
           $form = ETFactory::make("form");
           
           if ($form->validPostBack('save')){
               $wLevel = $form->getValue('warnLevel');
               $reason = $form->getValue('warnReason');
               
               ET::warnModel()->create((int)$memberId, $reason, $wLevel);
               
               $this->message(T("Warn Sent"), "success");
           }
           
           ///
           $warns = ET::warnModel()->getWarns($memberId);
           $warnLevel = ET::warnModel()->getTotalWarnPoints($memberId);
           
           foreach($warns as &$warn){
               $warn['moderatorUrl'] = "<a href='" . URL(memberURL($warn['moderatorId'])) . "'>" . ET::memberModel()->getById($warn['moderatorId'])['username'] . "</a>";
               $warn['time'] = date(T("date.full"), $warn["time"]);
           }
           
           $stateVocab = array(
                T("Unmoderated"),
                T("Monitored"),
                T("Moderated"),
                T("Muted")
           );
           $warnLevels = C("esoTalk.warnLevels");
           // Valor inicial da cor e texto do membro
           for ($i = 3; $i >= 0; $i--){
                $level = $warnLevels[$i];
                if ($warnLevel >= $level[0]){
                    $memberInitialState = $stateVocab[$i];
                    $memberInitialColor = $level[1];
                    break;
                }
           }
            
           $this->data("memberInitial", array($memberInitialState, $memberInitialColor));
           
           $this->addJSLanguage("Unmoderated", "Monitored", "Moderated", "Muted");
           $this->addJSVar("warnLevels", $warnLevels);
           
           //
           
           $this->data("form", $form);
           $this->data("member", $member);
           $this->data("warnLevel", $warnLevel);
           $this->data("warns", $warns);
           
           $this->render("moderation/warn");
   }
   
   /**
    * Shortcut function to get a conversation and render a 404 page if it cannot be found.
    *
    * @param int $id The ID of the conversation to get, or the post to get the conversation of.
    * @return bool|array An array of the conversation details, or false if it wasn't found.
    */
   protected function getConversation($id)
   {
           $conversation = ET::conversationModel()->getByPostId($id);

           // Stop here if the conversation doesn't exist, or if the user is not allowed to view it.
           if (!$conversation) {
                   $this->render404(T("message.conversationNotFound"));
                   return false;
           }

           return $conversation;
   }
   
   /**
    * Shortcut function to get a post and render a 404 page if it cannot be found.
    *
    * @param int $id The ID of the conversation to get, or the post to get the conversation of.
    * @param bool $post Whether or not $id is the conversationId or a postId.
    * @return bool|array An array of the post details, or false if it wasn't found.
    */
   protected function getPost($id)
   {
           $post = ET::postModel()->getById($id);

           // Stop here if the post doesn't exist, or if the user is not allowed to view it.
           if (!$post) {
                   $this->render404(T("message.conversationNotFound"));
                   return false;
           }

           return $post;
   }
   
   /**
    * Fetch the specified member's details, or render a not found error if the member doesn't exist.
    *
    * @param string $member The member's ID.
    * @return array An array of the member's details, or false if they weren't found.
    */
   protected function getMember($memberId)
   {
           if (!$memberId or !($member = ET::memberModel()->getById((int)$memberId))) {
                   $this->render404(T("message.memberNotFound"));
                   return false;
           }

           return $member;
   }
   
   /**
    * Create lateral menu and highlight selected, passed by argument
    * 
    * @param string $selected Selected option
    * @return ETMenu Options menu
    */
   protected function createMenu($selected) {
       $menu = ETFactory::make("menu");
       
       $menu->add("reports", "<a href='" . URL("moderation/reports") . "'>" . T("Reports") . "</a>");
       $menu->add("monitorated", "<a href='" . URL("moderation/monitorated") . "'>" . T("Monitorated Members") . "</a>");
       $this->trigger("moderationOptions", array($this, &$menu, &$selected));
       
       $menu->highlight($selected);
       
       return $menu;
   }
   
   /**
    * Returns the controls to by applied to an report
    * 
    * @param bool $open true if its getting controls for open reports
    * @return ETMenu Controls
    */
   protected function getReportControls($open) {
       $menu = ETFactory::make("menu");
       
       if ($open)
           $menu->add("close", "<a class='control-reportClose' title='" . T("Close") . "' href='javascript: void(0)'>" . T("Close") . "</a>");
       else 
           $menu->add("open", "<a class='control-reportOpen' title='" . T("Open") . "' href='javascript: void(0)'>" . T("Open") . "</a>");
       
       
       $menu->add("detail", "<a class='control-reportDetail' title='" . T("Detail") . "' href='javascript: void(0);'>" . T("Detail") . "</a>");
       
       $this->trigger("reportControls", array($this, &$menu, $open));
               
       return $menu;
   }
   
}

?>
