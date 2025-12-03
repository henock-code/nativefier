<?php
session_start();

// Redirection si déjà connecté
if (isset($_SESSION['acces'])) {
    header("Location: accueil.php");
    exit();
}

// Identifiants
$utilisateur = "tekas";
$motDePasse  = "11";

// Vérification du login
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'], $_POST['mot_de_passe'])) {
    if ($_POST['username'] === $utilisateur && $_POST['mot_de_passe'] === $motDePasse) {
        $_SESSION['acces'] = true;
        $_SESSION['username'] = $utilisateur;
        header("Location: accueil.php");
        exit();
    } else {
        $erreur = "Nom d’utilisateur ou mot de passe incorrect ❌";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>TAPE VOTRE IDENTIFIANTS</title>
    <link rel="icon" type="image/png" href="images/IMG_5382.PNG">
    <link rel="stylesheet" href="connexions.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>


    <div class="login-box <?php if (isset($erreur)) echo 'shake'; ?>">
        <h1>🔐 Connexion</h1>

        <?php if (isset($erreur)) echo "<p class='error'>$erreur</p>"; ?>

        <form method="post">
            <div class="input-group">
                <i class="fa fa-user"></i>
                <input type="text" name="username" placeholder="Nom d’utilisateur" required>
            </div>

            <div class="input-group">
                <i class="fa fa-lock"></i>
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe" required>
                <i class="fa fa-eye toggle-password" onclick="togglePassword()"></i>
            </div>

            <button type="submit">Se connecter</button>
        </form>
    </div>

<script>
    function togglePassword() {
        const input = document.getElementById("mot_de_passe");
        const icon = document.querySelector(".toggle-password");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.replace("fa-eye-slash", "fa-eye");
        }
    }
</script>

</body>
</html