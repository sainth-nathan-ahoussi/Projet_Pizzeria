<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
  <link rel="stylesheet" type="text/css" href="CSS/style.css">
  <script src="javascript/AfficherNumero.js"></script>
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
			<li id="copierNumero"><a href="#"><img src="IMG/LogoTelephone.png" alt="Logo"></a></li>
			<li><a href="Panier.php"><img src="IMG/LogoPanier.png" alt="Logo"></a></li>
			<li><a href="InfoUtilisateur.php"><img src="IMG/LogoCompte.png" alt="Logo"></a></li>
		  </ul>
		</div>
	</header>
		<div class="inscription">
			<form action="" method="get">
			<fieldset>
				<legend>Payez votre commande</legend>
				<div>
					<label for="NumeroCarte">Numéro de carte </label>
					<input type="tel" name="NumeroCarte" id="NumeroCarte">
				</div>
				<div>
					<label for="NomCarte">Nom sur la carte  :</label>
					<input type="text" name="NomCarte" id="NomCarte">
			   </div>
			   <div>
					<label for="Validité">MM/YY  :</label>
					<input type="month" name="Validité" id="Validité" min="2025-01">
			   </div>
			   <div>
					<label for="CVV">CVV  :</label>
					<input type="tel" name="CVV" id="CVV">
			   </div>

			   <div class="boutons">
					<div id="bouton">
						<input type="submit" value="Confirmer Paiement" name="ConfirmerPaiement">
					</div>
					<div  id="bouton">
						<input type="submit" value="Annuler" name="Annuler">
					</div>
				</div>
			</fieldset>
			</form>
		</div>
		  


		<?php 
		session_start();
		date_default_timezone_set('Europe/Paris');

		$id_client =$_SESSION['ID_Client'];
		$TotalPayer =  $_SESSION['TotalPaiement'];
	 
		require_once("config/connexion.php");
		connexion::connect();
		require_once("model/Commande.php");
		if (! $_SESSION['MotDePasseClient']){
			header('location: PanierVide.php');
		}
		if(isset($_GET['Annuler'])){
				header('location: Panier.php');

		}elseif(isset($_GET['ConfirmerPaiement'])){
				$DateCommande = date('d/m/Y');
				$HeureCommande = date('H:i:s');
				$TypePaiement = 'En ligne';
				$StatutCommande = 'En cours';
				$heureLivraison = date('H:i:s', strtotime($HeureCommande . ' +1 hour'));
				Commande::create($DateCommande, $HeureCommande, $TypePaiement, $StatutCommande, $TotalPayer, $heureLivraison, $id_client);
				echo "<script>alert(\"Paiement Effectué avec succès\"); window.location='NotreCarte.php';</script>";
    			exit();
			}
		?>
  <footer>
	<small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
</body>
</html>