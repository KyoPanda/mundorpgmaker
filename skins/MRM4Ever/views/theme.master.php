<?php
// Copyright 2011 Toby Zerner, Simon Zerner
// This file is part of esoTalk. Please see the included license file for usage information.

if (!defined("IN_ESOTALK")) exit;

/**
 * Default master view. Displays a HTML template with a header and footer.
 *
 * @package esoTalk
 */
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset='<?php echo T("charset", "utf-8"); ?>'>
		<title><?php echo $data["pageTitle"]; ?></title>
		<?php echo $data["head"]; ?>
                
                <script language="javascript">
                    $(function(){
                        $('#goTop').click(function(){
                            $.scrollTo(0, 350);
                        })
                    });
                </script>
	</head>

	<body class='<?php echo $data["bodyClass"]; ?>'>
            <?php $this->trigger("pageStart"); ?>

            <div id='messages'>
                <?php foreach ($data["messages"] as $message): ?>
                    <div class='messageWrapper'>
			<div class='message <?php echo $message["className"]; ?>' data-id='<?php echo @$message["id"]; ?>'>
				<?php echo $message["message"]; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
    
            <!-- HEADER -->
            <div id='hdr'>
                <div id='hdr-content' class='wrapper clearfix'>
                    <ul id='navigationMenu' class='menu'>
                        <?php echo $this->data["navMenu"]; ?>
                        <!--
                            <?php echo $this->data["userMenuItems"]; ?>
                            <li><a href='<?php echo URL("conversation/start"); ?>' class='link-newConversation button'>
                                <?php echo T("New Conversation"); ?>
                            </a></li>
                        -->
                    </ul>

                    <ul id='mainMenu' class='menu'>
                        <?php if ($data["backButton"]): ?>
                            <li><a href='<?php echo $data["backButton"]["url"]; ?>' id='backButton'>&laquo;<span> 
				<?php echo T("Back to {$data["backButton"]["type"]}"); ?>
                            </span></a></li>
			<?php endif; ?>
			<?php if (!empty($data["mainMenuItems"])) echo $data["mainMenuItems"]; ?>
                    </ul>

                </div>
            </div>
			
            <!-- BODY -->
            <div id='body'>                            
                <!-- LOGO -->
                <div id='logo'>
                    <a href='<?php echo URL(""); ?>'><img src="<?php echo URL($this->data["logoURL"]); ?>"/></a>
                </div>
                <div id='body-content'>
                    <?php echo $data["content"]; ?>
                </div>
            </div>

            <!-- FOOTER -->
            <div id='ftr'>
                <div id='ftr-gotop'>
                    <a id='goTop'></a>
                </div>
                                
                <div id='ftr-body'>
                    <ul class='columns clearfix'>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse semper vulputate metus, non egestas lacus lacinia sed. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus eu metus purus. Nulla metus lacus, fringilla ut faucibus id, varius vitae nulla. In hac habitasse platea dictumst. Suspendisse commodo, elit sed tristique consectetur, orci massa lobortis ipsum, vitae auctor massa justo eu ipsum. Mauris accumsan eros vitae est semper nec pharetra ipsum congue. Duis lobortis porta risus sed sollicitudin. </li>
                        <li> Sed at nulla purus, ut mollis augue. Morbi ligula velit, tempus non auctor ac, consequat sit amet erat. Nunc vitae mauris vel velit faucibus scelerisque feugiat eget eros. Maecenas aliquet tincidunt urna, in pulvinar orci aliquam quis. Nulla ultrices porttitor sapien, eu imperdiet nisi pulvinar sed. Donec posuere, risus a aliquet sagittis, erat enim dignissim sem, ac consequat lectus mi a felis.</li>
                        <li>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse semper vulputate metus, non egestas lacus lacinia sed. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus eu metus purus. Nulla metus lacus, fringilla ut faucibus id, varius vitae nulla. In hac habitasse platea dictumst. Suspendisse commodo, elit sed tristique consectetur, orci massa lobortis ipsum, vitae auctor massa justo eu ipsum. Mauris accumsan eros vitae est semper nec pharetra ipsum congue. Duis lobortis porta risus sed sollicitudin. </li>
                        <li> Sed at nulla purus, ut mollis augue. Morbi ligula velit, tempus non auctor ac, consequat sit amet erat. Nunc vitae mauris vel velit faucibus scelerisque feugiat eget eros. Maecenas aliquet tincidunt urna, in pulvinar orci aliquam quis. Nulla ultrices porttitor sapien, eu imperdiet nisi pulvinar sed. Donec posuere, risus a aliquet sagittis, erat enim dignissim sem, ac consequat lectus mi a felis.</li>
                    </ul>
                </div>
                            
                <div id='ftr-bottom'>
                    <div class='wrapper'>
                        <ul class='menu'>
                            <li id='goToTop'><a href='#'><?php echo T("Go to top"); ?></a></li>
                            <?php echo $data["metaMenuItems"]; ?>
                            <?php if (!empty($data["statisticsMenuItems"])) echo $data["statisticsMenuItems"]; ?>
                        </ul>
                                            
                        <ul class='social'>
                            <li><a href='#'>Facebook</a></li>
                            <li><a href='#'>Twitter</a></li>
                            <li><a href='#'>Youtube</a></li>
                            <li><a href='#'>Facebook</a></li> 
                        </ul>
                    </div>
                </div>
            </div>
            <?php $this->trigger("pageEnd"); ?>

        </div>
    </body>
</html>