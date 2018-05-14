
<div class="container">
    <div class="row text-center">
        <!-- Ici débute le formulaire -->
        <!--<form id="formAddUser" class="login" method="POST">-->

            <!-- TextBox pseudo -->
            <!--<div class="connexion">
                <h1 class="card-title pricing-card-title">Se connecter</h1>
                <div class="form-group textBox">
                    <label class="control-label" for="pseudo">Identifiants :</label>
                    <input class="form-control text" id="pseudo" type="text" name="pseudo" placeholder="Pseudonyme" required>
                </div>
                <br />-->

                <!-- TextBox password -->
                <!--<div class="form-group textBox">
                    <label class="control-label" for="password">Mot de passe :</label>
                    <input class="form-control text" id="password" type="password" name="password" placeholder="Password" required>
                </div>

                <br />
                <div class="centeredText">-->
                   <!-- Button de validation -->
                   <!--<button type="submit" class="btn btn-primary" name="register" value="ok">Inscription</button>
                </div>
            </div>
        </form>-->

        <form class="form-signin">
            <img class="mb-4" src="style/img/logo.png" alt="" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>
            <label for="inputEmail" class="sr-only">Email</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="Email" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Mot de passe</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required="">
            <!--<div class="checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>-->
            <button class="btn btn-lg btn-primary btn-block" type="submit">Se Connecter</button>
            <p class="mt-5 mb-3 text-muted">© 2017-2018</p>
        </form>
    </div>
</div>
