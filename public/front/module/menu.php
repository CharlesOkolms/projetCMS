<?php

$pages = Page::getAll();
?>

<nav class="main_menu">
	<ul>
		<?php
		foreach($pages as $page){ ?>
		<li><?=$page->getTitle()?></li>

		<?php
		} ?>
	</ul>
</nav>
