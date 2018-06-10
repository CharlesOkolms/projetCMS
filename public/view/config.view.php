<style>
    .rowBen1 {
        display: Flex;
    }

    .inputBen1 {
        margin-left: 15%;
    }
</style>

<h2 class="configText">Réglages généraux</h2>

<br/>
<br/>

<div class="form-group rowBen1">
    <p class="pConfig">Titre du site</p>
    <div class="col-md-2">
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
        <input type="file" name="attachment" placeholder="Piece jointe" />
        <br/>
        <input title="Save" type="submit" name="config_save" value=Sauvegarder class="btn btn-primary navbar-btn" />
    </div>

</div>
