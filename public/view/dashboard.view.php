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
                        <a class="navbar-brand" href="#">Pages & Articles récents</a>
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
                        &nbsp;&nbsp;<p class="card-text"><span
                                    class="glyphicon glyphicon-file"></span>&nbsp;<?= $page->getTitle();; ?></p>
                        <?php
                        $countI = 1;
                    }
                    else
                    {
                        ?>
                        <p class="card-text"><span class="glyphicon glyphicon-file"></span>&nbsp;<?= $page->getTitle();; ?></p>
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
                    <a class="navbar-brand" href="#">Vos pages</a>
                </div>
                <p>&nbsp;</p>&nbsp;&nbsp;&nbsp;&nbsp<p class="card-text card-h1">&nbsp;Numero un</p>
                <p class="card-text card-h2">&nbsp;With supporting text below</p>
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
