<style>
    .configText {
        margin-top: -60%;
        margin-left: 30%;
    }

    .pConfig {
        margin-left: 35%;
    }

    .rowBen1 {
        display: Flex;
    }

    .inputBen1 {
        margin-left: 15%;
    }
</style>

<h4 class="configText">Réglages généraux</h4>

<br/>
<br/>
<br/>
<br/>

<div class="form-group rowBen1">
    <p class="pConfig">Titre du site</p>
    <div class="col-md-5">
        <input class="form-control inputBen1" id="title" placeholder="Titre du site">
    </div>
</div>

<br/>

<div class="form-group rowBen1">
    <p class="pConfig">Super-admin</p>
    <!-- Ici, début de la liste des admins nourrie par la base -->
    <div class="col-md-5">
        <select class="form-control inputBen1" id="superAdmin">
            <?php
            foreach ($arrayAdmins as $unPetitAdmin)
            {
                if($unPetitAdmin->isSuperAdmin())
                {
                    ?>
                    <option value="<?= $unPetitAdmin->getId(); ?>" disabled selected><?= $unPetitAdmin->getFirstname(); ?></option>
                    <?php
                }
                else
                {
                    ?>
                    <option value="<?= $unPetitAdmin->getId(); ?>"><?= $unPetitAdmin->getFirstname(); ?></option>
                    <?php
                }
            }
            ?>
        </select>
    </div>
</div>