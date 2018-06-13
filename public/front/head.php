<?php ?><!DOCTYPE html>
<html>
<head>
	<title><?=TITLE?></title>
	<meta charset="UTF-8" />

	<!--Import style-->
	<link type="text/css" rel="stylesheet" href="<?=CMS_FOLDER?>style/css/bootstrap.min.css"  media="screen,projection"/>

	<link type="text/css" rel="stylesheet" href="<?=FRONT_FOLDER.'style/site.css'?>"  media="screen,projection"/> <!--note: site.css et non style car on fera un css pour le front-->
	<?php if(!is_string($page)){ ?>
	    <link type="text/css" rel="stylesheet" href="<?=FRONT_FOLDER.'style/'.$page->getStyle()?>.css"  media="screen,projection"/>
	<?php } ?>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<meta property="og:title" content="<?=TITLE?>" />
	<meta property="og:description" content="Site d'exemple avec notre CMS !" />
	<meta property="og:type" content="website" />
	<meta property="og:url" content="http://charlesokolms.fr/projetCMS" />
	<meta property="og:image" content="<?=(!empty($meta->getLogo()))?FRONT_FOLDER.$meta->getLogo():'';?>" />
	<meta property="og:image:width" content="400" />
	<meta property="og:image:height" content="400" />

</head>
