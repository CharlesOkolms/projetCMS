<?php
include __DIR__.'/../head.php';
?>
<body id="sitepage">
<?php include module('header');?>

	<div id="content" class="container-fluid">
        <div class="row">
            <div class="column col-md-2 col-md-offset-1">
				<?php include module('menu');?>
            </div>
            <div class="column col-md-7 col-md-offset-1">
				<?php include module('gallery');?>
            </div>
        </div>
	</div>
<?php include module('footer');?>

</body>
</html>
