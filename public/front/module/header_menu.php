<div id="header">
	<a href="./"><img id="sitelogo" src="<?=(!empty($meta->getLogo()))?FRONT_FOLDER.$meta->getLogo():'';?>"/></a>
	<h1 id="sitename"><?=SITE_TITLE?></h1>
	<?php include module('menu_horizontal');?>
</div>
