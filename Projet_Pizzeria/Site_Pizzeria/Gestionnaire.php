<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
  <link rel="stylesheet" type="text/css" href="CSS/styletest2.css">
  <title>Alta Mama</title>
</head>
<body>
	<header>
		<div class="navbar">
			<div class="icon">
				<a href="index.php"><img src="IMG/LogoCorner.png" alt="Logo"></a>
			  </div>
		  <ul>
			<li class="menu-deroulant">
				<a href="#"><img src="IMG/LogoMenu.png" alt="Logo"></a>
				<ul class="sous-menu">
					<li><a href="NotreCarte.php">Notre Carte</a></li>
					<li><a href="NosBoissons.php">Nos Boissons</a></li>
					<li><a href="NosAccompagnements.php">Nos Accompagnements</a></li>
				</ul>
			</li>
			<li><a href=""><img src="IMG/LogoTelephone.png" alt="Logo"></a></li>
			<li><a href="Panier.php"><img src="IMG/LogoPanier.png" alt="Logo"></a></li>
			<li><a href="InfoUtilisateur.php"><img src="IMG/LogoCompte.png" alt="Logo"></a></li>
		  </ul>
		</div>
	</header>
	<?php
		session_start();
		if (! $_SESSION['MotDePasseGestionnaire']){
			header('location: Compte.html');
		}
		if(isset($_GET['Deconnexion'])){
			$_SESSION = array();
			session_destroy();
			header('location: Compte.html');
			exit();

		}else if(isset($_GET['maintenance'])){

		}else if(isset($_GET['CreerPizza'])){
			// header('location: Compte.html');
			// exit();
		}
    ?>
	  
		<h1>Votre Board</h1>	
		<div class="maintenance">
			<form method="get">
			   <div class="boutons">
					<div  id="bouton">
						<input type="submit" value="Crér une pizza" name="CreerPizza">
					</div>
				</div>
			</form>
		</div>
		<div class="maintenance">
			<form method="get">
			   <div class="boutons">
					<div  id="bouton">
						<input type="submit" value="Faire une maintenance" name="maintenance">
					</div>
				</div>
			</form>
		</div>
		<div class="">
			<form method="get">
			   <div class="boutons">
					<div  id="bouton">
						<input type="submit" value="Deconnexion" name="Deconnexion">
					</div>
				</div>
			</form>
		</div>
		<div class="Salutations" >
			<p>Bonjour "<?php echo  $_SESSION['AdresseMailGestionnaire'] ?>" </br>
				Votre dernière connexion remonte à ""
			</p>
		</div>
		<div class="ListeTache">
			<h1>Consulter les chiffres</h2>
			<a href=""><img class="plus-logo" src="IMG/Plus_logo_Gestionnaire.png" alt="Logo"></a>

			<h1>Consulter les commandes</h1>
			<a href="ConsulterCommandes.php"><img class="plus-logo" src="IMG/Plus_logo_Gestionnaire.png" alt="Logo"></a>

			<h1>Consulter les stocks</h1>
			<a href="ConsulterStock.php"><img class="plus-logo" src="IMG/Plus_logo_Gestionnaire.png" alt="Logo"></a>

			<h1>Consulter mes alertes</h1>
			<a href="ConsulterAlerte.php"><img class="plus-logo" src="IMG/Plus_logo_Gestionnaire.png" alt="Logo"></a>

			<h1>Afficher la liste des allergènes</h1>
			<a href="ConsulterAllergene.php"><img class="plus-logo" src="IMG/Plus_logo_Gestionnaire.png" alt="Logo"></a>
		</div>

	
  <footer>
	<small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
</body>
</html>