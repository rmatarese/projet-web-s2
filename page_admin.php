<!-------------------------------------------------------------------------------------------------------------------------->
<!--------------------------------------------  Script de démarrage de session  -------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


<?php 

	session_start();
    // si l'utilisateur n'est pas authentifié ou n'est pas admin
	if(($_SESSION["authentifie"] == false) && $_SESSION["admin"] == false) {
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
        <link rel="stylesheet" type="text/css" href="connexion.css">
		<meta charset="utf-8" />
	</head>
	<body>
		<h1>Gestion admin</h1>
		<p>Bonjour admin <br><a href="deconnexion.php">Déconnexion</a> </p>
		

<!-------------------------------------------------------------------------------------------------------------------------->
<!------------------------------------------  Champ pour modifier le tableau "bar"  ---------------------------------------->
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
				<legend>Modification du tableau "bar"</legend>

                <!-- on va choisir le bar que l'on veut modifier en prenant son nom-->
				<label>Nom du bar :</label>
				<select name="bar">

				<?php					
				   	while($ligne=$req->fetch()){
				    	echo "<option value=$ligne[IdBar]>$ligne[NomBar]</option>";
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

				<!-- on termine la modif -->
				<br><br>
				<input type="submit" name="Modifier le bar"/>
			</fieldset>
		</form>
		

<!-------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------- Script de traitement du formulaire de modification du bar ------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------->


		<?php
            // si on appuie sur le boutton "Modifier le bar"...
        	if(isset($_POST['Modifier le bar'])){ 
			try{
			    require("DB-Link.php"); 
				//récup du formulaire la nouvelle adresse et de la nouvelle ville du bar
				$adresse=$_POST['adresse'];
                $ville=$_POST['ville'];
				//récup du formulaire la ref du bar à modifier
				$ref=$_POST['bar'];
				
                //requete pour modifier l'adresse et la ville dans la BD ( je suis pas sûr pour les AND)
				$reqSQL="UPDATE bar SET AdresseBar = :adresse AND VilleBar = :ville WHERE NomBar = :bar;";
				//préparer et exécuter la requête
				$resultat = $conn->prepare($reqSQL);
				$resultat->execute(array(
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


	 </body>	
</html>
