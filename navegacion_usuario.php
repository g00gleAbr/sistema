<?php ob_start(); ?>
<?php 
session_start();
if (!isset($_SESSION['correo'])) {
  header("Location: index.php?no_user=No te has identificado!");
  exit();
}else{
?>
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
	<title></title>
</head>
<body>
<script src="css/sweetalert-master/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="css/materialize/js/materialize.min.js"></script>
<?php
include("conexion.php");
?>
<nav class="blue lighten-1">
	<div class="nav-wrapper">
		<a href="panel_usuario.php" class="brand-logo" style="padding-left:20px;">CbPanel</a>
      	<ul id="nav-mobile" class="right hide-on-med-and-down">
        	<li><a class="modal-trigger waves-effect waves-light" href="#modal5"><i class="material-icons left">contact_mail</i>Contacto</a></li>
        	<li> <a class="waves-effect waves-light datepicker"><i class="material-icons left">date_range</i>Ver calendario</a>
      	</ul>
    </div>
</nav>
<!--modal-->
<div id="modal5" class="modal">
  <div class="modal-content">
      <h5>Área de contacto</h5>
      <p>Si tienes alguna duda de la plataforma o alguna corrección escribe al siguiente correo y se te dará respuesta</p>
      <a href="#!">ayala.jap@gmail.com</a>
      <p>Si tienes más inquietudes puedes escribir por chat dando click <a href="https://twitter.com/abr_ap">aquí</a></p>
    </div>
    <div class="modal-footer">
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>
</div>

<div class="row"> 
  <div class="col s3">
    <section class="z-depth-1" id="contenedor" style="background-image:url('imagenes/design.jpg');">
      <?php 
      $usuario = $_SESSION['correo'];
      $select_img = "SELECT * FROM usuarios WHERE correo = '$usuario'";
      $res = mysqli_query($conexion,$select_img);

      $row_img = mysqli_fetch_array($res);
      $foto_usuario = $row_img['foto'];
      $nombre_usuario = $row_img['nombre'];
      echo "
      <div style='padding-top:19px; padding-left:25px;'>
        <img width='80' style='display:inline-block;' src='imagenes/alumnos/$foto_usuario' class='circle' />
        <a style='display:inline-block; float:right; padding-top:25px;' class='dropdown-button' href='#!' data-activates='dropdown1'>$nombre_usuario<i class='material-icons right'>arrow_drop_down</i>
        <p>Alumno</p></a>
      </div>
      ";
      ?>
    </section>
    <section class="z-depth-1" align="left" id="enlaces" style="background-color:#ffffff;">
      <br>
      <a class="btn-flat waves-effect waves-grey" href="panel_usuario.php">Tablero<i style="font-size:30px;" class="material-icons left">dashboard</i></a>
      <p class="divider"></p>
      <a class="btn-flat waves-effect waves-grey" href="panel_usuario.php?crear_nota">Crear nota<i style="font-size:30px;" class="material-icons left">note_add</i></a>
      <p class="divider"></p>
      <a class="btn-flat waves-effect waves-grey" href="panel_usuario.php?cambiar_pass"><i style="font-size:30px;" class="material-icons left">security</i>Cambiar contraseña</a><br>
      <p class="divider"></p>
      <a class="btn-flat waves-effect waves-grey" href="panel_usuario.php?ver_calificaciones"><i style="font-size:30px;" class="material-icons left">pageview</i>Ver calificaciones</a><br>
      <p class="divider"></p>
      <a class="btn-flat waves-effect waves-grey" href="anuncios.php"><i style="font-size:30px;" class="material-icons left">announcement</i>Ver anuncios</a><br>
      <p class="divider"></p>
      <a class="btn-flat waves-effect waves-grey" href="panel_usuario.php?enviar_comentario">Envia un comentario<i style="font-size:30px;" class="material-icons left">comment</i></a>
    </section>
  </div>
<script type="text/javascript">
	  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15
  });
</script>
<script type="text/javascript">
 $(document).ready(function(){
    $('.modal-trigger').leanModal();
});
</script>
<script type="text/javascript">
  $(".dropdown-button").dropdown();
</script>
</body>
</html>
<?php } ?>
<?php ob_end_flush(); ?>