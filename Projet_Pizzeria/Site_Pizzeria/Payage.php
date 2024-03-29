<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
  <link rel="stylesheet" type="text/css" href="CSS/style4.css">
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
	  
		<h1>Selectionnez votre moyen de paiement</h1>	
			<div class="PaiementLigne">
				<h3>Payer en ligne</h3>	
				<div class="checkbox"> 
					<form method="get" action =""> 
						<input type="checkbox" name="PaiementLigne" value="PaiementLigne"> 
					</form>
				</div>
			</div>
			<div class="PaiementCaisse">
				<h3>Payer à la caisse</h3>	
				<div class="checkbox"> 
					<form method="get" action ="">
						<input type="checkbox" name="PaiementCaisse" value="off"> 
					</form>
				</div>
			</div>
			<div class="PaiementBorne">
				<h3>Payer aux bornes</h3>	
				<div class="checkbox">
					<form method="get" action =""> 
						<input type="checkbox" name="PaiementBorne" value="off">
					</form>
				</div>
			</div>
		
		<div class="PrixTotal">
			<div class="ligneProduits">
			  <p>Produits</p> <span class="prix"><!-- <php echo $produitsPrix; ?> -->Prix</span>
			</div>
			<div class="ligneLivraison">
				<p>Livraison</p>  <span class="prix"><!-- <php echo $livraisonPrix; ?> -->Prix</span>
			</div>
			<div class="ligneBlanche"></div>
			<div class="ligneTotal">
				<p>Total</p>  <span class="prix"><!-- <php echo $totalPrix; ?> -->Prix</span>
			</div>
			<div id="bouton">
					<form method="get" action="">
						<input type="submit" value="Confirmer mode Paiement" name="confirmerModePaiement">
					</form>
				</div>
		  </div>
		  

		  <?php
			session_start();

				if (isset($_GET['confirmerModePaiement'])) {
					if (isset($_GET['PaiementLigne'])) {
						header('Location: Paiement.php');
						exit();
					}
				}
			?>

  <footer>
	<small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
</body>
</html>