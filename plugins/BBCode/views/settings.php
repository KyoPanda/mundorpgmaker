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
?>

<?php echo $form->open(); ?>

	<ul class='form'>

		<li class='sep'></li>
		<label>Lista de BBCodes</label>
		
		<ol>
			<?php
				if (count($data["bbcodes"])):
					foreach ($data["bbcodes"] as $bbcode):
			?>
					
			<?php
					endforeach;
				else:
			?>
				Não existem BBCodes definidos
			<?php
				endif;
			?>
		</ol>
		
		<li class='sep'></li>
		
		<label>Novo BBCode</label>
		<div id='bbcSetNavigation'>
			<a href="javascript: void(0)" class="button" id="simple">Tag Simples</a>
			<a href="javascript: void(0)" class="button" id="enhanced">Tag Aprimorada</a>
			<a href="javascript: void(0)" class="button" id="callback">Tag Callback</a>
		</div>
		<fieldset class='simple area' style="display: block">
			<div>
				<label>Nome da Tag</label><br/>
				
				<label>Substituição Inicial</label><br/>
				
				<label>Substituição Final</label><br/>
				<div class="inputBox">
				<?php echo $form->input("tagName", "text"); ?>
				<?php echo $form->input("tagStart", "text"); ?>
				<?php echo $form->input("tagEnd", "text"); ?>
				</div>
			</div>
			
			<?php echo $form->button("createBBC", T("Create BBCode"), array("class" => "big submit")); ?>
		</fieldset>
		<fieldset class='enhanced area'>
			<label>Nome da Tag</label>
			<?php echo $form->input("tagName", "text"); ?>
			<?php echo $form->button("createBBC", T("Create BBCode"), array("class" => "big submit")); ?>
		</fieldset>
		<fieldset class='callback area'>
			<label>Nome da Tag</label>
			<?php echo $form->input("tagName", "text"); ?>
			<?php echo $form->button("createBBC", T("Create BBCode"), array("class" => "big submit")); ?>
		</fieldset>
		
		<li class='sep' style='border-color: transparent'></li>
	</ul>

<?php echo $form->close(); ?>

<script>
$(function() {
	var activeFieldset = "simple";
	
	$("#bbcSetNavigation .button").click(function(e){
		var target = e.target.id;
		if (target == activeFieldset) return;
		$("." + activeFieldset).slideToggle();
		activeFieldset = target;
		$("." + activeFieldset).slideToggle();
	});
});
</script>