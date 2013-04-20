<?php

$form   = $data['form'];
$member = $data['member'];
$warns  = $data['warns'];
$warnLevel = $data['warnLevel'];
$memberInitial = $data["memberInitial"];

$form->addHidden('warnLevel', $member['warnLevel'], true);
?>

<?php echo $form->open(); ?>
    <div id="warnWrapper">
        <label><?php echo T("Username"); ?>:</label> 
            <a href='<?php echo URL(memberURL($member['memberId'])); ?>'>
                <?php echo $member['username']; ?>
            </a>
        <br/>
        
        <label><?php echo T("Warn Level"); ?>:</label> 
        <a href="javascript: void(0)" class="progressBarMinus">[-]</a>
        <div class="progressBar"><div class="indicator" style="width: <?php echo $warnLevel; ?>%; background: <?php echo $memberInitial[1]; ?>"></div></div>
        <div class="progressBarValue"><?php echo $warnLevel; ?>%</div>
        <a href="javascript: void(0)" class="progressBarPlus">[+]</a><br/>
        <div class="progressBarState" style="color: <?php echo $memberInitial[1]; ?>"><?php echo $memberInitial[0]; ?></div><br/>
        
        <label><?php echo T("Reason");?>:</label>
        <?php echo $form->input("warnReason"); ?>
        
        <hr class="sep"/>
        
        <span class="title"><?php echo T("Previous Warns"); ?></span><br/>
        <?php if (empty($warns)): ?>
            <?php echo T("This user has not received warns"); ?>
        <?php else: ?>
            <table id="warnStyledTable">
                <tr id="header">
                    <td class='givenBy'><?php echo T('Given by')?>:</td>
                    <td class='date'><?php echo T('Date')?>:</td>
                    <td class='reason'><?php echo T('Reason')?>:</td>
                    <td class='points'><?php echo T('Points')?>:</td>
                </tr>
                <?php foreach ($warns as $warn): ?>
                    <tr id="list">
                        <td class='givenBy'><?php echo $warn['moderatorUrl']; ?></td>
                        <td class='date'><?php echo $warn['time']; ?></td>
                        <td class='reason'><?php echo $warn['reason']; ?></td>
                        <td class='points'><?php echo $warn['variation']; ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
        
        <hr class="sep"/>
        
        <?php echo $form->saveButton(); ?>
    </div>
<?php echo $form->close(); ?>


<script language="javascript">
    $(function(){
        pB           = $(".progressBar")
        pB_indicator = pB.children(".indicator");
        pB_value     = $(".progressBarValue");
        pB_text      = $(".progressBarState");
        
        pB_minus = $(".progressBarMinus");
        pB_plus  = $(".progressBarPlus" );
        
        pB_ActualValue = parseInt((/\d+/).exec(pB_value.html())[0]);
        
        pB_formField = $("input[name=warnLevel]");
        
        
        //=====
        
        stateVocab = [T("Unmoderated"), T("Monitored"), T("Moderated"), T("Muted")];
        
        function updateState(){
            percent = "" + pB_ActualValue + "%";
            pB_indicator.width(percent);
            pB_value.html(percent);
            pB_formField.attr('value', pB_ActualValue);
            
            // Valor inicial da cor e texto do membro
           for (i = 3; i >= 0; i--){
                level = ET.warnLevels[i];
                if (pB_ActualValue >= level[0]){
                    state = stateVocab[i];
                    color = level[1];
                    break;
                }
           }
           
           pB_indicator.css('background', color);
           pB_text.css('color', color);
           pB_text.html(state);
        };
        
        //=====
        
        pB.click(function(event){
            maxSize = pB.width();
            percent = Math.round(100 * event.offsetX/maxSize);
            total   = Math.round(percent / 5) * 5
            
            pB_ActualValue = total;
            
            updateState();
        })
        
        pB_minus.click(function(){
            if (pB_ActualValue == 0) return;
            pB_ActualValue -= 5;
            updateState();
        })
        
        pB_plus.click(function(){
            if (pB_ActualValue == 100) return;
            pB_ActualValue += 5;
            updateState();
        })
    })
</script>