<?php ob_start(); ?>
<!DOCTYPE html>
<html>
<head>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/main.css">
<link rel="stylesheet" type="text/css" href="css/sweetalert-master/dist/sweetalert.css">
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link type="text/css" rel="stylesheet" href="css/materialize/css/materialize.min.css"  media="screen,projection"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>Inicio</title>
</head>
<body>
<script src="css/sweetalert-master/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="css/materialize/js/materialize.min.js"></script>
<?php include("conexion.php");
session_start(); ?>
<nav class="cyan darken-3">
	<div class="nav-wrapper">
		<a href="index.php" class="brand-logo" style="padding-left:20px;">CBTis 204</a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="#modal1" class="waves-effect waves-light modal-trigger">Iniciar sesión</a></li>
			<li><a href="#modal2" class="waves-effect waves-light modal-trigger">Admin</a></li>
		</ul>
	</div>
</nav>
<!-- Inicio se sesión usuario -->
<div id="modal1" class="modal">
	<div class="modal-content" align="center">
    	<h4>Iniciar sesión</h4>
      	<p>Ingreso de alumnos, si no tienes una cuenta regístrate</p>
      	<form action="" method="post">
      		<div class="row container">
      			<div class="input-field col s10">
      				<i class="material-icons prefix">account_circle</i>
      				<input type="text" name="correo_usuario" id="mail">
      				<label for="mail">Correo</label>
      			</div>
      			<div class="input-field col s10">
      				<i class="material-icons prefix">vpn_key</i>
      				<input type="password" name="pass_usuario" id="pass">
      				<label for="pass">Contraseña</label>
      			</div>
      			<button type="sumit" style="width:250px;" class="btn waves-effect waves-light blue-grey lighten-2" name="inicia_usuario">Iniciar Sesión</button>
      		</div>
      	</form>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>
<?php 
if (isset($_POST['inicia_usuario'])) {
	$correo_usuario = $_POST['correo_usuario'];
	$pass_usuario = $_POST['pass_usuario'];

	$selecciona_usuario = "SELECT * FROM usuarios WHERE correo = '$correo_usuario' AND pass = '$pass_usuario'";
	$query_selecciona = mysqli_query($conexion,$selecciona_usuario);
	$revisa_usuario = mysqli_num_rows($query_selecciona);
	if ($revisa_usuario == 1) {
		$_SESSION['correo'] = $correo_usuario;
		header('Location: panel_usuario.php');
	}else{
		echo "Correo o contraseña incorrectos, intenta de nuevo.";
	}
}
?>
<!-- Inicio se sesión administrador-->
<div id="modal2" class="modal">
	<div class="modal-content" align="center">
    	<h4>Administrador</h4>
      	<p>Sólo personal autorizado tiene acceso</a></p>
      	<form action="" method="post">
      		<div class="row container">
      			<div class="input-field col s10">
      				<i class="material-icons prefix">account_circle</i>
      				<input type="text" name="correo_admin" id="mail">
      				<label for="mail">Correo</label>
      			</div>
      			<div class="input-field col s10">
      				<i class="material-icons prefix">vpn_key</i>
      				<input type="password" name="pass_admin" id="pass">
      				<label for="pass">Contraseña</label>
      			</div>
      			<button type="sumit" style="width:250px;" class="btn waves-effect waves-light blue-grey lighten-2" name="inicia_admin">Iniciar Sesión</button>
      		</div>
      	</form>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
    </div>
</div>
<?php 
if (isset($_POST['inicia_admin'])) {
	$correo_admin = $_POST['correo_admin'];
	$pass_admin = $_POST['pass_admin'];

	$selecciona_admin = "SELECT * FROM administradores WHERE correo = '$correo_admin' AND pass = '$pass_admin'";
	$query_selecciona_admin = mysqli_query($conexion,$selecciona_admin);
	$revisa_admin = mysqli_num_rows($query_selecciona_admin);
	if ($revisa_admin == 0) {
		echo "Contraseña o correo incorrectos, intenta de nuevo, regresa e inicia de nuevo";
		echo "<br><br> <a href='index.php'>Iniciar de nuevo</a>";
		exit();
	}else{
		$_SESSION['correo'] = $correo_admin;
		header('Location: panel_admin.php');		
	}
}
?>
<!--Informacion-->
<br><br>
<center>
	<h4 class="blue-text">Centro de Bachillerato Tecnológico<br>Industrial y de Servicios no. 204</h4>
	<p>Plataforma de alumnos</p>
	<a id="boton-redondo" style="width:250px;" href="index.php?registro" class="btn waves-effect waves-light">Regístrate</a>
</center>
<br>
<p class="divider"></p>
<br>
<center>
	<?php 
			if (isset($_GET['registro'])) {
				include("registro.php");
			}
		?>
</center>
<br>
<div class="row container">
<h4>Información</h4>
<br>
	<div class="col s4">
	<img src="imagenes/avatar.png" width="250">
		<p>
			Este sistema de usuarios está creado para tener un
			control más agil de el personal docente y alumnos. 
			<br><br>
			Debes tener en cuenta que cada alumno tiene un
			número de matricula único, por lo cual las consultas
			para cada alumno son hechas desde el nombre
			completo, para mayor facilidad de información
			del mismo. 
			<br><br>
			Al momento de hacer las modificaciones,
			debes tener mucho cuidado si cambias
			el número de matricula o algun dato importante 
			Ya que por ejemplo la matricula,
			es un dato único del alumno,
			que innecesariamente debes modificar.
		</p>
	</div>
	<div class="col s4">
	<img src="imagenes/pc.png" width="268">
		<p style="padding-top:50px;">
			Está plataforma está optimizada para Google Chrome 
			lo cual es recomendable usarla en este navegador,
			para tener una mejor vista de la página.
			<br><br>
			Cada alumno y profesor, tiene su propio correo electrónico,
			el cual se enlaza a la siguiente plataforma:
			<a href="http://webmail.cbtis204.edu.mx/" target="_blank">Roundcube</a>
			<br><br>
			Desde aquí se podrán contactar, ya que los correos
			son creados con el dominio del plantel.
		</p>
	</div>
	<div class="col s4">
		<img src="imagenes/code.png" width="300">
		<p>
			Éste sistema de usuarios está hecho en PHP, 
			su gestor de base de datos es por defecto es MySQL

			Sí se presentara algún fallo o cambio, favor de 
			reportarlo al creador de ésta plataforma al correo: 
			<a href="#">ayala.jap@gmail.com</a>
		</p>
	</div>
</div>
<center>
	<div class="card-panel" style="width:700px;">
		<span class="blue-text text-darken-2">Ahora que ya has leído un poco las indicaciones, puedes continuar al sistema.<br>
		Bienvenido</span>
	</div>
</center>
<div class="footer-copyright blue-grey lighten-3">
	<div class="container white-text">
		 Hecho por Abraham Ayala
	</div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.modal-trigger').leanModal();
});
</script>
<script type="text/javascript">
	  $(document).ready(function(){
      $('.parallax').parallax();
    });
</script>
</body>
</html>
<?php ob_end_flush(); ?>