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
    <div class="col-md-5">
    <select class="form-control inputBen1" id="superAdmin">
        <option value="1" selected>Charles</option>
        <option value="2">Benjamin</option>
        <option value="3">Maxence</option>
        <option value="4">Thomas</option>
    </select>
    </div>
</div>