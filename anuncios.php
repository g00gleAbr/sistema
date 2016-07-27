<!DOCTYPE>
<html>
<head>
<?php header('Content-Type: text/html; charset=utf-8'); ?>
	<title>Avisos</title>
</head>
<body>
<?php
include("conexion.php");
require_once("navegacion_usuario.php");
?>
<div class="col s9 z-depth-1" style="background-color:#ffffff;">
<div class="card-panel">
	<span class="blue-text text-darken-2"><i class="material-icons left">announcement</i>Todos los anuncios del plantel</span>
</div>
<center>
<?php 
$url = "anuncios.php";
$consulta_noticias = "SELECT * FROM noticias";
$rs_noticias = mysqli_query($conexion, $consulta_noticias);
$num_total_registros = mysqli_num_rows($rs_noticias);
if ($num_total_registros > 0) {
	$TAMANO_PAGINA = 2;
        $pagina = false;
        if (isset($_GET["pagina"]))
            $pagina = $_GET["pagina"];
	if (!$pagina) {
		$inicio = 0;
		$pagina = 1;
	}
	else {
		$inicio = ($pagina - 1) * $TAMANO_PAGINA;
	}
	$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);
	echo '<p>Mostrando la pagina '.$pagina.' de ' .$total_paginas.' paginas.</p>';
	$consulta = "SELECT * FROM noticias ORDER BY id DESC LIMIT ".$inicio."," . $TAMANO_PAGINA;
	$rs = mysqli_query($conexion,$consulta);
	while ($row = mysqli_fetch_array($rs)) {
		$id = $row['id'];
		$titulo = $row['titulo'];
		$descripcion = $row['descripcion'];
		$fecha = $row['fecha'];
	?>
	<div class="card-panel">
		<span class="center-align">
			<a href="#!" style="font-size:17px;" class="blue-text text-darken-2 tooltipped" data-position="top" data-delay="50" data-tooltip="Este es el titulo"><?php echo $titulo; ?></a><br><br>
			<a href="#!" style="font-size:13px; color:#9e9e9e;" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Esta es la descripcion"><?php echo $descripcion; ?></a><br><br>
			<a href="#!" style="font-size:13px;" class="tooltipped" data-position="top" data-delay="50" data-tooltip="Esta es la fecha a realizar"><?php echo $fecha; ?></pa
		</span>
	</div>
	<?php } ?>
	<?php 

	echo '<ul class="pagination">';

	if ($total_paginas > 1) {
		if ($pagina != 1)
			echo '<a class="waves-effect" href="'.$url.'?pagina='.($pagina-1).'"><i class="material-icons">chevron_left</i></a>';
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($pagina == $i){
				echo '<li class="waves-effect active" style="color:#ffffff;">';
				echo $pagina;
				echo '</li>';
			}
			else{
				echo "<li class='waves-effect'>";
				echo '<a href="'.$url.'?pagina='.$i.'">'.$i.'</a>  ';
				echo "</li>";
			}
		}
		if ($pagina != $total_paginas)
			echo '<a class="waves-effect" href="'.$url.'?pagina='.($pagina+1).'"><i class="material-icons">chevron_right</i></a>';
	}
	echo '</ul>';
}
?>
</center>
</div>
</body>
</html>