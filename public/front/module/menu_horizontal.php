<?php

$pages = Page::getAll();
?>
<br/>
<div id="content">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-left">
                    <?php
                    foreach($pages as $page)
                    {
                        ?>
                        <li>
                            <a href="#"><b><?= $page->getTitle();?></b></a>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<br/>
<br/>