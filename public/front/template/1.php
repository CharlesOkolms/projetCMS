<?php
include __DIR__.'/../head.php';
?>
<body id="sitepage">
<?php include module('header');?>
	<div id="content" class="container-fluid">
        <div class="row">
            <div class="column col-md-2 col-md-offset-1">
                <?php include module('articles_list');?>
            </div>
            <div class="column col-md-7 col-md-offset-1 well">
                <?php include module('articles_view');?>
            </div>
        </div>
	</div>
<?php include module('footer');?>


</body>
</html>
