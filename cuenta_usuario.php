<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card-panel">
	<span class="blue-text text-darken-2"><i class="material-icons left">account_box</i>Información de alumno</span>
</div>
<?php 
$usuario = $_SESSION['correo'];
$select = "SELECT * FROM usuarios WHERE correo = '$usuario'";
$query_select = mysqli_query($conexion,$select);
while ($row = mysqli_fetch_array($query_select)) {
	$matricula = $row['matricula'];
	$nombre = $row['nombre'];
	$correo = $row['correo'];
	$grado = $row['grado'];
	$grupo = $row['grupo'];
	$especialidad = $row['especialidad'];
	$telefono = $row['telefono'];
	$direccion = $row['direccion'];

	$select_grupo = "SELECT * FROM grupo WHERE id = '$grupo'";
	$query_grupo = mysqli_query($conexion,$select_grupo);
	$row_grupo = mysqli_fetch_array($query_grupo);
	$nombre_grupo = $row_grupo['grupo'];

	$select_especialidad = "SELECT * FROM especialidad WHERE id = '$especialidad'";
	$query_esp = mysqli_query($conexion,$select_especialidad);
	$row_esp = mysqli_fetch_array($query_esp);
	$nombre_esp = $row_esp['nombre'];
}
?>
<div class="row" style="padding-left:45px;">
	<section class="col s4">
		<article>
			<p class="gris">Matricula</p>
			<?php echo $matricula; ?>

			<p class="gris">Nombre</p>
			<?php echo $nombre; ?>

			<p class="gris">Correo</p>
			<?php echo $correo; ?>
		</article>
	</section>
	<section class="col s4">
		<article>
			<p class="gris">Grado</p>
			<?php echo $grado; ?>

			<p class="gris">Grupo</p>
			<?php echo $nombre_grupo; ?>

			<p class="gris">Especialidad</p>
			<?php echo $nombre_esp; ?>
		</article>
	</section>
	<section class="col s4">
		<p class="gris">Teĺéfono</p>
		<?php echo $telefono; ?>

		<p class="gris">Dirección</p>
		<?php echo $direccion; ?>
		<br><br>
		<a href="panel_usuario.php?modificar_datos">Modificar datos</a>
	</section>
</div>
</body>
</html>