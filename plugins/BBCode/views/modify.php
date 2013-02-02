<?php
// Copyright 2012+ Gabriel Teles
// Esse arquivo é um adicional à configuração do plugin BBCode

if (!defined("IN_ESOTALK")) exit;

/**
 * Displays the settings form for the BBCode Plugin.
 *
 * @package bbcode
 */
$form = $data["pluginSettingsForm"];
$bbc  = $data["bbcode"];
?>

<ul class='form'>
    <?php echo $form->open(); ?>
    <?php echo $form->input("tagOrigName", "hidden", array('value' => $bbc['name'])); ?>
    
    <label>Nome da Tag</label>
    <?php echo $form->input("tagName", "text", array('value' => $bbc['name'])); ?><br/>
    <label>Tag complexa?</label>
    <?php 
        $complexParams = array('class' => 'text');
        if ($bbc['complex']) $complexParams['checked'] = '';
        
        echo $form->checkbox("tagComplex", $complexParams); 
    ?><br/>
    <label>Conteúdo Fixo?</label>
    <?php 
        $fixedParams = array('class' => 'text');
        if ($bbc['content'] == BBCODE_VERBATIM) $fixedParams['checked'] = '';
        
        echo $form->checkbox("tagFixed", $fixedParams); 
    ?><br/>

    <li class='sep'></li>
    
    <?php 
        switch ($bbc['type']): 
        case 0:
    ?>
        <label>Substituição Inicial</label>
        <?php echo $form->input("tagStart", "text", array('value' => $bbc['simple_start'])); ?><br/>
					
        <label>Substituição Final</label>
        <?php echo $form->input("tagEnd", "text", array('value' => $bbc['simple_end'])); ?><br/>
    <?php 
            break;
        case 1:
    ?>
        <label>Template</label>
        <?php echo $form->input("tagTemplate", "text", array('value' => $bbc['template'])); ?><br/>
        <li class='sep'></li>
        <label>Atributos</label>
        <ol id="AttrList">
                <?php foreach($bbc['allow'] as $attr => $validation): ?>
                    <li>
                            <label class='inline'>Nome</label>
                            <?php echo $form->input("tagAttrName[]", "text", array("class" => "smallText", 'value' => $attr)); ?>
                            <label class='inline'>Validação</label>
                            <?php echo $form->input("tagAttrRgx[]", "text", array("class" => "smallText", 'value' => $validation)); ?>
                            <label class='inline'><a href="javascript:void(0)" class="RemoveAttr">[Remover]</a></label>
                    </li>
               <?php endforeach; ?>
        </ol>
        <a href="javascript:void(0)" id="AddAttr">[Adicionar Atributo]</a>
    <?php 
            break;
        case 2:
    ?>
        <label>Função de validação</label><br/>
        <span class='desc'><strong>Argumentos:</strong> $bbcode, $action, $name, $default, $params, $content</span>
        <?php echo $form->input("tagFunction", "textarea", array('id' => 'tagCode', 'value' => $bbc['methodBody'])); ?>
    <?php endswitch; ?>

    <li class='sep'></li>
    
    <?php echo $form->button("modifyBBC", T("Modify BBCode"), array("class" => "big submit")); ?>
    <?php echo $form->button("deleteBBC", T("Delete BBCode"), array("class" => "big submit")); ?>
    <?php if ($bbc['active']): ?>
        <?php echo $form->button("deactivateBBC", T("Deactivate BBCode"), array("class" => "big submit")); ?>
    <?php else: ?>
        <?php echo $form->button("activateBBC", T("Activate BBCode"), array("class" => "big submit")); ?>
    <?php endif; ?>
    
    
    <?php echo $form->close(); ?>
</ul>

<script>
$(function() {
    
	function removeElem(e) {
		var elem   = e.target.parentNode.parentNode
		elem.parentNode.removeChild(elem);
	};
	
	$("#AddAttr").click(function() {
		var attrName = $("<?php echo $form->input("tagAttrName[]", "text", array("class" => "smallText")); ?>");
		var attrRgx  = $("<?php echo $form->input("tagAttrRgx[]",  "text", array("class" => "smallText")); ?>");
		
		var link = $("<a href='javascript:void(0)' class='RemoveAttr'>[Remover]</a>")
		$("#AttrList").append(
			$("<li>").append(
				$("<label class='inline'>Nome&nbsp;</label> ")
			).append(
				attrName
			).append(
				$("<label class='inline'>&nbspValidação&nbsp</label>")
			).append(
				attrRgx
			).append(
				$("<label class='inline'>&nbsp</label>").append(
					link
				)
			)
		);
		link.click(removeElem);		
	});
	
	$(".RemoveAttr").click(removeElem);
});
</script>