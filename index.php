<?php
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=hospitaldb","root","root");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        //throw $th;
        echo $e->getMessage();
    }

    if (isset($_POST['submitform'])) {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        if (!empty($username) && !empty($password)) {
            $request = $bdd->prepare("SELECT * FROM specialiste where EMAIL = ? AND PASSWORD= ?");
            $request->execute(array($username, $password));
            $userExist = $request->rowCount();
            if ($userExist === 1) {
                $getUser = $request->fetch();
                $_SESSION['IDSPECIALISTE'];
                $_SESSION['NOMSPECIALISTE'];
                $_SESSION['PRENOMSPECIALISTE'];
                $_SESSION['SPECIALITEDUSPECIALISTE'];
                $_SESSION['GRADESPECIALISTE'];
                $_SESSION['EMAIL'];
                //header('Location:special.php?id='.$_SESSION['IDSPECIALISTE']); Redirect to specialiste vue
            } else {
                $error = "Email ou mot de passe inccorect";
            }
        } else {
            $error = "Tous les chalps sont réquis";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="style/login.css">
    <style>
    font {
        display: block;
        font-weight: bold;
        text-align: center;
        color: red;
    }
    </style>
</head>
<body>

<form action="" method="post">
    <div class="imgcontainer">
        <img src="assets/user.png" alt="Avatar" class="avatar">
    </div>
    <?php if (isset($error)) {
        echo '<font>'. $error . '</font>';
    } ?>
    <div class="container">
        <label for="uname"><b>Nom d'Utilisateur</b></label>
        <input type="text" placeholder="Entrer votre nom d'utilisateur" name="username" required>

        <label for="psw"><b>Mot de Passe</b></label>
        <input type="password" placeholder="Entrer votre mot de passe" name="password" required>

        <button type="submit" name="submitform">Se Connecter</button>

    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Retour</button>
        <span class="psw">Mot de passe <a href="#">oublié?</a></span>
    </div>
</form>

</body>
</html>