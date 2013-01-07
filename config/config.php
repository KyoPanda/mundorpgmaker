<?php 
$config["esoTalk.installed"] = true;
$config["esoTalk.version"] = '1.0.0g2';
$config["esoTalk.database.host"] = 'localhost';
$config["esoTalk.database.user"] = 'root';
$config["esoTalk.database.password"] = '';
$config["esoTalk.database.dbName"] = 'esotalk';
$config["esoTalk.database.prefix"] = 'et_';
$config["esoTalk.forumTitle"] = 'Mundo RPG Maker';
$config["esoTalk.baseURL"] = 'http://localhost/esotalk/';
$config["esoTalk.emailFrom"] = 'do_not_reply@localhost';
$config["esoTalk.cookie.name"] = 'Mundo_RPG_Maker';
$config["esoTalk.urls.friendly"] = true;
$config["esoTalk.urls.rewrite"] = true;
$config["BBCode.version"] = '1.0.0g2';
$config["ReportBug.version"] = '1.0.0g2';
$config["esoTalk.admin.lastUpdateCheckTime"] = 1357577010;
$config["esoTalk.admin.welcomeShown"] = true;
$config["esoTalk.language"] = 'Brazilian_Portuguese';
$config["esoTalk.forumLogo"] = false;
$config["esoTalk.defaultRoute"] = 'channels';
$config["esoTalk.registration.open"] = '1';
$config["esoTalk.registration.requireEmailConfirmation"] = '1';
$config["esoTalk.members.visibleToGuests"] = '0';
$config["esoTalk.skin"] = 'MRM4Ever';
$config["esoTalk.mobileSkin"] = 'MRM4Ever';
$config["esoTalk.enabledPlugins"] = array (
  0 => 'BBCode',
  1 => 'ReportBug',
);
$config["Debug.version"] = '1.0.0g2';
$config["skin.MRM4Ever.headerColor"] = '#0A6BBD';
$config["skin.MRM4Ever.bodyColor"] = '#0D7FE7';
$config["skin.MRM4Ever.bodyImage"] = 'uploads/bg.png';
$config["skin.MRM4Ever.noRepeat"] = false;
$config["skin.MRM4Ever.menuLabel"] = array (
  0 => 'Portal',
  1 => 'Fórum',
  2 => 'Downloads',
  3 => 'Resources',
  4 => 'Tutoriais',
  5 => 'Scripts',
  6 => 'Membros',
);
$config["skin.MRM4Ever.menuURL"] = array (
  0 => '/portal',
  1 => '/esotalk',
  2 => '/downloads',
  3 => '/resources',
  4 => '/esotalk/conversations/tutoriais',
  5 => '/esotalk/conversations/scripts',
  6 => '/esotalk/members',
);
$config["BBCode.tags"] = array (
  'b' => 
  array (
    'type' => '0',
    'complex' => false,
    'simple_start' => '<b>',
    'simple_end' => '</b>',
  ),
  'i' => 
  array (
    'type' => 0,
    'complex' => false,
    'simple_start' => '<i>',
    'simple_end' => '</i>',
  ),
  'u' => 
  array (
    'type' => 0,
    'complex' => false,
    'simple_start' => '<span style=\'text-decoration: underline\'>',
    'simple_end' => '</span>',
  ),
  's' => 
  array (
    'type' => 0,
    'complex' => false,
    'simple_start' => '<span style=\'text-decoration: line-through\'>',
    'simple_end' => '</span>',
  ),
  'sup' => 
  array (
    'type' => 0,
    'complex' => false,
    'simple_start' => '<sup>',
    'simple_end' => '</sup>',
  ),
  'sub' => 
  array (
    'type' => 0,
    'complex' => false,
    'simple_start' => '<sub>',
    'simple_end' => '</sub>',
  ),
  'size' => 
  array (
    'type' => 1,
    'complex' => false,
    'template' => '<span style="font-size: {$_default}pt">{$_content}</span>',
    'allow' => 
    array (
      '_default' => '/^[1-8]?[0-9]*$/',
    ),
    'mode' => 4,
  ),
  'color' => 
  array (
    'type' => 1,
    'complex' => false,
    'template' => '<span style="color: {$_default}">{$_content}</span>',
    'allow' => 
    array (
      '_default' => '/(#?([a-f0-9]{3}){1,2})|white|silver|gray|black|red|maroon|yellow|olive|lime|green|aqua|teal|blue|navy|fuchsia|purple/i',
    ),
    'mode' => 4,
  ),
  'font' => 
  array (
    'type' => 1,
    'complex' => false,
    'template' => '<span style="font-family: {$_default};" class="bbc_font">{$_content}</span>',
    'allow' => 
    array (
      '_default' => '/[a-z0-9_,\\-\\s]+?/i',
    ),
    'mode' => 4,
  ),
  'img' => 
  array (
    'type' => 2,
    'complex' => false,
    'mode' => 1,
    'methodBody' => 'if ($action == BBCODE_CHECK) {
return true;
		}
		
		// Replace bad strings
		$badSearch = array(\'/javascript:/i\', \'/about:/i\', \'/vbscript:/i\');
		$badReplace = array(\'javascript<b></b>:\', \'about<b></b>:\', \'vbscript<b></b>:\');
		$content = preg_replace($badSearch, $badReplace, $content);
		
		
		// Parse args
		$args = \'src="\' . $content . \'"\';
		
		foreach ($params as $key => $value){
			switch(strtolower($key)){
			case \'height\':
			case \'width\':
				if (preg_match("/^(\\d)+$/", $value))
					$args .= $key . \'=\' . $value . \'px \';
			
				break;
			
			case \'float\':
				if (preg_match("/^(left|right)$/i", $value))
					$args .= \'style="float: \' . $value . \';"\';
				break;
			}
		}
		
		// Return
		return "<img " . $args . " />";',
  ),
);

// Last updated by: Gab (127.0.0.1) @ Mon, 07 Jan 2013 17:43:30 +0100
?>