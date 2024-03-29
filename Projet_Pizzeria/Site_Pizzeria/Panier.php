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
			<p>Image Produit </p>
			<p>Quantité</p>
			<p>Prix Unitaire</p>
	 	</div>

		 <?php 
		 session_start();

		    $id_client =$_SESSION['ID_Client'];
		 
			require_once("config/connexion.php");
			connexion::connect();
			require_once("model/Ligne_Commande.php");
			if (! $_SESSION['MotDePasseClient']){
				header('location: PanierVide.php');
			}
			if(isset($_GET['confirmerCommande'])){
				header('location: Paiement.php');
				$_SESSION['TotalPaiement']= $PrixLivraison+$PrixTotal;
				exit();

			}if(isset($_GET['back'])){
				header('location: NotreCarte.php');
				exit();
	
			}
			
			$tableauLigne_Commande= Ligne_Commande::getPanier($id_client);
			$PrixTotal =  0;
			$NombreProduits = 0;
			$i = 0;
			$PrixLivraison = 0;
			foreach($tableauLigne_Commande as $Ligne_Commande){
				$i += 1;
				echo '<div class="Commande">';
				echo	'<div class="ImgProduit"><img src="' .$Ligne_Commande->get('IMGProduit')  . '" alt="Logo"></div>';
				echo	' <p>'.$Ligne_Commande->get('Quantite').'</p>';
				echo	'<p>'.$Ligne_Commande->get('PrixUnitaire').'</p>';
				echo '<form method="get"> ';
				echo '<button type="submit" name="corbeille"  value="'.$i.'" class="Corbeille">Supprimer</button>';
				echo '</form>';
				echo '</div>';
				$PrixTotal +=  $Ligne_Commande->get('PrixUnitaire');
				$NombreProduits+= $Ligne_Commande->get('Quantite');
				
				if(isset($_GET['corbeille'])){
						// $Ligne_CommandeNum = $_GET['corbeille'] ;
						$IMGPRoduit = $Ligne_Commande->get('IMGProduit');
						$Quantité = $Ligne_Commande->get('Quantite');
						$PrixUnitaire = $Ligne_Commande->get('PrixUnitaire');
						Ligne_Commande::delete($IMGPRoduit, $Quantité, $PrixUnitaire, $id_client);
						header('location: Panier.php');
						
				}
			}

			// if(isset($_GET['corbeille'])){
			// 			$Ligne_CommandeNum = $_GET['corbeille'] ;
			// 			$selection = 'IMGProduit';
			// 			$IMGPRoduit = Ligne_Commande::getLigne_CommandeDetails($Ligne_CommandeNum,$selection);
			// 			$selection2 = 'Quantite';
			// 			$Quantité = Ligne_Commande::getLigne_CommandeDetails($Ligne_CommandeNum,$selection2);
			// 			$selection3 = 'PrixUnitaire';
			// 			$PrixUnitaire = Ligne_Commande::getLigne_CommandeDetails($Ligne_CommandeNum,$selection3);
			// 			Ligne_Commande::delete($IMGPRoduit, $Quantité, $PrixUnitaire, $id_client);
						
			// 	}

			if($PrixTotal > 70){
				$PrixLivraison = 0;
			}elseif($PrixTotal > 30 && $PrixTotal < 70){
				$PrixLivraison = 2.99;
			}else{
				$PrixLivraison = 5.99;
			}
		  
		 ?>

		<div class="PrixTotal">
		<div class="ligneProduits">
			  <p>Nombre Produit</p>
			  <span class="prix"><?php echo $NombreProduits ?></span>
			</div>
			<div class="ligneProduits">
			  <p>Prix Produits (sans prix livraison)</p>
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