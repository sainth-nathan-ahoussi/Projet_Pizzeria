<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
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
	 <main>
	 <?php
		session_start();
		if (! $_SESSION['MotDePasseClient']){
			header('location: Compte.html');
		}
		if(isset($_GET['Deconnexion'])){
			$_SESSION = array();
			session_destroy();
			header('location: Compte.html');
			exit();

		}else if(isset($_GET['maintenance'])){

		}
    ?>
		<div class="Commande"><p>Mon Compte</p></div>
		<div class="Commande"><p>Mes Commandes</p></div>
		<div class="Commande"><p>Mes Adresses</p></div>
		<div class="Commande"><p>Mes Bons de réduction</p></div>
		<div class="Commande"><p>À propos</p></div>
		<form method="get">
			<div class="boutons">
				 <div  id="bouton">
					 <input type="submit" value="Deconnexion" name="Deconnexion">
				 </div>
			 </div>
		 </form>
		
	 </main>
	  

  <footer>
	<small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
</body>
</html>