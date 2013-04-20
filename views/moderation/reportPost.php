<?php
// Copyright 2013 Gabriel "Gab!" Teles

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a post report.
 *
 * @package esoTalk
 */

$conversation  = $data["conversation"];
$member        = $data["member"];
$memberUrl     = $data["memberUrl"];
$formattedPost = $data["formattedPost"];
$postUrl       = $data["postUrl"];
$form          = $data["form"];

?>

<div class="reportWrapper">
    <label class="reportTitle">
        <?php echo T("Report"); ?> 
            <a href="<?php echo $memberUrl; ?>"> <?php echo $member["username"]; ?></a>
            <?php echo T("in"); ?> 
            "<a href="<?php echo $postUrl;?>"><?php echo $conversation["title"]; ?></a>"
    </label>

    <div id="reportBody">
        <a id="spoilerTrigger" class="reportContent" href="javascript:void(0)"><?php echo T("Post Content (click to show/hide)"); ?></a>
        <div id="spoilerBody" class="thing reportBody">
            <?php echo $formattedPost; ?>
        </div>
    </div>
    
    <hr class="sep"/>
    
    <div id="reportReason">
        <?php echo $form->open(); ?>
            <label><?php echo T("Reason"); ?>: </label>
            <?php echo $form->input("reportReason"); ?>
            <?php echo $form->button("report", T("Send Report"), array("class" => "big submit"));; ?>
        <?php echo $form->close(); ?>
    </div>
</div>   

<script language="javascript">
    $(function(){
        $("#spoilerTrigger").click(function(){
            $("#spoilerBody").slideToggle('slow');
        });
    });
</script>
    