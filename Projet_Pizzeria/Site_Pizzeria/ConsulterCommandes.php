<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
  <link rel="stylesheet" type="text/css" href="CSS/style5.css">
  <title>Alta Mama</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="javascript/carousel.js"></script>
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

  <h1>Consulter les commandes</h1>
  <div class="back">
		<form method="get">
		<div class="boutons">
				<div  id="bouton">
					<input type="submit" value="Retour" name="back">
				</div>
			</div>
		</form>
	</div>

  <div class="Descriptions">
		<p>Date Commande</p>
		<p>Heure Commande</p>
		<p>Type Paiement</p>
		<p>Statut Commande</p>
		<p>Prix Commandes</p>
		<p>Heure Livraison</p>
 </div>
  <?php
  	session_start();

  		require_once("config/connexion.php");
 		connexion::connect();
  		require_once("model/Commande.php");

		if (! $_SESSION['MotDePasseGestionnaire']){
			header('location: Compte.html');
		}
		  if(isset($_GET['back'])){
			header('location: Gestionnaire.php');
			exit();

		}

		$tableauCommande = Commande::getAll();
		$i = 0;
		foreach ($tableauCommande as $Commande){
			$i+=1;
			echo '<div class="Commande">';
			echo	'<p>"'.$Commande->get('DateCommande').'"</p>';
			echo	'<div class="Heure"> <p>"'.$Commande->get('HeureCommande').'"</p> </div>';
			echo	'<div class="TypePaiement"> <p>"'.$Commande->get('TypePaiement').'"</p> </div>';
			echo	'<div class="Statut"> <p>"'.$Commande->get('StatutCommande').'"</p> </div>';
			echo	'<div class="Prix"> <p>"'.$Commande->get('PrixCommande').'"</p> </div>';
			echo	'<div class="HeureLivraison"> <p>"'.$Commande->get('heureLivraison').'"</p> </div>';
			echo '</div>';
		}
		
		
	?>
  <footer>
    <small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
  
</body>
</html>
