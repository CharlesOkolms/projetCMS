<style>
    .card {
        border-radius: 3px;
        border: 2px solid black;
    }

    .card-header {
        border-bottom: 2px solid black;
    }

    #pageContent {
        margin-left: 6%;
    }

    .navbar-brand{float:none;}

    .rowBen {
        display: flex;
    }

    .well {
        overflow: hidden;
        width:390px;
        height:250px;
        margin-bottom: 10%;
    }

    .navbar-header {
        text-align: center;
    }

    .secondWell {
        margin-left: 10%;
    }

</style>

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
                    if ($countI == 0)
                    {
                        ?>
                        &nbsp;&nbsp;<p class="card-text"><span class="glyphicon glyphicon-file"></span>&nbsp;<?= $page->getTitle(); ?></p>
                        <?php
                        $countI = 1;
                    }
                    else
                    {
                        ?>
                        <p class="card-text"><span class="glyphicon glyphicon-file"></span>&nbsp;<?= $page->getTitle(); ?></p>
                        <?php
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
                    <a class="navbar-brand" href="#">Vos articles</a>
                </div>
                <p>&nbsp;</p>
                <?php
                $lesArticles = Article::getAll();
                $tonIdAdmin = $lesArticles[CURRENT_USER_ID]['writer'];
                $countI = 0;
                foreach ($lesArticles as $unArticle)
                {
                    if ($countI == 0)
                    {
                        ?>
                        &nbsp;&nbsp;&nbsp;<p class="card-text card-h1">&nbsp;<?= $lesArticles[$tonIdAdmin]['title']; ?></p>
                        <?php
                        $countI = 1;
                    }
                    else
                    {
                        ?>
                        <p class="card-text card-h2">&nbsp;<?= $lesArticles[$tonIdAdmin]['title']; ?></p>
                        <?php
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