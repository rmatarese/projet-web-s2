<!-------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------  Script de démarrage de session  -------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


<?php
	// on démarre la session
	session_start();

	// connexion à la basse de donnée
	require("DB-Link.php");

    // si l'utilisateur n'est pas authentifié ou n'est pas admin
	if(!isset($_SESSION['username']) || $_SESSION['perm']!='admin'){

		// redirection vers la page d'authentification TP5.php
		header("Location:accueil.php");
	}
    //si l'utilisateur est un adminstrateur ==> On affiche la page
	else {
?>


<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Page admin</title>
        <link rel="stylesheet" type="text/css" href="admin_style.css">
		<meta charset="utf-8" />
	</head>
	<body>
		<h1>Gestion admin</h1>
		<?php
		echo '<p>Bonjour '. $_SESSION['username'].'<br><a href="deconnexion.php">Déconnexion</a> </p>';?>
		

<!-------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------  Champ pour modifier le tableau "bar"  ---------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


<form action="" method="post">
			<fieldset>
				<legend>Modification du tableau "bar"</legend>

				<label>Nom du bar :</label>
				<select name="bar" id="bar">

				<?php
					// on va choisir le bar que l'on veut modifier en prenant son nom
				   	$sql="SELECT IdBar,NomBar FROM bar WHERE Status='public'";
					$resultat = $conn->query($sql);

					if (mysqli_num_rows($resultat) > 0) {
						while($row = mysqli_fetch_assoc($resultat)){
							echo "<option value='".$row['NomBar']."'>".$row['NomBar']."</option>";
						}
					}
					else {
						echo "Aucune donnée trouvée.";
					} 
			    ?>

				</select>

				<!-- on modifie l'adresse et la ville du bar -->
				<br><br>
				<label>Adresse :</label>
				<input type="text" name="adresse" required>
                <br><br>
				<label>Ville :</label>
				<input type="text" name="ville" required>
				<br><br>
				<label>Note:</label>
  				<input type="number" name="note" required>
				<br><br>

				<!-- on termine la modif -->
				<input type="submit" name="Modifier le bar"/>
			</fieldset>
		</form>
		

<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------- Script de traitement du formulaire de modification du bar ------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


<?php
            // si on appuie sur le boutton "Modifier le bar"...
        	if(isset($_POST['Modifier_le_bar'])){ 

				//récup du formulaire les nouvelles info du bar
				$adresse = valider_donnees($_POST['adresse']);
                $ville = valider_donnees($_POST['ville']);
				$note = valider_donnees($_POST['note']);
				if($note>10) $note=10;
				$bar=$_POST['bar'];
                //requete pour modifier l'adresse et la ville dans la BD ( je suis pas sûr pour les AND)
				$reqSQL="UPDATE bar SET AdresseBar='$adresse', VilleBar='$ville', Note='$note' WHERE NomBar='$bar'";
				$resultat=$conn->query($reqSQL);
				// Exécuter la requête SQL
				if ($resultat!=FALSE) {
					echo "Les informations du bar ont été enregistrées avec succès. la page devrait apparaître sous peu.";
				}
				else {
					echo "Erreur: " . $reqSQL . "<br>" . mysqli_error($conn);
				}
			
				// Fermer la connexion à la base de données
				} 			
		?>
        <br><br>


<!-------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------  Champ pour valider un bar proposé  ------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->

	<form action="" method="post">
			<fieldset>
				<legend>Modification du tableau "bar"</legend>

				<label>Nom du bar :</label>
				<select name="bar" id="bar">

				<?php
					// on va choisir le bar que l'on veut modifier en prenant son nom
				   	$sql="SELECT IdBar,NomBar FROM bar WHERE Status='admin-only'";
					$resultat = $conn->query($sql);

					if (mysqli_num_rows($resultat) > 0) {
						while($row = mysqli_fetch_assoc($resultat)){
							echo "<option value='".$row['NomBar']."'>".$row['NomBar']."</option>";
						}
					}
					else {
						echo "Aucune donnée trouvée.";
					} 
			    ?>

				</select>

				<!-- on modifie l'adresse et la ville du bar -->
				<br><br>
				<input type="radio" id="valider" name="validation" value="0"><label for="valider"> Valider </label>
        		<br>
				<input type="radio" id="refuser" name="validation" value="1"><label for="refuser"> Refuser </label>
				<br>
				<!-- on termine la modif -->
				<input type="submit" name="autoriser"/>
			</fieldset>
		</form>
			
				</br></br>



<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------- Script de traitement du formulaire de modification du bar ------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->

		<?php
			// si on appuie sur le boutton "Modifier le bar"...
			if(isset($_POST['autoriser'])){
				//récup du formulaire les nouvelles info du bar
				$validation = $_POST['validation'];
				$bar=$_POST['bar'];
				if($validation==0){
					$reqSQL="UPDATE bar SET Status='public' WHERE NomBar='$bar'";
				}
				else{
					$reqSQL="DELETE FROM bar WHERE NomBar='$bar'";
				}
				$resultat=$conn->query($reqSQL);
				}
?>



<!-------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------  Champ pour modifier le tableau "client"  ------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


        <?php 
			try{
			    $requete="SELECT * FROM client";
			    $resultat=$conn->query($requete);
			}
			catch(Exception $e){
				die("Erreur : " . $e->getMessage());
			}		
		?>

		<form action="" method="post">
			<fieldset>
				<legend>Modification du tableau "client"</legend>

                <!-- on va choisir le client que l'on veut modifier en prenant son nom-->
				<label>Nom du client :</label>
				<select name="client" id="client">
				    <?php					
					
					while($row = mysqli_fetch_assoc($resultat)){
						echo "<option value='".$row['Nom']."'>".$row['Nom']."</option>";
					}
				    ?>
				</select>

				<!-- on modifie le nom, le prénom, l'email et la date de naissance du client -->
				<br><br>
				<label>Prénom :</label>
				<input type="text" name="prenom" required>
                <br><br>
				<label>Email :</label>
				<input type="email" name="email" required>
                <br><br>
				<label>Date de naissance :</label>
				<input type="date" name="dateNaissance" required>

				<!-- on termine la modif -->
				<br><br>
				<input type="submit" name="Modifier le client"/>
			</fieldset>
		</form>


        <!-------------------------------------------------------------------------------------------------------------------------->
        <!-------------------------------- Script de traitement du formulaire de modification du client ------------------------------->
        <!-------------------------------------------------------------------------------------------------------------------------->


		<?php

        if(isset($_POST['Modifier_le_client'])){ 
			echo"coucou";

            //récup du formulaire les nouvelles valeurs du client
            $prenom=$_POST['prenom'];
            $email=$_POST['email'];
            $dateNaissance=$_POST['dateNaissance'];
			$nom=$_POST['client'];
			echo '</br>';
            //récup du formulaire la ref du bar à modifier
            $ref=$_POST['Modifier_le_client'];
			echo '</br>';
            // requete pour modifier les valeurs dans la BD ( à vérif )
            $reqSQL="UPDATE client SET Prenom = '$prenom', Email = '$email', DateNaissance = '$dateNaissance' WHERE Nom = '$nom'";
			echo '</br>';
            //exécuter la requête
            $resultat=$conn->query($reqSQL);
            echo "<p>Client modifié</p>" ;

            }                
        
        }				
    
        ?>
        <br><br>

		

		<a href=ajout.php>Ajouter un bar</a>
		<a href=page_client.php>Page client</a>
		
        <br><br>



	 </body>	
</html>
