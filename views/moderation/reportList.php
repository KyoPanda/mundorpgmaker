<?php
// Copyright 2013 Gabriel "Gab!" Teles

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the report list.
 *
 * @package esoTalk
 */

$lateralMenu    = $data["lateralMenu"];
$reportOpenControls = $data["reportOpenControls"];
$reportClosedControls = $data["reportClosedControls"];
$openReports    = $data["openReports"];
$closedReports  = $data["closedReports"];

?>

<div class="clearfix">
    <div id="moderationMenu" class="tabs big">
        <?php echo $lateralMenu;?>
    </div>
    
    <div id="moderationContent">
        <a class="button" id="showOpen"><?php echo T("Open Reports"); ?></a>
        <a class="button" id="showClosed"><?php echo T("Closed Reports"); ?></a>
        
        <?php
            $reports = array(
                "Open"   => array($openReports, $reportOpenControls),
                "Closed" => array($closedReports, $reportClosedControls)
            );
                    
            foreach($reports as $keyword => $reportData):
                list($reportType, $control) = $reportData;
        ?>
                <div id="moderation<?php echo $keyword; ?>">
                    <div class="thing noReport" <?php if (!empty($reportType)): ?>style="display:none"<?php endif; ?>>
                        <?php echo T("No reports here"); ?>
                    </div>
                    
                    <?php foreach ($reportType as $report): ?>
                        <div class="thing reportContainer" data-reportid="<?php echo $report['reportId']; ?>">
                            <?php echo $report['memberLink']; ?>
                            <?php echo T("in"); ?> 
                            "<a href="<?php echo $report['conversationUrl'];?>"><?php echo $report['conversationTitle']; ?></a>"
                            
                            <div id="moderationControls"><?php echo $control; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
        <?php endforeach; ?>
    </div>
</div>

<script language="javascript">
    $(function(){
        // Button control
        var active = 0;
        $("#showOpen").click(function(){
            if (active == 0) return;
            $("#moderationOpen").slideDown();
            $("#moderationClosed").slideUp();
            active = 0;
        });
        
        $("#showClosed").click(function(){
            if (active == 1) return;
            $("#moderationOpen").slideUp();
            $("#moderationClosed").slideDown();
            active = 1;
        });
    })
</script>
    