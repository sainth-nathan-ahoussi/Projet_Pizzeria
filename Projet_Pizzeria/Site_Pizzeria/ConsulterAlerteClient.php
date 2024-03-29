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

  <h1>Consulter les Alertes Client</h1>
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
		<p>Identifiant Alerte Client</p>
		<p>Message</p>
		<p>Identifiant Client</p>
 </div>
  <?php
  		session_start();
  		require_once("config/connexion.php");
 		connexion::connect();
  		require_once("model/AlerteClient.php");

		if (! $_SESSION['MotDePasseGestionnaire']){
			header('location: Compte.html');
		}
		if(isset($_GET['back'])){
			header('location: ConsulterAlerte.php');
			exit();
        }

		$tableauAlerteClient = AlerteClient::getAll();
		$i = 0;
		foreach ($tableauAlerteClient as $AlerteClient){
			$i+=1;
			echo '<div class="Commande">';
			echo	'<div class="Heure"> <p>"'.$AlerteClient->get('ID_AlerteClient').'"</p> </div>';
			echo	'<div class="TypePaiement"> <p>"'.$AlerteClient->get('Message').'"</p> </div>';
			echo	'<div class="Statut"> <p>"'.$AlerteClient->get('ID_Client').'"</p> </div>';
			echo '</div>';
		}
  ?>
  <footer>
    <small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
  
</body>
</html>
