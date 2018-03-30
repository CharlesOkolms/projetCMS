<?php
session_start();
require_once('./conf/top.php');
require('view/connexionView.php');
?>
<body>
<?php

if ( !empty($_GET['page']) ) {

	switch ($_GET['page']) {
		default:
			include_once controller($_GET['page']);
		break;
	}


}
else {
	// do nothing
}

?>
</body>
