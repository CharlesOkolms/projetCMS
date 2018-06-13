<div id="article_add">
    <form method="POST"  enctype="multipart/form-data">
        <p>Titre du site</p>
        <div class="col-lg-2">
            <input type="text" name="title" placeholder="Titre du site" />
        </div>
        <br/>
        <br/>
        <br/>
        <p>Super-administrateur</p>
        <div class="col-lg-2">
            <select title="Choix du superadmin" class="form-control" id="superAdmin">
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
        </div>
        <br/>
        <br/>
        <br/>
        <div class="col-lg-8">
            <p class="pConfig2">Logo</p>
            <input type="file" name="logo" placeholder="Piece jointe" />
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <p>Page d'accueil</p>
        <div class="col-lg-2">
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
        </div>
        <br/>
        <br/>
        <br/>
        <div class="col-lg-2">
            <input title="Save the article" type="submit" name="article_add" value="Ajouter" class="btn btn-primary navbar-btn" />
        </div>
    </form>
</div>

<script>

    CKEDITOR.replace('editor');

    $('#editor').click(function() {
        document.getElementById("editor").insertAdjacentHTML('beforeend', 'name="content"');
    });
</script>