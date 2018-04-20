
<div class="container">
    <div class="row">
        <!-- Ici débute le formulaire -->
        <form id="formAddUser" class="login" method="POST">

            <!-- TextBox pseudo -->
            <div class="connexion">
                <h1 class="card-title pricing-card-title">Se connecter</h1>
                <div class="form-group textBox">
                    <label class="control-label" for="pseudo">Identifiants :</label>
                    <input class="form-control text" id="pseudo" type="text" name="pseudo" placeholder="Pseudonyme" required>
                </div>
                <br />
                <!-- TextBox password -->
                <div class="form-group textBox">
                    <label class="control-label" for="password">Mot de passe :</label>
                    <input class="form-control text" id="password" type="password" name="password" placeholder="Password" required>
                </div>

                <br />

                <div class="centeredText">
                    <!-- Button de validation -->
                    <button type="submit" class="btn btn-primary" name="register" value="ok">Inscription</button>
                </div>
            </div>
        </form>
    </div>
</div>
