<!DOCTYPE html>
<html>
<head>
	<title>Resultados</title>
</head>
<body>
<?php
include("conexion.php");
require_once("navegacion_admin.php");
?>
<div class="col s9 z-depth-1" style="background-color:#ffffff;">
<div class="card-panel">
	<span class="blue-text text-darken-2"><i class="material-icons left">search</i>Información del alumno</span>
</div>
<?php 
if (isset($_GET['buscar_alumn'])) {
	$buscar = $_GET['buscar_alumn'];
	$query = "SELECT * FROM usuarios WHERE nombre LIKE '%$buscar%'";
	$resultado = mysqli_query($conexion,$query);

	$contador_busqueda = mysqli_num_rows($resultado);
	if ($contador_busqueda == 0) {
		echo "No se encontró ningun alumno.";
	}
	while ($row = mysqli_fetch_array($resultado)){
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
	</section>
</div>
	<?php
	}
}
?>
<?php 
if(isset($_GET['id_estudiante'])) {
	$id_estudiante = $_GET['id_estudiante'];
	$selec_alumn = "SELECT * FROM usuarios WHERE id = '$id_estudiante'";
	$query_alumno = mysqli_query($conexion,$selec_alumn);

	while($row_alumno = mysqli_fetch_array($query_alumno)){
		$matricula_alumno = $row_alumno['matricula'];
		$nombre_alumno = $row_alumno['nombre'];
		$correo_alumno = $row_alumno['correo'];
		$grado_alumno = $row_alumno['grado'];
		$grupo_alumno = $row_alumno['grupo'];
		$especialidad_alumno = $row_alumno['especialidad'];
		$telefono_alumno = $row_alumno['telefono'];
		$direccion_alumno = $row_alumno['direccion'];

		$select_grupo_alumno = "SELECT * FROM grupo WHERE id = '$grupo_alumno'";
		$query_grupo_alumno = mysqli_query($conexion,$select_grupo_alumno);
		$row_grupo_alumno = mysqli_fetch_array($query_grupo_alumno);
		$nombre_grupo_alumno = $row_grupo_alumno['grupo'];

		$select_especialidad = "SELECT * FROM especialidad WHERE id = '$especialidad_alumno'";
		$query_esp_alumno = mysqli_query($conexion,$select_especialidad);
		$row_esp_alumno = mysqli_fetch_array($query_esp_alumno);
		$nombre_esp_alumno = $row_esp_alumno['nombre'];
?>
	<div class="row" style="padding-left:45px;">
	<section class="col s4">
		<article>
			<p class="gris">Matricula</p>
			<?php echo $matricula_alumno; ?>

			<p class="gris">Nombre</p>
			<?php echo $nombre_alumno; ?>

			<p class="gris">Correo</p>
			<?php echo $correo_alumno; ?>
		</article>
	</section>
	<section class="col s4">
		<article>
			<p class="gris">Grado</p>
			<?php echo $grado_alumno; ?>

			<p class="gris">Grupo</p>
			<?php echo $nombre_grupo_alumno; ?>

			<p class="gris">Especialidad</p>
			<?php echo $nombre_esp_alumno; ?>
		</article>
	</section>
	<section class="col s4">
		<p class="gris">Teĺéfono</p>
		<?php echo $telefono_alumno; ?>

		<p class="gris">Dirección</p>
		<?php echo $direccion_alumno; ?>
	</section>
</div>
<?php } }?>
</div>
</body>
</html>