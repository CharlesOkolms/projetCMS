<div id="config">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre du site" />


            <label id="div_label" for="mon_id">Super-administrateur : </label>
            <select title="Choix du superadmin" class="form-control" id="superAdmin" >
                <?php
                foreach ( $arrayAdmins as $unPetitAdmin )
                {
                    if ( $unPetitAdmin->isSuperAdmin() )
                    {
                        ?>
                        <option value="<?=$unPetitAdmin->getId();?>" disabled selected><?=$unPetitAdmin->getFirstname();?></option>
                        <?php
                    }
                    else
                    {
                        ?>
                        <option value="<?=$unPetitAdmin->getId();?>"><?=$unPetitAdmin->getFirstname();?></option>
                        <?php
                    }
                }
                ?>
            </select>

        <label id="div_label" for="pageAccueil">Page d'accueil : </label>
        <select title="Choix de la page d'accueil" class="form-control" id="pageAccueil">
            <?php
            $liste = Page::getAll();
            $countI = 0;
            foreach ($liste as $page)
            {
                ?>
                <option value="<?=$page->getId();?>"><?=$page->getTitle();?></option>
                <?php
            }
            ?>
        </select>

        <label id="div_label" for="pieceJointe">Piece jointe : </label>
        <input type="file" name="logo" placeholder="Piece jointe" id="pieceJointe"/>
        <input title="Save the article" type="submit" name="article_add" value="Modifier" class="btn btn-primary navbar-btn" />

    </form>
</div>
