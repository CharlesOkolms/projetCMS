<?php


require_once('./conf/top.php');


?>
<head>
    <meta charset="UTF-8"/>
</head>
<body>
	<pre>
<?php // <pre> pour les var_dump..

DB::getInstance();
$user = new User(1);
var_dump($user);


?>
</pre>

</body>
