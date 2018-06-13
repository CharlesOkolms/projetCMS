
<div class="rowBen">
    <div class="firstWell">
        <div class="well">
            <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">Pages récentes</a>
                    </div>
                    <p>&nbsp;</p>
                <?php
                $liste = Page::getAll();
                $countI = 0;
                foreach ($liste as $page)
                {
                    ?>
                    <p class="card-text"><span class="glyphicon glyphicon-file"></span>&nbsp;<?= $page->getTitle(); ?></p>
                    <?php

                    $countI ++;

                    if ($countI == 5)
                    {
                        break;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="secondWell">
        <div class="well">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Les articles récents</a>
                </div>
                <p>&nbsp;</p>
                <?php
                $lesArticles = Article::getAll();
                $tonIdAdmin = $lesArticles[CURRENT_USER_ID]['writer'];
                $countI = 0;
                foreach ($lesArticles as $unArticle)
                {

                    ?>
                    <p class="card-text card-h2"><a href="./../index.php?article=<?= $countI ?>"><?= $lesArticles[$countI]['title']; ?></a></p>
                    <?php

                    $countI ++;

                    if ($countI == 5)
                    {
                        break;
                    }

                }
                ?>
            </div>
        </div>
    </div>
</div>

<br/>

<div class="rowBen">
    <div class="firstWell">
        <div class="well">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Comptes administrateurs</a>
                </div>
                <p>&nbsp;</p>
				<?php
				foreach ( $arrayAdmins as $unPetitAdmin ) {
					if ( $unPetitAdmin->isSuperAdmin() ) { ?>
                        <p class="card-text"><span
                                    class="glyphicon glyphicon-star-empty"></span>&nbsp;<?=$unPetitAdmin->getFirstname();?>
                        </p> <?php
					}
					else { ?>
                        <p class="card-text"><span
                                    class="glyphicon glyphicon-star"></span>&nbsp;<?=$unPetitAdmin->getFirstname();?>
                        </p> <?php
					}
				}
				?>
            </div>
        </div>
    </div>
    <div class="secondWell">
        <div class="well">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Statistiques principales</a>
                </div>
                <p>&nbsp;</p>
            </div>
        </div>
    </div>
</div>