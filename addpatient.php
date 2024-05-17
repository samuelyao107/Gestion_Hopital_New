<?php
    try {
        $bdd = new PDO("mysql:host=localhost;dbname=hospitaldb","root","root");
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        //throw $th;
        echo $e->getMessage();
    }

    if (isset($_POST['submit'])) {
        // Retrieve and sanitize input data
        $name = htmlspecialchars($_POST['NOM']);
        $surname = htmlspecialchars($_POST['PRENOM']);
        $birthday = htmlspecialchars($_POST['DATENAISSANCE']);
        $birthPlace = htmlspecialchars($_POST['LIEUNAISSANCE']);
        $profession = htmlspecialchars($_POST['PROFESSION']);
        $gender = htmlspecialchars($_POST['SEXE']);
        $contact = htmlspecialchars($_POST['CONTACT']);
        $email = htmlspecialchars($_POST['EMAIL']);
        $medicalHistory = htmlspecialchars($_POST['ANTECEDANTS']);
        $residence = htmlspecialchars($_POST['HABITATION']);
        $bloodGroup = htmlspecialchars($_POST['GROUPESANGUIN']);
        if (!empty(trim($name)) && !empty(trim($surname)) && !empty(trim($birthday)) && !empty(trim($birthPlace)) && 
            !empty(trim($profession)) && !empty(trim($gender)) && !empty(trim($contact)) && !empty(trim($email)) && 
            !empty(trim($medicalHistory)) && !empty(trim($residence)) && !empty(trim($bloodGroup))) {
            if (filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
              $insertPatient = $bdd->prepare("INSERT INTO dossier(NUMERODOSSIER, NOM, PRENOM, DATENAISSANCE, LIEUNAISSANCE, SEXE, PROFESSION, CONTACT, EMAIL, GROUPESANGUIN, ANTECEDANTS, HABITATION) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              $insertPatient->execute(array(1040, $name, $surname, $birthday, $birthPlace, $gender, $profession, $contact, $email, $bloodGroup, $medicalHistory, $residence));
              $error = "Dossier ajouté avec succès";
            } else {
              $error = "Email inccorrect";
            }
        } else {
            $error = "Tous les champs sont requis";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ajout</title>
    <link rel="stylesheet" href="style/addpatient.css">
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

<form  method="post">
  <div class="container">
    <h1>Ajout de dossier médical</h1>

    <div id="all">

      <div id="left"><label for="NOM"><b>Nom</b></label>
      <input type="text" placeholder="Entrer votre nom" name="NOM" required value="<?php if(isset($name)) echo $name ?>">

      <label for="PRENOM"><b>Prénoms</b></label>
      <input type="text" placeholder="Entrer votre(vos) prénom(s)" name="PRENOM" required value="<?php if(isset($surname)) echo $surname ?>">

      <label for="DATENAISSANCE"><b>Date de Naissance</b></label>
      <input type="date" placeholder="Entrer votre date de naissance" name="DATENAISSANCE" required value="<?php if(isset($birthday)) echo $birthday ?>">

      <label for="LIEUNAISSANCE"><b>Lieu de naissance</b></label>
      <input type="text" placeholder="Entrer votre nom" name="LIEUNAISSANCE" required value="<?php if(isset($birthPlace)) echo $birthPlace ?>">
      <label for="PROFESSION"><b>Profession</b></label>
      <input type="text" placeholder="Entrer votre profession" name="PROFESSION" required value="<?php if(isset($profession)) echo $profession ?>">
        <p>SEXE:</p>
        <div id="s">
          <label><input type="radio" name="SEXE">Masculin</label>
          <label><input type="radio" name="SEXE"> Féminin</label>
        </div>
      </div>
      <div id="right">
        <label for="CONTACT"><b>Contact</b></label>
        <input type="text" placeholder="Entrer votre contact" name="CONTACT" required value="<?php if(isset($contact)) echo $contact ?>">
        <label for="EMAIL"><b>Email</b></label>
        <input type="email" placeholder="Entrer votre mail" name="EMAIL" required value="<?php if(isset($email)) echo $email ?>">
        <label for="ANTECEDANTS"><b>Antécédants</b></label>
        <input type="text" placeholder="Entrer les antécédants" name="ANTECEDANTS" required value="<?php if(isset($medicalHistory)) echo $medicalHistory ?>">
        <label for="HABITATION"><b>Habitation</b></label>
        <input type="text" placeholder="Entrer le lieu d'habitation" name="HABITATION" required value="<?php if(isset($residence)) echo $residence ?>">


        <p>GROUPE SANGUIN:</p>

        <label><input type="radio" name="GROUPESANGUIN" value="A+">A+</label>
        <label><input type="radio" name="GROUPESANGUIN" value="A-">A-</label>
        <label><input type="radio" name="GROUPESANGUIN" value="B+">B+</label>
        <label><input type="radio" name="GROUPESANGUIN" value="B-">B-</label>
        <label><input type="radio" name="GROUPESANGUIN" value="AB+">AB+</label>
        <label><input type="radio" name="GROUPESANGUIN" value="AB-">AB-</label>
        <label><input type="radio" name="GROUPESANGUIN" value="O+">O+</label>
        <label><input type="radio" name="GROUPESANGUIN" value="O-">O-</label>
      </div>
    </div>
    <?php if (isset($error)) {
        echo '<font>'. $error . '</font>';
    } ?>
    <button type="submit" name="submit" class="registerbtn">Ajouter</button>
  </div>


</form>


</body>
</html>