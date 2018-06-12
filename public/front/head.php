<?php ?><!DOCTYPE html>
<html>
<head>
	<title><?=$page->getTitle()?></title>
	<meta charset="UTF-8" />

	<!--Import style-->
	<link type="text/css" rel="stylesheet" href="<?=CMS_FOLDER?>style/css/bootstrap.min.css"  media="screen,projection"/>

	<link type="text/css" rel="stylesheet" href="<?=FRONT_FOLDER.'style/site.css'?>"  media="screen,projection"/> <!--note: site.css et non style car on fera un css pour le front-->
	<link type="text/css" rel="stylesheet" href="<?=FRONT_FOLDER.'style/'.$page->getStyle()?>.css"  media="screen,projection"/>
</head>
