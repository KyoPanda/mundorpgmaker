<?php
// Copyright 2013+ Gabriel "Gab!" Teles
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays a list of installed languages.
 *
 * @package esoTalk
 */
$form = $data["form"];
$warnLevels = $data["warnLevels"];
?>

<?php echo $form->open(); ?>

<ul class='form'>
    <li>
        <label>Distribuições de Avisos</label>

        <div>
            Monitorado: <span id='monitoratedValue'><?php echo $warnLevels[1][0]; ?></span>%<br/>
            Moderado: <span id='moderatedValue'><?php echo $warnLevels[2][0]; ?></span>%<br/>
            Mudo: <span id='muteValue'><?php echo $warnLevels[3][0]; ?></span>%<br/><br/>

            <span style="display: inline-block; width: 200px; padding: 0 5px;">
                <?php echo $form->input('warnLevels', 'slider', array('id' => 'slider')); ?>
            </span>
        </div>
    </li>
    <li class='sep'></li>
    <li>
        <label>Cor - Monitorado:</label>
        <div id='monitoredPicker'>
            <?php echo $form->input("monitoredPicker", "text", array("class" => "color")); ?> <a href='#' class='reset'>Resetar</a>
        </div>
    </li>
    <li>
        <label>Cor - Moderado:</label>
        <div id='moderatedPicker'>
            <?php echo $form->input("moderatedPicker", "text", array("class" => "color")); ?> <a href='#' class='reset'>Resetar</a>
        </div>
    </li>
    <li>
        <label>Cor - Mudo:</label>
        <div id='mutePicker'>
            <?php echo $form->input("mutePicker", "text", array("class" => "color")); ?> <a href='#' class='reset'>Resetar</a>
        </div>
    </li>
    <li class='sep'></li>
    <li>
        <label>Diminuição de pontos:</label>
        <div>
            <?php echo $form->input("pointsSub", "text", array("style" => "width: 100px;", "onkeypress" => "return checkNumeric(event)")); ?>
        </div>
    </li>
    <li>
        <label>Tamanho do período:</label>
        <div>
            
        </div>
    </li>
    <li class='sep'></li>
    <li>
        <?php echo $form->saveButton(); ?>
    </li>
</ul>
<?php echo $form->close(); ?>
<script type="text/javascript" charset="utf-8">
// Turn a normal text input into a color picker, and run a callback when the color is changed.
function colorPicker(id, callback) {
    // Create the color picker container.
    var picker = $("<div id='"+id+"-colorPicker'></div>").appendTo("body").addClass("popup").hide();

    // When the input is focussed upon, show the color picker.
    $("#"+id+" input").focus(function() {
        picker.css({position: "absolute", top: $(this).offset().top - picker.outerHeight(), left: $(this).offset().left}).show();
    })

    // When focus is lost, hide the color picker.
    .blur(function() {
        picker.hide();
    })

    // Add a color swatch before the input.
    .before("<span class='colorSwatch'></span>");

    // Create a handler function for when the color is changed to update the input and swatch, and call
    // the custom callback function.
    var handler = function(color) {
        callback(color, picker);
        $("#"+id+" input").val(color.toUpperCase());
        $("#"+id+" .colorSwatch").css("backgroundColor", color);
        $("#"+id+" .reset").toggle(!!color);
    }

    // Set up a farbtastic instance inside the picker we've created.
    $.farbtastic(picker, function(color) {
        handler(color);
    }).setColor($("#"+id+" input").val());

    // When the "reset" link is clicked, reset the color.
    $("#"+id+" .reset").click(function(e) {
        e.preventDefault();
        handler("");
    }).toggle(!!$("#"+id+" input").val());

}
    
function checkNumeric(evt) {  
    var e = evt || window.event; //window.event is safer, thanks @ThiefMaster
        
    var charCode = e.which || e.keyCode;                        

    if (charCode > 31 && (charCode < 47 || charCode > 57))
        return false;

    return (!e.shiftKey);
};
    
$(function(){
    $("#slider").slider({ 
        from: 1, 
        to: 100, 
        min: 5,
        step: 5, 
        smooth: true, 
        round: 0, 
        dimension: "&nbsp;%", skin: "plastic",
        callback: function(value){
            n = value.split(";");
            
            if (n[0] <= 5){
                $("#slider").slider("value", 10, n[1])
                n[0] = 10;
            }
            
            $("#monitoratedValue").html(5);
            $("#moderatedValue").html(n[0]);
            $("#muteValue").html(n[1]);
        }
    });  
    
    $("input[name=pointsSub]").spinner({
        min: 0.0,
        max: 100.0,
        step: 5.0
    });
    
    colorPicker("monitoredPicker", function(){});
    colorPicker("moderatedPicker", function(){});
    colorPicker("mutePicker",      function(){});
})   
</script>