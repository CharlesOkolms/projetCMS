<?php

$pages = Page::getAll();
?>

<nav class="main_menu">
    <div class="container" id="menu">
        <ul class="nav nav-pills nav-stacked" role="tablist">
            <?php foreach($pages as $page){ ?>
                <li><a href="?page=<?= $page->getSlug();?>"><?=$page->getTitle();?></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>