<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
  <link rel="stylesheet" type="text/css" href="CSS/style2.css">
  <title>Alta Mama</title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="javascript/carousel.js"></script>
  <script src="javascript/AfficherNumero.js"></script>
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
						<li><a href="NotreCarteGuest.php">Notre Carte</a></li>
						<li><a href="NosBoissonsGuest.php">Nos Boissons</a></li>
						<li><a href="NosAccompagnementsGuest.php">Nos Accompagnements</a></li>
					</ul>
				</li>
				<li id="copierNumero"><a href="#"><img src="IMG/LogoTelephone.png" alt="Logo"></a></li>
				<li><a href="Panier.php"><img src="IMG/LogoPanier.png" alt="Logo"></a></li>
				<li><a href="InfoUtilisateur.php"><img src="IMG/LogoCompte.png" alt="Logo"></a></li>
			</ul>
			</div>
  </header>

  <h1>Notre Catalogue</h1>
  <a href="NotreCarte.php"><img class="plus-logo" src="IMG/Plus_logo.png" alt="Logo"></a>
  
  <div class="carousel">
    <button class="prev-button">&#10094;</button>
		<?php 
		session_start();
		
			require_once("config/connexion.php");
			connexion::connect();
			require_once("model/RecettePizza.php");

			$tableauRecettePizza = RecettePizza::getAll();

			for ($i = 1; $i <= 12; $i++) {
				$recettePizza = $tableauRecettePizza[$i - 1];
				echo '<div class="carousel-item">';
				echo '<div class="carousel-content">';
				echo '<a href="#boutonInfo'.$i.'" class="carousel-info"><img src="IMG/bouton_info.png"></a>';
				echo '<div id="boutonInfo'.$i.'"  class="modal">';
				echo '<div class="modal_content">';
				echo '<h1>Information sur votre pizza</h1>';
				echo '<div class="image_popup"><img src="' . $recettePizza->get('imagePizza') . '" alt="Logo"></div>';
				echo '<form>';
				echo '<label>Description :</label>';
				echo '<div class"description"><label>' . $recettePizza->get('DescriptionPizza') . '</label></div>';
				echo '</form>';
				echo '<button id="#" class="">Valider</button>';
				echo '<a href="#" class="modal_close">&times;</a>';
				echo '</div>';
				echo '</div>';
				echo '<div class="carousel-image"><img src="' . $recettePizza->get('imagePizza') . '"></div>';
				echo '<div class="carousel-text">' . $recettePizza->get('NomPizza') . '</div>';
				echo '<div class="carousel-prix">' . $recettePizza->get('PrixBasePizza') . '</div>';
				echo '<div class="rating">';
				echo '<a href="#5" title="Donner 5 étoiles">☆</a>';
				echo '<a href="#4" title="Donner 4 étoiles">☆</a>';
				echo '<a href="#3" title="Donner 3 étoiles">☆</a>';
				echo '<a href="#2" title="Donner 2 étoiles">☆</a>';
				echo '<a href="#1" title="Donner 1 étoile">☆</a>';
				echo '</div>';
				echo '<a href="#boutonAjout'.$i.'" class="add-to-cart-button">Ajouter</a>';
				echo '<div id="boutonAjout'.$i.'"  class="modal">';
				echo '<div class="modal_content"> ';
				echo '<h1>Composer votre pizza</h1>';
				echo '<h2>' . $recettePizza->get('NomPizza') . '</h2>';
				echo '<div class="image_popup"><img src="' . $recettePizza->get('imagePizza') . '"></div>';
				echo '<form> ';
				echo '<label>Quantité :</label>';
				echo '<input id="lfname" name="fname" type="number" min="0" max="100" />';
				echo '</form>';
				echo '<button type="submit" name="validerPizza" value="'.$i.'" class="">Valider</button>';
				echo '<a href="#" class="modal_close">&times;</a>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
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
		?>

		
    <button class="next-button">&#10095;</button>
  </div>
  <div class="third-section">
			<div class="background-image"></div>
			<div class="text-section">
				<h3>Avec Notre Programme Note Me</h3>
				<p>Après chaque commande, nos clients peuvent donner leur avis.</p>
				<div class="ratingSpe">
					<div class="rating">
						  <a href="#5" title="Donner 5 étoiles">☆</a>
						  <a href="#4" title="Donner 4 étoiles">☆</a>
						  <a href="#3" title="Donner 3 étoiles">☆</a>
						  <a href="#2" title="Donner 2 étoiles">☆</a>
						  <a href="#1" title="Donner 1 étoile">☆</a>
					</div>
				</div>
				<button class="plus_details"><a href="">Plus de détails</a></button>
			</div>
	</div>	
	<div class="four-section">
			<div class="text2-section">
				<h3>Des Saveurs Authentiques</h3>
				<p>La pâte de nos pizzas est élaborée selon<br />
				  une recette avec des ingrédients de qualité.<br />
				  Elle est pétrie puis cuite chaque jours par nos pizzaïolos.</p>
			</div>
			<div class="background-image2"></div>
	</div>
	<div class="fifth-section">
		    <div class="background-image3"></div>
			<div class="text3-section">
				<h3>Découvrez tous les délicieux produits</h3>
				<p>La pâte de nos pizzas est élaborée selonproposés par<br />
								" Alta MAMA "<br />
					Choisissez le produit qui vous fait envie, puis<br />
					<a href="NotreCarte.php">commandez-le</a></p>
			</div>
	</div>
  <footer>
    <small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
  
</body>
</html>
