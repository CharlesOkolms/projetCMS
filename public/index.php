<!DOCTYPE html>
<?php
session_start();
require_once('./conf/top.php');
include REL_ROOT."BGHeader.php";
?>
<body>
<?php
if(!empty($_GET['page'])){

	switch($_GET['page']){
		default:
			include_once(REL_CTRLS.$_GET['page'].'Controller.php');
		break;
	}


}else{
	include REL_VIEWS."1accueilView.php";
}

?>

<html>
<head>
    <meta http-equiv="refresh" content="0;url=pages/index.html">
    <title>SB Admin 2</title>
    <script language="javascript">
        window.location.href = "pages/index.html"
    </script>
</head>
<body>
Go to <a href="pages/index.html">/pages/index.html</a>
</body>
</html>

</body>
