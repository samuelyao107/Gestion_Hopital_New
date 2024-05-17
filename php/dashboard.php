<?php
try {
    $bdd = new PDO("mysql:host=localhost;dbname=hospitaldb","root","root");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo"Bonjour";
} catch (PDOException $e) {
    //throw $th;
    echo $e->getMessage();
}

if (isset($_POST['USERNAME']) && isset($_POST['PASSWORD'])) {
    
}