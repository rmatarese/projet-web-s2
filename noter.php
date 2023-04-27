<?php
session_start();
require("DB-Link.php");

// Vérifier si l'utilisateur est déjà connecté
if(!isset($_SESSION['username'])){
    header("Location: accueil.php");
}


if(isset($_POST['note'])){
    $note_set = $_POST['note'];
    $bar = $_POST['bar'];
    $requete = "SELECT Note, IdBar, nb_note FROM bar WHERE NomBar = '$bar'"; 
    $resultat = $conn->query($requete);
    if ($resultat->num_rows > 0) {
        $row = $resultat->fetch_assoc();
        $note = $row['Note'];
        $nb_note = $row['nb_note'];
        $id_bar = $row['IdBar'];
    }


    // Vérifier si l'utilisateur a déjà voté pour ce bar en utilisant les cookies
    $votes = array(); // tableau de votes
    if(isset($_COOKIE['votes'])){ // si l'utilisateur a déjà voté pour un bar
        $votes = json_decode($_COOKIE['votes'], true); // récupérer les votes de l'utilisateur
    }
    if(array_key_exists($id_bar, $votes)){ 
        //L'utilisateur a déjà voté pour ce bar, on modifie son vote
        $note_sum = $note*$nb_note - $votes[$id_bar]['note'] + $note_set;
        $note = $note_sum / $nb_note;
        $requete = "UPDATE bar SET Note='$note' WHERE NomBar='$bar'";
        $resultat = $conn->query($requete);
        $votes[$id_bar]['note'] = $note_set;
    } else {
        // Utilisateur n'a pas encore voté pour ce bar, ajouter un nouveau vote
        $note = ($note*$nb_note + $note_set) / ($nb_note + 1);
        $nb_note += 1;
        $requete = "UPDATE bar SET Note='$note', nb_note='$nb_note' WHERE NomBar='$bar'";
        $resultat = $conn->query($requete);
        $votes[$id_bar] = array('note' => $note_set, 'nb_note' => $nb_note);
    }

    // On enregistre les votes dans les cookies
    setcookie('votes', json_encode($votes), time()+60*60*24*30); //le cookie dure 1 mois. Après ce délai, on considère que le vote est a nouveau possible

    header("Location: page_client.php");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Choix de note</title>
    <link rel="stylesheet" type="text/css" href="noter.css">
  </head>
  <body>
    <h1> Notation d'un bar </h1>
    <form method="post">
        <label> Bar : </label></br>
        <?php
        echo "<select name='bar' id='bar'>";
        $requete="SELECT IdBar,NomBar FROM bar WHERE Status='public'";
        $resultat =$conn->query($requete);
        while($row = mysqli_fetch_assoc($resultat)){
            echo "<option value='".$row['NomBar']."'>".$row['NomBar']."</option>"; //on affiche la liste des bars dans un menu déroulant
        }
        echo "</select>";
        ?>
        </br>
        </br>
        <label>Note :</label> </br>
        <input type="radio" id="note0" name="note" value="0"><label for="note0">0</label>
        <input type="radio" id="note1" name="note" value="1"><label for="note1">1</label>
        <input type="radio" id="note2" name="note" value="2"><label for="note2">2</label>
        <input type="radio" id="note3" name="note" value="3"><label for="note3">3</label>
        <input type="radio" id="note4" name="note" value="4"><label for="note4">4</label>
        <input type="radio" id="note5" name="note" value="5"><label for="note5">5</label>
        <input type="radio" id="note6" name="note" value="5"><label for="note6">6</label>
        <input type="radio" id="note7" name="note" value="6"><label for="note7">7</label>
        <input type="radio" id="note8" name="note" value="8"><label for="note8">8</label>
        <input type="radio" id="note9" name="note" value="9"><label for="note9">9</label>
        <input type="radio" id="note10" name="note" value="10"><label for="note10">10</label>
        </br>
        <input type="submit" value="Envoyer">
    </form>
    <a href="page_client.php"> Retour à la page principale</a>
  </body>
</html>