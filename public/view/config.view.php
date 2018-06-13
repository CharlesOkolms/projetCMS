<div id="config">
    <form method="POST"  enctype="multipart/form-data">
        <input type="text" name="title" placeholder="Titre du site" value="<?php echo $meta->getTitle();?>"/>


            <label id="div_label" for="mon_id">Super-administrateur : </label>
            <select title="Choix du superadmin" class="form-control" id="superAdmin" name="superAdmin">
                <?php
                foreach ( $arrayAdmins as $unPetitAdmin )
                {
                   ?>
                    <option value="<?=$unPetitAdmin->getId();?>" <?=($unPetitAdmin->isSuperAdmin())?'selected':''?> ><?=$unPetitAdmin->getFirstname().' '.$unPetitAdmin->getLastname();?></option>
                    <?php
                }
                ?>
            </select>

        <label id="div_label" for="pageAccueil">Page d'accueil : </label>
        <select title="Choix de la page d'accueil" class="form-control" id="pageAccueil" name="pageAccueil">
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

        <label id="div_label" for="logo">Logo : </label>
        <input type="file" name="logo" placeholder="Logo" id="pieceJointe"/>
        <input title="Save the article" type="submit" name="config_add" value="Modifier" class="btn btn-primary navbar-btn" />

    </form>
</div>
