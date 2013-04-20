<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the conversation list - a table with each conversation as a row.
 *
 * @package esoTalk
 */
?>
<ul class='list conversationList'>

<?php
// Loop through the conversations and output a table row for each one.
foreach ($data["results"] as $conversation):
    
    // Não renderiza se o primeiro post não for aprovado e se o usuário não é
    // um moderador.
    $result = ET::conversationModel()->userCanSee($conversation['conversationId'], true);
    $conversation['unapproved'] = $result['unapproved'];
    
    if ($result['canSee'])
        $this->renderView("conversations/conversation", $data + array("conversation" => $conversation));
endforeach;

?></ul>