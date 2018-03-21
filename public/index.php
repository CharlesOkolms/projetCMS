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
</body>
