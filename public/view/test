<style>
    .rowBen1 {
        display: Flex;
    }

    .rowBen2 {
        display: Flex;
        margin-top: -1.55%;
    }

    .inputBen1 {
        margin-left: 25%;
    }

    .pConfig2 {
        margin-left: -20%;
    }
</style>

<h2 class="configText">Réglages généraux</h2>

<br/>
<br/>

<div class="form-group rowBen1">
    <p class="pConfig">Titre du site</p>
    <div class="col-md-3">
        <input class="form-control inputBen1" id="title" placeholder="Titre du site">
    </div>
</div>

<div class="form-group rowBen1">
    <p class="pConfig">Super-admin</p>
    <!-- Ici, début de la liste des admins nourrie par la base -->
    <div class="col-md-1.5">
        <select title="Choix du superadmin" class="form-control inputBen1" id="superAdmin">
			<?php
			foreach ( $arrayAdmins as $unPetitAdmin ) {
				if ( $unPetitAdmin->isSuperAdmin() ) { ?>
                    <option value="<?=$unPetitAdmin->getId();?>" disabled
                            selected><?=$unPetitAdmin->getFirstname();?></option>
					<?php
				}
				else { ?>
                    <option value="<?=$unPetitAdmin->getId();?>"><?=$unPetitAdmin->getFirstname();?></option>
					<?php
				}
			} ?>
        </select>
        <br/>
        <br/>
        <div class="rowBen1">
            <p class="pConfig2">Logo</p>
            <input class="inputBen1" type="file" name="attachment" placeholder="Piece jointe" />
        </div>
        <br/>
    </div>
</div>

<br/>

<div class="form-group rowBen2">
    <p class="pConfig">Page d'accueil</p>
    <!-- Ici, début de la liste des pages nourrie par la base -->
    <div class="col-md-2">
        <select title="Choix de la page d'accueil" class="form-control inputBen1" id="pageAccueil">
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
        <br/>
        <input title="Save" type="submit" name="config_save" value=Sauvegarder class="btn btn-primary navbar-btn" />
    </div>
</div>