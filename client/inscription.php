<?php
session_start();
//connect to dB
$db=mysqli_connect('localhost', 'root','','eventus');
if (isset($_POST['inscription'])) {
	$email = trim(htmlentities($_POST['email'], ENT_QUOTES));
	$nom= trim(htmlentities($_POST['nomC'], ENT_QUOTES));
	$password = trim(htmlentities($_POST['password'], ENT_QUOTES));
	$password2 = trim(htmlentities($_POST['password2'], ENT_QUOTES));
$mailC = mysqli_query($db, "SELECT * FROM client WHERE emailC = '".$_POST['email']."'");
$nomC = mysqli_query($db, "SELECT * FROM client WHERE nomC = '".$_POST['nomC']."'");
$mailP = mysqli_query($db, "SELECT * FROM pro WHERE emailP = '".$_POST['email']."'");
$nomP = mysqli_query($db, "SELECT * FROM pro WHERE nomP = '".$_POST['nomC']."'");
if(mysqli_num_rows($nomC) OR mysqli_num_rows($nomP)) {
	echo '<script language="javascript">';
	echo 'alert("ce nom est déjà utilisé")';
	echo '</script>';
}elseif(mysqli_num_rows($mailC)|| mysqli_num_rows($mailP)) {
	echo '<script language="javascript">';
	echo 'alert("Cette adresse email est déjà utilisé")';
	echo '</script>';
}else{
//create client
$sql="INSERT INTO client(nomC,emailC,pswrdC) VALUES('$nom','$email','$password')";
mysqli_query($db,$sql);
header("location:acceuilC.php");  

}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> client</title>
	<meta charset="UTF-8">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="../connexion/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../connexion/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../connexion/fonts/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../connexion/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../connexion/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../connexion/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../css/util.css">
	<link rel="stylesheet" type="text/css" href="../connexion/css/main.css">
<!--===============================================================================================-->
<script type="text/javascript">
    function confirmPass() {
        var pass = document.getElementById("password").value
        var confPass = document.getElementById("password2").value
        if(pass != confPass) {
            alert('Les mots de passe doivent être identiques !');
        }
    }
</script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
				<a href="../index.html">	<img src="../connexion/images/favicon.png" alt="IMG"></a>
				</div>

				<form class="login100-form validate-form" action="inscription.php" method="post">
					<span class="login100-form-title">
						inscription client
					</span>
                    <div class="wrap-input100 validate-input" data-validate = "nom de pro est requis">
						<input class="input100" type="text" name="nomC" placeholder="username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
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
					<div class="wrap-input100 validate-input" data-validate = "Confirmer le mot de passe est requis">
						<input class="input100" type="password" name="password2" id="password2" placeholder="Confirmez le mot de passe" onblur="confirmPass()">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button class="login100-form-btn" name="inscription" >
							Login
						</button>
					</div>

					<div class="text-center p-t-25">
					Avez-vous un compte ?!
						<a class="txt2" href="../connexion/connexion.php"aria-hidden="true">
						connectez-vous à votre compte
				
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>	
<!--===============================================================================================-->	
<script src="../connexion/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../connexion/vendor/bootstrap/js/popper.js"></script>
	<script src="../connexion/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../connexion/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../connexion/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../connexion/js/main.js"></script>
</body>
</html>
