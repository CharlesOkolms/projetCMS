<?php
include __DIR__.'/../head.php';
?>
<body id="sitepage">
<div id="header">
	<img src="<?=FRONT_FOLDER?>sitelogo.png"/>
	<h1 id="sitename">Nom du site</h1>
	<?php include module('menu_horizontal');?>
</div>
<div id="content" class="container-fluid">
	<div class="row">
		<div class="column col-md-8 col-md-offset-2">

			<div class="article">
				<div class="title">Article : <?=$article->getTitle()?></div>
					<article><?=$article->getContent()?></article>
			</div>

		</div>
	</div>
</div>
<div id="footer" class="row">
	(c) BCCP CMS
</div>

</body>
</html>
