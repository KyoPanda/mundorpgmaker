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
$config["esoTalk.admin.lastUpdateCheckTime"] = 1358799686;
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
    'methodBody' => 'aWYgKCRhY3Rpb24gPT0gQkJDT0RFX0NIRUNLKSByZXR1cm4gdHJ1ZTsNCg0KJGJhZFNlYXJjaCA9IGFycmF5KCcvamF2YXNjcmlwdDovaScsICcvYWJvdXQ6L2knLCAnL3Zic2NyaXB0Oi9pJyk7DQokYmFkUmVwbGFjZSA9IGFycmF5KCdqYXZhc2NyaXB0PGI+PC9iPjonLCAnYWJvdXQ8Yj48L2I+OicsICd2YnNjcmlwdDxiPjwvYj46Jyk7DQoNCiRjb250ZW50ID0gcHJlZ19yZXBsYWNlKCRiYWRTZWFyY2gsICRiYWRSZXBsYWNlLCAkY29udGVudCk7DQokYXJncyA9IFwnc3JjPSJcJyAuICRjb250ZW50IC4gXCciXCc7DQoNCmZvcmVhY2ggKCRwYXJhbXMgYXMgJGtleSA9PiAkdmFsdWUpew0KCXN3aXRjaChzdHJ0b2xvd2VyKCRrZXkpKXsNCgljYXNlIFwnaGVpZ2h0XCc6DQoJY2FzZSBcJ3dpZHRoXCc6DQoJCWlmIChwcmVnX21hdGNoKCIvXihcXGQpKyQvIiwgJHZhbHVlKSkNCgkJCSRhcmdzIC49ICRrZXkgLiBcJz1cJyAuICR2YWx1ZSAuIFwncHggXCc7DQoJCWJyZWFrOw0KCWNhc2UgXCdmbG9hdFwnOg0KCQlpZiAocHJlZ19tYXRjaCgiL14obGVmdHxyaWdodCkkL2kiLCAkdmFsdWUpKQ0KCQkJJGFyZ3MgLj0gXCdzdHlsZT0iZmxvYXQ6IFwnIC4gJHZhbHVlIC4gXCc7IlwnOw0KCQlicmVhazsNCgl9DQp9DQoNCnJldHVybiAiPGltZyAkYXJncyAvPiI7',
  ),
  'quote' => 
  array (
    'type' => 2,
    'complex' => false,
    'mode' => 1,
    'methodBody' => 'aWYgKCRhY3Rpb24gPT0gQkJDT0RFX0NIRUNLKSByZXR1cm4gdHJ1ZTsNCg0KaWYgKCRkZWZhdWx0IGFuZCBzdHJwb3MoJGRlZmF1bHQsICI6IikgIT09IGZhbHNlKQ0KCWxpc3QoJHBvc3RJZCwgJGNpdGF0aW9uKSA9IGV4cGxvZGUoIjoiLCAkZGVmYXVsdCk7DQoNCiRxdW90ZSA9ICI8YmxvY2txdW90ZT48cD4iOw0KDQppZiAoIWVtcHR5KCRwb3N0SWQpKSB7DQoJJHF1b3RlIC49ICI8YSBocmVmPVwnIjsNCgkkcXVvdGUgLj0gVVJMKHBvc3RVUkwoJHBvc3RJZCkpOw0KCSRxdW90ZSAuPSAiXCcgcmVsPVwncG9zdFwnIGRhdGEtaWQ9XCckcG9zdElkXCcgY2xhc3M9XCdjb250cm9sLXNlYXJjaCBwb3N0UmVmXCc+IjsNCgkkcXVvdGUgLj0gVCgiRmluZCB0aGlzIHBvc3QiKTsNCgkkcXVvdGUgLj0gIjwvYT4gIjsNCn0NCg0KaWYgKCFlbXB0eSgkY2l0YXRpb24pKXsNCgkkcXVvdGUgLj0gIjxjaXRlPiI7DQoJJHF1b3RlIC49IGJhc2U2NF9kZWNvZGUoJGNpdGF0aW9uKTsNCgkkcXVvdGUgLj0gIjwvY2l0ZT4iOw0KfQ0KDQokcXVvdGUgLj0gJGNvbnRlbnQ7DQokcXVvdGUgLj0gIjwvcD48L2Jsb2NrcXVvdGU+IjsNCg0KcmV0dXJuICRxdW90ZTs=',
  ),
);

// Last updated by: Gab (127.0.0.1) @ Tue, 22 Jan 2013 00:27:32 +0100
?>