<?php
// Copyright 2013+ Gabriel "Gab!" Teles
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * This controller displays the moderation section of the admin CP.
 *
 * @package esoTalk
 */
class ETModerationAdminController extends ETAdminController {
    
    public function index(){
        $this->addJSFile('js/lib/dualSlider/jshashtable-2.1_src.js');
        $this->addJSFile('js/lib/dualSlider/jquery.numberformatter-1.2.3.js');
        $this->addJSFile('js/lib/dualSlider/tmpl.js');
        $this->addJSFile('js/lib/dualSlider/jquery.dependClass-0.1.js');
        $this->addJSFile('js/lib/dualSlider/draggable-0.1.js');
        $this->addJSFile('js/lib/dualSlider/jquery.slider.js');
        $this->addJSFile('js/lib/jquery.ui.js');
        $this->addJSFile('js/lib/spinner/jquery.spinner.min.js');
        $this->addJSFile("js/lib/farbtastic/farbtastic.js");
        
        $this->addCSSFile('js/lib/dualSlider/jslider.css');
        $this->addCSSFile('js/lib/dualSlider/jslider.plastic.css');
        $this->addCSSFile('js/lib/spinner/jquery.spinner.css');
        $this->addCSSFile("js/lib/farbtastic/farbtastic.css");
	
        
        $warnLevels = C('esoTalk.warnLevels');
        
        $form = ETFactory::make('form');
        $form->action = URL('admin/moderation');
        $form->setValue('warnLevels', $warnLevels[2][0] . ";" . $warnLevels[3][0]);
        $form->setValue('monitoredPicker', $warnLevels[1][1]);
        $form->setValue('moderatedPicker', $warnLevels[2][1]);
        $form->setValue('mutePicker',      $warnLevels[3][1]);
        
        if ($form->validPostBack("save")) {	
            $config = array();
            
            $warnsBack = explode(';', $form->getValue('warnLevels'));
            
            $config['esoTalk.warnLevels'] = array(
              0 => array(
                  0 => 0,
                  1 => '#020202',
              ),
                
              1 => array(
                  0 => 5,
                  1 => $form->getValue('monitoredPicker')
              ),
                
              2 => array(
                  0 => $warnsBack[0],
                  1 => $form->getValue('moderatedPicker')
              ),
                
              3 => array(
                  0 => $warnsBack[1],
                  1 => $form->getValue('mutePicker')
              )
            );
            
            if (!$form->errorCount()) {
			// Write the config file.
			ET::writeConfig($config);

			$this->message(T("message.changesSaved"), "success");
			$this->redirect(URL("admin/moderation"));
		}
        }
        
        $this->data("form", $form);
        $this->data("warnLevels", $warnLevels);
        
	$this->render('admin/moderation');
    }
}

?>