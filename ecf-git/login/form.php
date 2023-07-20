<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connectez-vous</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="../style/style-form.css">
</head>
<body>
    <a href="../index.php"> ACCEUIL </a>
    <form id="login-form" method="POST" action="login.php">
        <fieldset>
            <h1> CONNECTION ENPLOYÉ</h1>
            <label for="email"> Adresse e-mail </label>
            <input type="text" name="username" required placeholder="Votre pseudo">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" required placeholder="Votre mot de passe">
            <div class="div-btn">
                <button type="submit">Se connecter</button>
            </div>
        </fieldset>
    </form>
</body>
</html>