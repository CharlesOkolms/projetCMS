<?php
include __DIR__.'/../head.php';
?>
<body id="sitepage">
	<div id="header">
		<img src="./front/sitelogo.png"/>
		<h1 id="sitename">Nom du site</h1>
		<?php include module('menu');?>
	</div>
	<div id="content" class="container-fluid">
        <div class="row">
            <div class="column col-md-2 col-md-offset-1">
                <?php include module('articles_list');?>
            </div>
            <div class="column col-md-7 col-md-offset-1">
                <?php include module('articles_view');?>
            </div>
        </div>
	</div>
	<div id="footer" class="row">
		(c) BCCP CMS
	</div>

</body>
</html>