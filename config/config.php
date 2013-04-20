<?php
$config["esoTalk.installed"] = true;
$config["esoTalk.version"] = '1.0.0g2';
$config["esoTalk.database.host"] = 'localhost';
$config["esoTalk.database.user"] = 'root';
$config["esoTalk.database.password"] = '';
$config["esoTalk.database.dbName"] = 'esotalk';
$config["esoTalk.database.prefix"] = 'et_';
$config["esoTalk.forumTitle"] = 'Mundo RPG Maker';
$config["esoTalk.baseURL"] = 'http://localhost:8887/esotalk/index.php/install/';
$config["esoTalk.emailFrom"] = 'do_not_reply@localhost:8887';
$config["esoTalk.cookie.name"] = 'Mundo_RPG_Maker';
$config["esoTalk.urls.friendly"] = true;
$config["esoTalk.urls.rewrite"] = true;
$config["BBCode.version"] = '1.0.0g2';
$config["ReportBug.version"] = '1.0.0g2';
$config["esoTalk.admin.lastUpdateCheckTime"] = 1366480708;
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
$config["skin.MRM4Ever.bodyColor"] = '#FFFFFF';
$config["skin.MRM4Ever.bodyImage"] = false;
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
  'i' => 
  array (
    'type' => 0,
    'active' => true,
    'complex' => false,
    'simple_start' => '<i>',
    'simple_end' => '</i>',
  ),
  'u' => 
  array (
    'type' => 0,
    'active' => true,
    'complex' => false,
    'simple_start' => '<span style=\'text-decoration: underline\'>',
    'simple_end' => '</span>',
  ),
  's' => 
  array (
    'type' => 0,
    'active' => true,
    'complex' => false,
    'simple_start' => '<span style=\'text-decoration: line-through\'>',
    'simple_end' => '</span>',
  ),
  'sup' => 
  array (
    'type' => 0,
    'active' => true,
    'complex' => false,
    'simple_start' => '<sup>',
    'simple_end' => '</sup>',
  ),
  'sub' => 
  array (
    'type' => 0,
    'active' => true,
    'complex' => false,
    'simple_start' => '<sub>',
    'simple_end' => '</sub>',
  ),
  'color' => 
  array (
    'type' => 1,
    'active' => true,
    'complex' => false,
    'template' => '<span style="color: {$_default}">{$_content}</span>',
    'allow' => 
    array (
      '_default' => '/(#?([a-f0-9]{3}){1,2})|white|silver|gray|black|red|maroon|yellow|olive|lime|green|aqua|teal|blue|navy|fuchsia|purple/i',
    ),
    'mode' => 4,
  ),
  'b' => 
  array (
    'type' => 0,
    'active' => true,
    'complex' => false,
    'simple_start' => '<b>',
    'simple_end' => '</b>',
  ),
  'img' => 
  array (
    'type' => 2,
    'active' => true,
    'complex' => false,
    'mode' => 1,
    'methodBody' => 'aWYgKCRhY3Rpb24gPT0gQkJDT0RFX0NIRUNLKSByZXR1cm4gdHJ1ZTsNCg0KJGJhZFNlYXJjaCA9IGFycmF5KCcvamF2YXNjcmlwdDovaScsICcvYWJvdXQ6L2knLCAnL3Zic2NyaXB0Oi9pJyk7DQokYmFkUmVwbGFjZSA9IGFycmF5KCdqYXZhc2NyaXB0PGI+PC9iPjonLCAnYWJvdXQ8Yj48L2I+OicsICd2YnNjcmlwdDxiPjwvYj46Jyk7DQoNCiRjb250ZW50ID0gcHJlZ19yZXBsYWNlKCRiYWRTZWFyY2gsICRiYWRSZXBsYWNlLCAkY29udGVudCk7DQokYXJncyA9ICdzcmM9IicgLiAkY29udGVudCAuICciJzsNCg0KZm9yZWFjaCAoJHBhcmFtcyBhcyAka2V5ID0+ICR2YWx1ZSl7DQoJc3dpdGNoKHN0cnRvbG93ZXIoJGtleSkpew0KCWNhc2UgJ2hlaWdodCc6DQoJY2FzZSAnd2lkdGgnOg0KCQlpZiAocHJlZ19tYXRjaCgiL14oXGQpKyQvIiwgJHZhbHVlKSkNCgkJCSRhcmdzIC49ICRrZXkgLiAnPScgLiAkdmFsdWUgLiAncHggJzsNCgkJYnJlYWs7DQoJY2FzZSAnZmxvYXQnOg0KCQlpZiAocHJlZ19tYXRjaCgiL14obGVmdHxyaWdodCkkL2kiLCAkdmFsdWUpKQ0KCQkJJGFyZ3MgLj0gJ3N0eWxlPSJmbG9hdDogJyAuICR2YWx1ZSAuICc7Iic7DQoJCWJyZWFrOw0KCX0NCn0NCg0KcmV0dXJuICI8aW1nICRhcmdzIC8+Ijs=',
  ),
  'code' => 
  array (
    'active' => true,
    'type' => 2,
    'complex' => false,
    'mode' => 1,
    'methodBody' => 'aWYgKCRhY3Rpb24gPT0gQkJDT0RFX0NIRUNLKSByZXR1cm4gdHJ1ZTsNCg0KJGh0bWxjb250ZW50ID0gIjxwcmUgY2xhc3M9J2JydXNoOiAiOw0KaWYgKCRkZWZhdWx0KXsNCiAgICAgICAgJGh0bWxjb250ZW50IC49ICIkZGVmYXVsdCI7DQp9DQokaHRtbGNvbnRlbnQgLj0gIic+IjsNCiRodG1sY29udGVudCAuPSB0cmltKGJyMm5sKCRjb250ZW50KSk7DQokaHRtbGNvbnRlbnQgLj0gIjwvcHJlPiI7DQoNCnJldHVybiAkaHRtbGNvbnRlbnQ7',
    'content' => 2,
  ),
  'right' => 
  array (
    'active' => true,
    'type' => 0,
    'complex' => false,
    'simple_start' => '<div align=\'right\'>',
    'simple_end' => '</div>',
  ),
  'left' => 
  array (
    'active' => true,
    'type' => 0,
    'complex' => false,
    'simple_start' => '<div align=\'left\'>',
    'simple_end' => '</div>',
  ),
  'center' => 
  array (
    'active' => true,
    'type' => 0,
    'complex' => false,
    'simple_start' => '<div align=\'center\'>',
    'simple_end' => '</div>',
  ),
  'quote' => 
  array (
    'type' => 2,
    'active' => true,
    'complex' => false,
    'mode' => 1,
    'methodBody' => 'aWYgKCRhY3Rpb24gPT0gQkJDT0RFX0NIRUNLKSByZXR1cm4gdHJ1ZTsNCg0KaWYgKCRkZWZhdWx0IGFuZCBzdHJwb3MoJGRlZmF1bHQsICI6IikgIT09IGZhbHNlKQ0KCWxpc3QoJHBvc3RJZCwgJGNpdGF0aW9uKSA9IGV4cGxvZGUoIjoiLCAkZGVmYXVsdCk7DQoNCiRxdW90ZSA9ICI8YmxvY2txdW90ZT48cD4iOw0KDQppZiAoIWVtcHR5KCRwb3N0SWQpKSAkcXVvdGUgLj0gIjxhIGhyZWY9JyIuVVJMKHBvc3RVUkwoJHBvc3RJZCkpLiInIHJlbD0ncG9zdCcgZGF0YS1pZD0nJHBvc3RJZCcgY2xhc3M9J2NvbnRyb2wtc2VhcmNoIHBvc3RSZWYnPiIuVCgiRmluZCB0aGlzIHBvc3QiKS4iPC9hPiAiOw0KDQovLyBJZiB0aGVyZSBpcyBhIGNpdGF0aW9uLCBhZGQgaXQuDQppZiAoIWVtcHR5KCRjaXRhdGlvbikpew0KICAgICAgICAkcXVvdGUgLj0gIjxjaXRlPiI7DQogICAgICAgICRxdW90ZSAuPSAkY2l0YXRpb247DQogICAgICAgICRxdW90ZSAuPSAiPC9jaXRlPiI7DQp9DQoNCi8vIEZpbmlzaCBjb25zdHJ1Y3RpbmcgYW5kIHJldHVybiB0aGUgcXVvdGUuDQokcXVvdGUgLj0gIiRjb250ZW50PC9wPjwvYmxvY2txdW90ZT4iOw0KcmV0dXJuICRxdW90ZTs=',
  ),
  'size' => 
  array (
    'active' => true,
    'type' => 2,
    'complex' => false,
    'mode' => 1,
    'methodBody' => 'aWYgKCRhY3Rpb24gPT0gQkJDT0RFX0NIRUNLKSByZXR1cm4gdHJ1ZTsNCg0KaWYgKHByZWdfbWF0Y2goIi9eKFsxLThdP1swLTldKShwdHxweHxlbSk/JC9pIiwgJGRlZmF1bHQsICRtYXRjaGVzKSl7DQoNCiAgJHNpemUgPSAkbWF0Y2hlc1sxXTsNCiAgJG1ldHIgPSAkbWF0Y2hlc1syXSA/ICRtYXRjaGVzWzJdIDogImVtIjsNCg0KICBpZiAoJG1ldHIgPT0gImVtIiBhbmQgJHNpemUgPiA5KSAkc2l6ZSA9IDk7DQoNCiAgJGh0bWwgPSAiPHNwYW4gc3R5bGU9J2ZvbnQtc2l6ZTogIjsNCiAgJGh0bWwgLj0gIiRzaXplJG1ldHInID4kY29udGVudDwvc3Bhbj4iOw0KICByZXR1cm4gJGh0bWw7DQoNCn0gZWxzZSB7DQogIHJldHVybiAkY29udGVudDsNCn0=',
  ),
  'hr' => 
  array (
    'active' => true,
    'type' => 0,
    'complex' => false,
    'simple_start' => '<hr/>',
    'simple_end' => '',
  ),
);

// Last updated by: Gab (127.0.0.1) @ Sat, 20 Apr 2013 19:58:28 +0200
?>