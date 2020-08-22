<?php
session_start();
//connect to dB
$db=mysqli_connect('localhost', 'root','','eventus');
if (isset($_POST['inscription'])) {
	$email = trim(htmlentities($_POST['email'], ENT_QUOTES));
	$nomP= trim(htmlentities($_POST['nomP'], ENT_QUOTES));
	$wilaya = trim(htmlentities($_POST['wilaya'], ENT_QUOTES));
	$password = trim(htmlentities($_POST['password'], ENT_QUOTES));
$mailC = mysqli_query($db, "SELECT * FROM client WHERE emailC = '".$_POST['email']."'");
$nomC = mysqli_query($db, "SELECT * FROM client WHERE nomC = '".$_POST['nomP']."'");
$mailPro = mysqli_query($db, "SELECT * FROM pro WHERE emailP = '".$_POST['email']."'");
$nomPro = mysqli_query($db, "SELECT * FROM pro WHERE nomP = '".$_POST['nomP']."'");
if(mysqli_num_rows($nomC) OR mysqli_num_rows($nomPro)) {
	echo '<script language="javascript">';
	echo 'alert("ce nom est déjà utilisé")';
	echo '</script>';
}elseif(mysqli_num_rows($mailC)|| mysqli_num_rows($mailPro)) {
	echo '<script language="javascript">';
	echo 'alert("Cette adresse email est déjà utilisé")';
	echo '</script>';
}else{
//create pro

$sql="INSERT INTO pro(nomP,emailP,pswP,Adresse) VALUES('$nomP','$email','".hash('sha256', $password)."','$wilaya')";
mysqli_query($db,$sql);
header("location:acceuilP.php");  
}}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> pro</title>
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
					<a href="../index.html"><img src="../connexion/images/favicon.png" alt="IMG"></a>
				</div>

				<form class="login100-form validate-form" action="inscription.php" method="post">
					<span class="login100-form-title">
						inscription pro
					</span>
                    <div class="wrap-input100 validate-input" data-validate = "nom de pro est requis">
						<input class="input100" type="text" name="nomP" placeholder="username">
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
				
                                    <div class="wrap-input100 validate-input" >
									<span class="symbol-input100"> <i class="fa fa-map-marker" aria-hidden="true"></i></span>
									<span class="focus-input100"></span>
                                        <select class="input100" name="wilaya" required>
											<option value="" disabled selected hidden>Veuillez choisir wilaya...</option>
										    <option value="Adrar">Adrar</option>
                                            <option value="Chlef">Chlef</option>
											<option value="Laghouat">Laghouat</option>
											<option value="Oum El Bouaghi">Oum El Bouaghi</option>
											<option value="Batna">Batna</option>
											<option value="Béjaïa">Béjaïa</option>
                                            <option value="Biskra">Biskra</option>
											<option value="Béchar">Béchar</option>
											<option value="Blida">Blida</option>
											<option value="Bouira">Bouira</option>
											<option value="Tamanrasset">Tamanrasset</option>
                                            <option value="Tébessa">Tébessa</option>
											<option value="Tlemcen">Tlemcen</option>
											<option value="Tiaret">Tiaret</option>
											<option value="Tizi Ouzou">Tizi Ouzou</option>
											<option value="Alger">Alger</option>
                                            <option value="Djelfa">Djelfa</option>
											<option value="Jijel">Jijel</option>
											<option value="Sétif">Sétif</option>
											<option value="Saïda">Saïda </option>
											<option value="Skikda">Skikda</option>
                                            <option value="Sidi Bel Abbès">Sidi Bel Abbès</option>
											<option value="Annaba">Annaba</option>
											<option value="Guelma">Guelma</option>
											<option value="Constantine">Constantine</option>
											<option value="Médéa">Médéa</option>
                                            <option value="Mostaganem">Mostaganem</option>
											<option value="MSila">MSila</option>
											<option value="Mascara">Mascara</option>
											<option value="Ouargla">Ouargla</option>
											<option value="Oran">Oran</option>
                                            <option value="El Bayadh">El Bayadh</option>
											<option value="Illizi">Illizi</option>
											<option value="Bordj Bou Arreridj">Bordj Bou Arreridj</option>
											<option value="Boumerdès">Boumerdès</option>
											<option value="El Tarf">El Tarf</option>
                                            <option value="Tindouf">Tindouf</option>
											<option value="Tissemsilt">Tissemsilt</option>
											<option value="El Oued">El Oued</option>
											<option value="Khenchela">Khenchela</option>
											<option value="Souk Ahras">Souk Ahras</option>
                                            <option value="Tipaza">Tipaza</option>
											<option value="Mila">Mila</option>
											<option value="Aïn Defla">Aïn Defla</option>
											<option value="Naâma">Naâma</option>
											<option value="Aïn Témouchent">Aïn Témouchent</option>
                                            <option value="Ghardaia">Ghardaia</option>
											<option value="Relizane">Relizane</option>	
										</select>
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

					<div class="text-center p-t-40">
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
