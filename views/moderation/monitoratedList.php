<?php

// Copyright 2013 Gabriel "Gab!" Teles

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the monitored member's list.
 *
 * @package esoTalk
 */

$lateralMenu    = $data["lateralMenu"];
$members        = $data["members"];
?>

<div class="clearfix">
    <div id="moderationMenu" class="tabs big">
        <?php echo $lateralMenu;?>
    </div>
    
    <div id="moderationContent">
        <?php if (!empty($members)): ?>
            <table id="monitoratedStyledTable">
                <tr id="header">
                    <td class='givenBy'><?php echo T('Username');?>:</td>
                    <td class='date'><?php echo T('Last Login');?>:</td>
                    <td class='reason'><?php echo T('Last Action');?>:</td>
                    <td class='points'><?php echo T('Points');?>:</td>
                </tr>
                
                <?php foreach ($members as $member): ?>
                    <tr id="list">
                        <td class='givenBy'><?php echo "<a href='" . URL(memberURL($member['memberId'])) . "'>" . $member['username'] . '</a>'; ?></td>
                        <td class='date'><?php echo date(T("date.full"), $member['lastActionTime']); ?></td>
                        <td class='reason'><?php 
                            $lastAction = ET::memberModel()->getLastActionInfo($member["lastActionTime"], $member["lastActionDetail"], false);
                            echo sanitizeHTML($lastAction[0]);
                        ?></td>
                        <td class='points'><?php echo $member['totalWarn']; ?>%</td>
                    </tr>   
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <?php echo T("There are no monitored members"); ?>
        <?php endif; ?>
    </div>
</div>