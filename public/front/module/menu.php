<?php

$pages = Page::getAll();
?>



<nav class="main_menu horizontal">
    <div class="container" id="menu">
        <ul class="nav nav-pills nav-stacked" role="tablist">
		    <?php foreach($pages as $page){ ?>
                <li><a href="#"><?=$page->getTitle()?></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>
