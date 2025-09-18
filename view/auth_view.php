<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert-error">
        <?php
        echo $_SESSION['error_message'];
        unset($_SESSION['error_message']);
        ?>
    </div>
<?php endif; ?>

<div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1 class="title-overlay">Bonjour</h1>
                    <p class="p-overlay">Si vous avez un compte, veuillez vous connectez ici</p>
                    <button class="ghost btn" id="login" onclick="showlogin()">Login</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1 class="title-overlay">Commencer maintenant</h1>
                    <p class="p-overlay">Si vous n'avez pas encore de compte, veuillez vous inscrire ici</p>
                    <button class="ghost btn" id="register" onclick="showregister()">Inscription</button>
                </div>
            </div>
</div>

<div class="log">
    <div id="signup-container">
        <form action="/auth/register" class="signup-form" method="post">
            <h1>Inscription</h1>
            <input class="last_name" type="text" placeholder="Nom" name="last_name" required />
            <input class="first_name" type="text" placeholder="Prénom" name="first_name" required />
            <input class="birth_date" type="date" name="birth_date" required>
            <input class="phone" type="tel" name="phone" placeholder="0612345678">
            <input class="email" type="email" placeholder="Email" name="email" required />
            <input class="password" type="password" placeholder="Mot de passe" name="password" required />
            <input class="confirm_password" type="password" placeholder="Confirmer mot de passe" name="confirm_password" required />
            <button class="btn" type="submit">Inscription</button>
            <span>ou utiliser votre compte</span>
            <div class="social-container"> <!-- ICON DES RESEAUX POUR SE CONNECTER --> </div>
        </form>
        <div class="signupAnnex">
        <h1>Bienvenue au Grand Hôtel de la Motte-Tilly</h1>
        <p>Veuillez vous connecter pour enfiler votre uniforme et consulter votre contrat d'engagement.</p><br>
        <p>Première visite ? Inscrivez-vous pour rejoindre l’expérience exclusive des apprentis lobby boys</p>
    </div>

    </div>
    
    <div id="login-container">
        <form action="/auth/login" method="post" class="login-form">
            <h1>Connexion</h1>
            <input type="email" placeholder="Email" name="email" required />
            <input type="password" placeholder="Password" name="password" required />
            <div class="content">
                <div class="checkbox">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="remember-me">Se souvenir</label>
                </div>
                <div class="pass-link">
                    <a href="#">mot de passe oublié ?</a>
                </div>
            </div>
            <button class="btn" type="submit">Connexion</button>
            <span>Ou utiliser votre compte</span>
            <div class="social-container">
                <!-- ICON DES RESEAUX POUR SE CONNECTER -->
            </div>
        </form>
        <div class="signupAnnex">
            <h1>Bienvenue au Grand Hôtel de la Motte-Tilly</h1>
            <p>Veuillez vous connecter pour enfiler votre uniforme et consulter votre contrat d'engagement.</p><br>
            <p>Première visite ? Inscrivez-vous pour rejoindre l’expérience exclusive des apprentis lobby boys</p>
        </div>
    </div>
</div>
