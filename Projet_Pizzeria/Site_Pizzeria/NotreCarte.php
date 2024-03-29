<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
  <link rel="stylesheet" type="text/css" href="CSS/styletest.css">
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
	 <h1>Notre Catalogue</h1>	
	 <div class="catalogue">
		<?php 
		session_start();
		if (! $_SESSION['MotDePasseClient']){
			header('location: NotreCarteGuest.php');
		}

			$id_client = $_SESSION['ID_Client'];
		
		
			require_once("config/connexion.php");
			connexion::connect();
			require_once("model/RecettePizza.php");
			require_once("model/SupplementPizza.php");
			require_once("model/Ligne_Commande.php");
			require_once("model/PizzaFinale.php");

			$tableauRecettePizza = RecettePizza::getAll();
			$tableauSupplementPizza = SupplementPizza::getAll();
			
			
			$boutonAjout = array();
			$i = 0;
				foreach($tableauRecettePizza as $RecettePizza){
					$i++;
					 echo '<div class="produit">';
					 echo '<a href="#boutonInfo'.$i.'" class="carousel-info"><img src="IMG/bouton_info.png"></a>';
					 echo '<div id="boutonInfo'.$i.'"  class="modal">';
					 echo '<div class="modal_content">';
					echo '<h1>Information sur votre pizza</h1>';
					 echo '<div class="image_popup"><img src="' . $RecettePizza->get('imagePizza') . '" alt="Logo"></div>';
					 echo '<label>Description :</label>';
					 echo '<div class"description"><label>' . $RecettePizza->get('DescriptionPizza') . '</label></div>';
					 echo '<a href="#" class="modal_close">&times;</a>';
					echo '</div>';
					 echo '</div>';
					 echo	'<div class="carousel-image"><img src="' .$RecettePizza->get('imagePizza')  . '"></div>';
					 echo	'<div class="carousel-text">' .$RecettePizza->get('NomPizza') . '</div>';
					 echo	'<div class="carousel-prix">' . $RecettePizza->get('PrixBasePizza'). '</div>';
					 echo	'<div class="rating">';
					 echo		'<a href="#5" title="Donner 5 étoiles">☆</a>';
					 echo		'<a href="#4" title="Donner 4 étoiles">☆</a>';
					 echo		'<a href="#3" title="Donner 3 étoiles">☆</a>';
					echo		'<a href="#2" title="Donner 2 étoiles">☆</a>';
					 echo		'<a href="#1" title="Donner 1 étoile">☆</a>';
					 echo	'</div>';
					 echo	'<a href="#boutonAjout'.$i.'" class="add-to-cart-button">Ajouter</a>';
					 echo	'<div id="boutonAjout'.$i.'"  class="modal">';
					 echo		'<div class="modal_content"> ';
					 echo			'<h1>Composer votre pizza</h1>';
					echo			'<h2>' .$RecettePizza->get('NomPizza') . '</h2>';
					 echo			'<div class="image_popup"><img src="'.$RecettePizza->get('imagePizza').'" alt="Logo"></div>';
					 echo			'<form method="get"> ';
					echo '<label>Quantité totale :</label>';
					 echo '<input id="fname" name="fname" type="number" min="1" max="100" required>';
					 echo '<div class="ingredient-grid">';
					 foreach ($tableauSupplementPizza as $SupplementPizza) {
						$NomSupplementPizza = $SupplementPizza->get('NomSupplementPizza');
						echo '<div class="ingredient">';
					 	echo '<p>' . $SupplementPizza->get('NomSupplementPizza') . '</p>';
						echo '<p>' . $SupplementPizza->get('PrixSupplementPizza') . '</p>';
						echo '<input type="checkbox" name="Supplement" value="on">';	
						echo '</div>';
					 }
					echo'</div>';
					 echo '<button type="submit" name="validerPizza" value="'.$i.'" class="">Valider</button>';
					 echo '</form>';
					 echo '<a href="#" class="modal_close">&times;</a>';
					 echo		'</div>';
					 echo	'</div>';
					echo'</div>	'	;

					
					
			
				}
				
				
				if(isset($_GET['validerPizza'])){	
							$numeroPizza = $_GET['validerPizza'];
							$selection = 'imagePizza';
							$ImageProduit= RecettePizza::getPizzaDetails($numeroPizza, $selection);
							$Quantite =  isset($_GET['fname']) ? intval($_GET['fname']) : 0;
						    $selection2 = 'PrixBasePizza';
							$PrixBaseProduit = RecettePizza::getPizzaDetails($numeroPizza, $selection2);
							$PrixUnitaire = $Quantite * $PrixBaseProduit;
							Ligne_Commande::create(null,$ImageProduit,$Quantite, $PrixUnitaire, $id_client);				
							
					}

				 
				    
				//    header('location: Panier.php');
				//    exit();
				
				// 	if(isset($_GET['Supplement'])){
				// 		$PrixFinal = $RecettePizza->get('PrixBasePizza') + $SupplementPizza->get('PrixSupplementPizza') ;
				// 		$DescriptionPizzaFinale= $RecettePizza->get('NomPizza');
				// 		$DescriptionPizzaFinale .=  $SupplementPizza->get('NomSupplementPizza');
				// 		PizzaFinale::create($PrixFinal, $DescriptionPizzaFinale);
				// 	}
			?>
	</div>
		
		
	
		
	
			
				

  <footer>
	<small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
</body>
</html>

