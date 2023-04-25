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
        <link rel="stylesheet" type="text/css" href="connexion_style.css">
		<meta charset="utf-8" />
	</head>
	<body>
		<h1>Gestion admin</h1>
		<p>Bonjour admin <br><a href="deconnexion.php">Déconnexion</a> </p>
		

<!-------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------  Champ pour modifier le tableau "bar"  ---------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


		<form action="" method="post">
			<fieldset>
				<legend>Modification du tableau "bar"</legend>

				<label>Nom du bar :</label>
				<select name="bar">

				<?php
					// on va choisir le bar que l'on veut modifier en prenant son nom
				   	$sql="SELECT IdBar,NomBar FROM bar WHERE Status='public'";
					$resultat = mysqli_query($conn, $sql);

					if (mysqli_num_rows($resultat) > 0) {
						while($ligne = mysqli_fetch_assoc($resultat)) {
							echo "<option value=$ligne[IdBar]>$ligne[NomBar]</option>";
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
				<label>Commentaire:</label>
				<input type="text" name="commentaire">
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
        	if(isset($_POST['Modifier le bar'])){ 

				//récup du formulaire les nouvelles info du bar
				$adresse = valider_donnees($_POST['adresse']);
                $ville = valider_donnees($_POST['ville']);
				$note = valider_donnees($_POST['note']);
				$commentaire = valider_donnees($_POST['commentaire']);
				
                //requete pour modifier l'adresse et la ville dans la BD ( je suis pas sûr pour les AND)
				$reqSQL="UPDATE bar SET AdresseBar = :adresse, VilleBar = :ville, Note = :note, Commentaire = :commentaire WHERE NomBar = :bar;";

				// Exécuter la requête SQL
				if (mysqli_query($conn, $reqSQL)) {
					echo "Les informations du bar ont été enregistrées avec succès. la page devrait apparaître sous peu.";
				}
				else {
					echo "Erreur: " . $reqSQL . "<br>" . mysqli_error($conn);
				}
			
				// Fermer la connexion à la base de données
				mysqli_close($conn);
				} 			
		?>
        <br><br>


<!-------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------  Champ pour modifier le tableau "client"  ------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


        <?php
			try{
			    require("DB-Link.php");
			    $reqPrep="SELECT * FROM client";
			    $req = $conn->prepare($reqPrep);
				$req->execute();
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
				<select name="client">
				    <?php					
					
				    	while($ligne=$req->fetch()){
					    	echo "<option value=$ligne[Id]>$ligne[Nom]</option>";
					    }

				    ?>
				</select>

				<!-- on modifie le nom, le prénom, l'email et la date de naissance du client -->
				<br><br>
				<label>Nom :</label>
				<input type="text" name="nom" required>
                <br><br>
				<label>Prénom :</label>
				<input type="text" name="prenom" required>
                <br><br>
				<label>Email :</label>
				<input type="text" name="email" required>
                <br><br>
				<label>Date de naissance :</label>
				<input type="date" name="dateNaissnce" required>

				<!-- on termine la modif -->
				<br><br>
				<input type="submit" name="Modifier le client"/>
			</fieldset>
		</form>


        <!-------------------------------------------------------------------------------------------------------------------------->
        <!-------------------------------- Script de traitement du formulaire de modification du bar ------------------------------->
        <!-------------------------------------------------------------------------------------------------------------------------->


		<?php

        if(isset($_POST['Modifier le client'])){ 
        try{
            require("DB-Link.php"); 

            //récup du formulaire les nouvelles valeurs du client
            $prenom=$_POST['prenom'];
            $email=$_POST['email'];
            $dateNaissance=$_POST['dateNaissance'];

            //récup du formulaire la ref du bar à modifier
            $ref=$_POST['client'];
    
            // requete pour modifier les valeurs dans la BD ( à vérif )
            $reqSQL="UPDATE client SET Prenom = :prenom AND Email = :email AND DateNaissance = :dateNaissance WHERE Nom = :client;";

            //préparer et exécuter la requête
            $resultat = $conn->prepare($reqSQL);
            $resultat->execute(array(
                ':prenom' => $prenom,
                ':email' => $email,
                ':dateNaissance' => $dateNaissance,
                ':bar' => $ref));
            echo "<p>Client modifié</p>" ;

            //Fermer la connexion
            $conn = null;
            }                
            catch(Exception $e){
                die("Erreur : " . $e->getMessage());
            }
        }				
    }
        ?>
        <br><br>


<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------  Champ pour ajouter un bar dans le tableau "bar"  ---------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


		<?php
			try{
			    require("DB-Link.php");
			    $reqPrep="SELECT * FROM bar";
			    $req = $conn->prepare($reqPrep);
				$req->execute();
			}
			catch(Exception $e){
				die("Erreur : " . $e->getMessage());
			}		
		?>

		<form action="" method="post">
			<fieldset>
				<legend>Ajout d'un bar</legend>

                <!-- on va choisir le bar que l'on veut ajouter -->
				<label>Nom :</label>
				<input type="text" name="nom" required>
                <br><br>
				<label>Adresse :</label>
				<input type="text" name="adresse" required>
                <br><br>
				<label>Ville :</label>
				<input type="text" name="ville" required>
				<br><br>
				<label>Note :</label>
				<input type="number" name="note">
				<br><br>y
				<label>Commentaire :</label>
				<input type="text" name="commentaire">
				<br><br>

				<!-- on termine la modif -->
				<input type="submit" name="Ajouter le bar"/>
			</fieldset>
		</form>
		

<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------- Script de traitement pour l'ajout du bar ------------------------------------------------>
<!-------------------------------------------------------------------------------------------------------------------------->


		<?php
            // si on appuie sur le boutton "Modifier le bar"...
        	if(isset($_POST['Ajouter le bar'])){ 
			try{
			    require("DB-Link.php");

				// Récupérer les données du formulaire
				$barNom = $_POST['nom'];
				$barAdresse = $_POST['adresse'];
				$barVille = $_POST['ville'];
				$barNote = $_POST['note'];
				$barCommentaire = $_POST['commentaire'];
			
				// Créer une requête SQL pour insérer les données du formulaire dans la base de données
				$reqSQL = "INSERT INTO bar VALUES ('$barNom','$barAdresse','$barVille','$barNote','$barCommentaire')";

				//préparer et exécuter la requête
				$resultat = $conn->prepare($reqSQL);
				$resultat->execute(array(
					':nom' => $nom,
					':adresse' => $adresse,
                    ':ville' => $ville,
					':bar' => $ref));
				echo "<p>Bar modifié</p>" ;

				//Fermer la connexion
                $conn = null;
				}                
				catch(Exception $e){
					die("Erreur : " . $e->getMessage());
				}
			}				
		?>
        <br><br>



	 </body>	
</html>
