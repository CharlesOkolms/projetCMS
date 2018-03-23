<?php


require_once('./conf/top.php');



?><head>
	<meta charset="UTF-8" />
</head><?php

DB::getInstance();

var_dump(DB::getInstance()->query('select * from test',array()));
