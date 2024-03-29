<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
  <link rel="stylesheet" type="text/css" href="CSS/style4.css">
  <link rel="stylesheet" type="text/css" href="CSS/style5.css">
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
	  
		<h1>Recapitulatif de mon panier</h1>	
		<div class="Descriptions">
			<p>Image Produit </p>
			<p>Quantité</p>
			<p>Prix Unitaire</p>
	 	</div>

		 <?php 
		 session_start();
		 
			require_once("config/connexion.php");
			connexion::connect();
			require_once("model/Ligne_Commande.php");
			if(isset($_GET['confirmerCommande'])){
				header('location: Payage.php');
				exit();

			}
					
			$tableauLigne_Commande= Ligne_Commande::getAll();
			$PrixTotal =  0;
			$i = 0;
			$PrixLivraison = 0;
		  
		 
		 ?>

		<div class="PrixTotal">
			<div class="ligneProduits">
			  <p>Produits</p>
			  <span class="prix"><?php echo $PrixTotal ?></span>
			</div>
			<div class="ligneLivraison">
				<p>Livraison</p>  
				<span class="prix"><?php echo $PrixLivraison ?></span>
			</div>
			<div class="ligneBlanche"></div>
			<div class="ligneTotal">
				<p>Total</p>  <span class="prix"><?php echo $PrixLivraison+$PrixTotal?></span>
			</div>
				<div id="bouton">
					<form action="" method="get">
						<input type="submit" value="Confirmer la Commande" name="confirmerCommande">
					</form>
				</div>			
		  </div>

		 
  <footer>
	<small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
</body>
</html>