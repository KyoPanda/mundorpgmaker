<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

ET::$pluginInfo["BBCode"] = array(
	"name" => "BBCode",
	"description" => "Formats BBCode within posts, allowing users to style their text.",
	"version" => ESOTALK_VERSION,
	"author" => "esoTalk Team",
	"authorEmail" => "support@esotalk.org",
	"authorURL" => "http://esotalk.org",
	"license" => "GPLv2",
);


// NBBC Engine
require_once('NBBC.php');

/**
 * BBCode Formatter Plugin
 *
 * Interprets BBCode in posts and converts it to HTML formatting when rendered. Also adds BBCode formatting
 * buttons to the post editing/reply area.
 */
class ETPlugin_BBCode extends ETPlugin {


/**
 * Add an event handler to the initialization of the conversation controller to add BBCode CSS and JavaScript
 * resources.
 *
 * @return void
 */
public function handler_conversationController_renderBefore($sender)
{
	$sender->addJSFile($this->getResource("bbcode.js"));
	$sender->addCSSFile($this->getResource("bbcode.css"));
}


/**
 * Add an event handler to the "getEditControls" method of the conversation controller to add BBCode
 * formatting buttons to the edit controls.
 *
 * @return void
 */
public function handler_conversationController_getEditControls($sender, &$controls, $id)
{
	addToArrayString($controls, "fixed", "<a href='javascript:BBCode.fixed(\"$id\");void(0)' title='".T("Fixed")."' class='bbcode-fixed'><span>".T("Fixed")."</span></a>", 0);
	addToArrayString($controls, "image", "<a href='javascript:BBCode.image(\"$id\");void(0)' title='".T("Image")."' class='bbcode-img'><span>".T("Image")."</span></a>", 0);
	addToArrayString($controls, "link", "<a href='javascript:BBCode.link(\"$id\");void(0)' title='".T("Link")."' class='bbcode-link'><span>".T("Link")."</span></a>", 0);
	addToArrayString($controls, "strike", "<a href='javascript:BBCode.strikethrough(\"$id\");void(0)' title='".T("Strike")."' class='bbcode-s'><span>".T("Strike")."</span></a>", 0);
	addToArrayString($controls, "italic", "<a href='javascript:BBCode.italic(\"$id\");void(0)' title='".T("Italic")."' class='bbcode-i'><span>".T("Italic")."</span></a>", 0);
	addToArrayString($controls, "bold", "<a href='javascript:BBCode.bold(\"$id\");void(0)' title='".T("Bold")."' class='bbcode-b'><span>".T("Bold")."</span></a>", 0);
}


/**
 * Add an event handler to the formatter to take out and store code blocks before formatting takes place.
 *
 * @return void
 */
public function handler_format_beforeFormat($sender)
{
	return;
	// Block-level [fixed] tags will become <pre>.
	$this->blockFixedContents = array();
	$hideFixed = create_function('&$blockFixedContents, $contents', '
		$blockFixedContents[] = $contents;
		return "</p><pre></pre><p>";');
	$regexp = "/(.*)^\[code\]\n?(.*?)\n?\[\/code]$/imse";
	while (preg_match($regexp, $sender->content)) $sender->content = preg_replace($regexp, "'$1' . \$hideFixed(\$this->blockFixedContents, '$2')", $sender->content);

	// Inline-level [fixed] tags will become <code>.
	$this->inlineFixedContents = array();
	$hideFixed = create_function('&$inlineFixedContents, $contents', '
		$inlineFixedContents[] = $contents;
		return "<code></code>";');
	$sender->content = preg_replace("/\[code\]\n?(.*?)\n?\[\/code]/ise", "\$hideFixed(\$this->inlineFixedContents, '$1')", $sender->content);
}


/**
 * Add an event handler to the formatter to parse BBCode and format it into HTML.
 *
 * @return void
 */
public function handler_format_format($sender)
{
	
	$bbcode = new BBCode;
	
	$bbcode->SetEnableSmileys(false);
	
	$bbcodeList = C("BBCode.tags");
	$bbcodeList = $bbcodeList ? $bbcodeList : array();
	foreach($bbcodeList as $name => $tag){
		if (($sender->basic && $tag['complex']) || (!$tag['active']))
			continue;
			
		if ($tag['type'] == 2){
			$tag['method'] = create_function(
				'$bbcode, $action, $name, $default, $params, $content',
				stripslashes(base64_decode($tag['methodBody']))
			);
		}
		$bbcode->addRule($name, $tag);
	}
	// Registra modificações
	$sender->content = html_entity_decode($bbcode->Parse($sender->content));
}

/**
 * Add an event handler to the formatter to put code blocks back in after formatting has taken place.
 *
 * @return void
 */
public function handler_format_afterFormat($sender)
{
	// Retrieve the contents of the inline <code> tags from the array in which they are stored.
	$sender->content = preg_replace("/<code><\/code>/ie", "'<code>' . array_shift(\$this->inlineFixedContents) . '</code>'", $sender->content);

	// Retrieve the contents of the block <pre> tags from the array in which they are stored.
	$sender->content = preg_replace("/<pre><\/pre>/ie", "'<pre>' . array_pop(\$this->blockFixedContents) . '</pre>'", $sender->content);
}

/**
 * Construct and process the settings form for this plugin, and return the path to the view that should be 
 * rendered.
 * 
 * @param ETController $sender The page controller.
 * @return string The path to the settings view to render.
 */
public function settings($sender)
{
	// Inicia o formulário
	$form = ETFactory::make("form");
	$form->action = URL("admin/plugins/settings/BBCode");
	
        // Envia formulário para view
        $sender->data("pluginSettingsForm", $form);
        
        // Tags definidas
        $definedTags = C('BBCode.tags');
        if (!$definedTags) $definedTags = array();
        
        // Se o formulário de criação foi enviado
	if ($form->validPostBack()){
            if ($form->isPostBack("createBBC")) {
		$name = $form->getValue("tagName");
		$type = (int)$form->getValue('tagType');
		
		$tag  = array(
                        'active'  => true,
			'type'    => $type,
			'complex' => (bool)$form->getValue("tagComplex")
		);
		
		switch ($type){
                case 0: // TAG SIMPLES
                        $tag['simple_start'] = $form->getValue('tagStart');
                        $tag['simple_end']   = $form->getValue('tagEnd');
                        break;
                case 1: // TAG APRIMORADA
                        $tag['template'] = $form->getValue('tagTemplate');
                        $tag['allow']    = array();
                        $tag['mode']     = BBCODE_MODE_ENHANCED;

                        $names = $form->getValue('tagAttrName');
                        $rgxps = $form->getValue('tagAttrRgx' );
                        foreach ($names as $id => $attrName){
                                $rgx = $rgxps[$id];
                                if (empty($attrName) or (@preg_match($rgx, '') === false))
                                        continue;

                                $tag['allow'][$attrName] = $rgx;
                        }

                        break;
                case 2: // TAG C/ CALLBACK
                        $tag['mode'] = BBCODE_MODE_CALLBACK;
                        $tag['methodBody'] = base64_encode($form->getValue('tagFunction'));
                        break;
		}
		
		$definedTags[$name] = $tag;
		$config = array('BBCode.tags' => $definedTags);
		ET::writeConfig($config);       
            } elseif ($form->isPostBack("modifyBBCQuery")){ // Se o formulário de modificação foi enviado
                // Define array com informações necessárias
                $name    = $form->getValue('modifyBBCQuery');
                $tag     = array('name' => $name);
                $tagData = array_merge($tag, $definedTags[$name]);
                if ($tagData['type'] == 2)
                    $tagData['methodBody'] = stripslashes(base64_decode($tagData['methodBody']));

                // Envia bbcode
                $sender->data("bbcode", $tagData);

                // CSS para página de modificação
                $sender->addCSSFile($this->getResource("modifyStyles.css"));

                // Retorna view
                return $this->getView('modify');
            } else {
                $origName    = $form->getValue("tagOrigName");
                if (isset($definedTags[$origName])){
                    $tag         = $definedTags[$origName];
                    $name        = $form->getValue("tagName");
                    $complex     = $form->getValue("tagComplex");
                    $writeConfig = false;

                    if ($form->isPostBack("modifyBBC")){ // Se ocorreu uma modificação na tag
                        $type = $tag['type'];
                        
                        switch ($type){
                        case 0: // TAG SIMPLES
                                $tag['simple_start'] = $form->getValue('tagStart');
                                $tag['simple_end']   = $form->getValue('tagEnd');
                                break;
                        case 1: // TAG APRIMORADA
                                $tag['template'] = $form->getValue('tagTemplate');
                                $tag['allow']    = array();
                                
                                $names = $form->getValue('tagAttrName');
                                $rgxps = $form->getValue('tagAttrRgx' );
                                foreach ($names as $id => $attrName){
                                        $rgx = $rgxps[$id];
                                        if (empty($attrName) or (@preg_match($rgx, '') === false))
                                                continue;

                                        $tag['allow'][$attrName] = $rgx;
                                }

                                break;
                        case 2: // TAG C/ CALLBACK
                                $tag['methodBody'] = base64_encode($form->getValue('tagFunction'));
                                break;
                        }
                        
                        unset($definedTags[$origName]);
                        $definedTags[$name] = $tag;
                        $writeConfig = true;
                        
                    } elseif ($form->isPostBack("deleteBBC")){ // Se a tag deve ser deletada
                        unset($definedTags[$origName]);
                        $writeConfig = true;
                    } elseif ($form->isPostBack("activateBBC")){ // Se a tag deve ser ativada
                        $definedTags[$origName]['active'] = true;
                        $writeConfig = true;
                    } elseif ($form->isPostBack("deactivateBBC")){ // Se a tag deve ser desativada
                        $definedTags[$origName]['active'] = false;
                        $writeConfig = true;
                    }

                    if ($writeConfig){
                        $config = array('BBCode.tags' => $definedTags);
                        ET::writeConfig($config);
                    }
                }
            }
        }
        
        // Determina informações necessárias para rederizar formulário
        $sender->data("bbcodes", $definedTags);

        // Adiciona CSS
        $sender->addCSSFile($this->getResource("settingsStyles.css"));
	
	// Renderiza view
	return $this->getView('settings');
}

}
