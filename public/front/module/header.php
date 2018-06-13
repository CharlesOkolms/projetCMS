<div id="header">
	<img id="sitelogo" src="<?=(!empty($meta->getLogo()))?FRONT_FOLDER.$meta->getLogo():'';?>"/>
	<h1 id="sitename"><?=SITE_TITLE?></h1>
	<?php include module('menu');?>
</div>
