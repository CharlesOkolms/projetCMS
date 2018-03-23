<?php
session_start();
require_once('./conf/top.php');
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

}

?>
</body>
