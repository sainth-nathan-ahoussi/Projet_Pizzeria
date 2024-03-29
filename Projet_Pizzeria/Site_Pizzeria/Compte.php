<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" href="IMG/LogoCorner.png">
  <link rel="stylesheet" type="text/css" href="CSS/style2.css">
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
			<li><a href="PanierVide.php"><img src="IMG/LogoPanier.png" alt="Logo"></a></li>
			<li><a href="InfoUtilisateur.php"><img src="IMG/LogoCompte.png" alt="Logo"></a></li>
		  </ul>
		</div>
	 <main>
	 <?php
	 		session_start();
			require_once("config/connexion.php");
			connexion::connect();
			require_once("model/Client.php");
			require_once("model/Gestionnaire.php");
			require_once("model/Ville.php");

			$tableauGestionnaire = Gestionnaire::getAll();
			$tableauClients = Client::getAll();

			if (! $_SESSION['MotDePasseGestionnaire']){
				header('location: Compte.html');
			}
			
			if(isset($_GET['Connecter'])){
				if ($_SERVER["REQUEST_METHOD"] === "GET") {
					$emailConnexion = $_GET["email"];
					$mdpConnexion = $_GET["mdp"];

					foreach ($tableauGestionnaire as $Gestionnaire) {
						$VerifemailConnexionGes = $Gestionnaire->get('mailGestionnaire');
						$VerifmdpConnexionGes = $Gestionnaire->get('MotPasseGestionnaire');
						$VerifLoginConnexionGes = $Gestionnaire->get('loginGestionnaire');
						
						if ($emailConnexion === $VerifemailConnexionGes && $mdpConnexion === $VerifmdpConnexionGes) {
							$message = 'Bonjour ' . $emailConnexion;
							echo $message;
							 session_start();
							$_SESSION['AdresseMailGestionnaire'] = $emailConnexion ;
							$_SESSION['MotDePasseGestionnaire'] = $mdpConnexion ;
							header('location: Gestionnaire.php');
							
							exit();
							break;
						}else if ($emailConnexion === $VerifLoginConnexionGes && $mdpConnexion === $VerifmdpConnexionGes) {
							$message = 'Bonjour ' . $emailConnexion;
							echo $message;
							 session_start();
							 $_SESSION['AdresseMailGestionnaire'] = $emailConnexion ;
							 $_SESSION['MotDePasseGestionnaire'] = $mdpConnexion ;
							header('location: Gestionnaire.php');
		
							// echo '<script language="javascript"> alert("bonjour '. $emailConnexion. ' "); </script>';
							exit();
							break;
						}
					}

					foreach ($tableauClients as $Client) {
						$VerifemailConnexionCli = $Client->get('AdresseMailClient');
						$VerifmdpConnexionCli = $Client->get('MotDePasseClient');
						$ID_Client = $Client->get('ID_Client');
						if ($emailConnexion === $VerifemailConnexionCli && $mdpConnexion === $VerifmdpConnexionCli) {
							$message = 'Bonjour ' . $emailConnexion;
							echo $message;
						    session_start();
							 $_SESSION['AdresseMailClient'] = $emailConnexion ;
							 $_SESSION['MotDePasseClient'] = $mdpConnexion ;
							 $_SESSION['ID_Client'] = $ID_Client ;
							header('location: NotreCarte.php');
							// echo '<script language="javascript"> alert("bonjour '. $emailConnexion. ' "); </script>';
							exit();
							break;
						}
					}
				}
			}else if (isset($_GET['Inscrire'])){
				if ($_SERVER["REQUEST_METHOD"] === "GET") {
					$NomClient = $_GET["Nom"];
					$PrenomClient = $_GET["Prenom"];
					$TelClient = $_GET["numero"];
					$emailClient = $_GET["email"];
					$AdresseClient = $_GET["Adresse"];
					$CodePostal = $_GET["CodePostal"];
					$MotPasseClient = $_GET["mdp1"];
					foreach ($tableauGestionnaire as $Gestionnaire){
						$VerifemailConnexionGes = $Gestionnaire->get('mailGestionnaire');
						if($emailClient !== $VerifemailConnexionGes){
							foreach ($tableauClients as $Client) {
								$VerifemailConnexionCli = $Client->get('AdresseMailClient');			
								if($emailClient !== $VerifemailConnexionCli){
									Client::create($NomClient, $PrenomClient, $TelClient, $emailClient, $AdresseClient, $MotPasseClient);
									Ville::create($AdresseClient, $CodePostal);
			
									header('location: Compte.html');
									exit();

								}else{
									$message = 'Ce mail est déja utilisé';
									echo $message; // faire alerte
									break;
							
								}
							}
						}else{
							$message = 'Ce mail est déja utilisé';
							echo $message; // faire alerte
							break;
						}
				    }
			   }
			}else if (isset($_GET['Guest'])) {
				session_start();
				header('location: NotreCarteGuest.php');
				exit();

			}
			
			
			
		?>

	 </main>
	  

  <footer>
	<small>Copyright © 2023 - ALTA MAMA - Création site web par Nathan_Corentin - Commander en ligne</small>
  </footer>
  
</body>
</html>