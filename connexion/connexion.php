<?php
session_start(); // à mettre tout en haut du fichier .php, cette fonction propre à PHP servira à maintenir la $_SESSION
if(isset($_POST['login'])) { // si le bouton "login" est appuyé
       //on se connecte à la base de données:
	   $mysqli = mysqli_connect('localhost', 'root','','eventus');
            // les champs sont bien posté et pas vide, on sécurise les données entrées par le membre:
            $email = htmlentities($_POST['email'], ENT_QUOTES, "ISO-8859-1"); // le htmlentities() passera les guillemets en entités HTML, ce qui empêchera les injections SQL
            $password = htmlentities($_POST['password'], ENT_QUOTES, "ISO-8859-1");
         
            //on vérifie que la connexion s'effectue correctement:
            if(!$mysqli){
                echo "Erreur de connexion à la base de données.";
            } else {
                // on fait maintenant la requête dans la base de données pour rechercher si ces données existe et correspondent:
				$mailC= mysqli_query($mysqli,"SELECT * FROM client WHERE emailC = '".$email."'");
				$mailP= mysqli_query($mysqli,"SELECT * FROM pro WHERE emailP = '".$email."'");
				$passwordC= mysqli_query($mysqli,"SELECT * FROM client WHERE pswrdC = '".$password."'");
				$passwordP= mysqli_query($mysqli,"SELECT * FROM pro WHERE pswP = '".$password."'");
                // si il y a un résultat, mysqli_num_rows() nous donnera alors 1
                // si mysqli_num_rows() retourne 0 c'est qu'il a trouvé aucun résultat
                if(mysqli_num_rows($mailC) == 0) {
					if(mysqli_num_rows($mailP) == 0) {
						echo '<script language="javascript">';
	                echo 'alert("L email incorrect, le compte n a pas été trouvé.")';
	                echo '</script>';
					} else {
						if(mysqli_num_rows($passwordP) == 0) {
					
							echo '<script language="javascript">';
	                echo 'alert(" le mot de passe est incorrect, le compte n a pas été trouvé.")';
	                echo '</script>';
						} else {
							// on ouvre la session avec $_SESSION:
							$_SESSION['email'] = $email; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
							header("location:../pro/acceuilP.php"); 
						}
					}
					
                } else {
					if(mysqli_num_rows($passwordC) == 0) {
					
						echo '<script language="javascript">';
	                echo 'alert("le mot de passe est incorrect, le compte n a pas été trouvé.")';
	                echo '</script>'; 
					} else {
						// on ouvre la session avec $_SESSION:
						$_SESSION['email'] = $email; // la session peut être appelée différemment et son contenu aussi peut être autre chose que le pseudo
						header("location:../client/acceuilC.php"); 
					}
                   
                }
            }
}
		

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> connexion</title>
	<meta charset="UTF-8">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
				<a href="../index.html">	<img src="images/favicon.png" alt="IMG"></a>
				</div>

				<form class="login100-form validate-form" action="connexion.php" method="post">
					<span class="login100-form-title">
						connexion
					</span>
                   
                    <div class="wrap-input100 validate-input" data-validate = "Votre adresse courriel doit être valide: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>
				
					<div class="wrap-input100 validate-input" data-validate = "Mot de passe requis">
						<input class="input100" type="password" id="password" name="password" placeholder="Mot de passe">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="login" >
							Login
						</button>
					</div>

					<div class="text-center p-t-40">
					Vous n’avez pas de compte?
						<a class="txt2" href="../client/inscription.php"aria-hidden="true">
						client
				
						</a>
						/
						<a class="txt2" href="../pro/inscription.php"aria-hidden="true">
					pro
				
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>	
<!--===============================================================================================-->	
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
</body>
</html>
