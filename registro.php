<?php 
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<center>
<?php
include ("conexion.php");
 ?>
<p style="font-size:25px;" class="blue-text text-darken-2">Área de registro</p>
<p style="font-size:13px;">Toda tu información es privada y uso de la escuela.</p>
	<div class="row container" style="padding-left:100px;">
		<form action="" method="post" enctype="multipart/form-data">
		<div class="input-field col s6">
				<select name="grado">
					<option disabled selected>Semestre</option>	
					<?php 
					$grado = "SELECT * FROM grado";
					$query_grado = mysqli_query($conexion,$grado);
					while ($row_grado = mysqli_fetch_array($query_grado)) {
						$id_grado = $row_grado['id'];
						$nombre_grado = $row_grado['nombre'];
						echo "
						<option value = '$id_grado'>$nombre_grado</option>
						";
					}
					?>
				</select>
			</div>
			<div class="input-field col s6">
				<select name="grupo">
					<option disabled selected>Grupo</option>	
					<?php 
					$grupo = "SELECT * FROM grupo";
					$query_grupo = mysqli_query($conexion,$grupo);
					while ($row = mysqli_fetch_array($query_grupo)) {
						$id_grupo = $row['id'];
						$nombre_grupo = $row['grupo'];
						echo "
						<option value='$id_grupo'>$nombre_grupo</option>
						";
					}
					?>
				</select>
			</div>
			<div class="input-field col s6">
				<select name="especialidad">
					<option disabled selected>Especialidad</option>
					<?php 
					$especialidad = "SELECT * FROM especialidad";
					$query_especialidad = mysqli_query($conexion,$especialidad);
					while ($row_especialidad = mysqli_fetch_array($query_especialidad)) {
						$id_especialidad = $row_especialidad['id'];
						$nombre_especialidad = $row_especialidad['nombre'];

						echo "
						<option value='$id_especialidad'>$nombre_especialidad</option>
						";
					}
					?>
				</select>
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">credit_card</i>
				<input type="text" name="matricula" placeholder="Matrícula de alumno">
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">face</i>
				<input type="text" name="nombre" placeholder="Nombre completo">
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">email</i>
				<input type="text" name="correo" placeholder="Correo otorgado por el plantel">
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">dialpad</i>
				<input type="password" name="pass" placeholder="Contraseña">
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">phone</i>
				<input type="text" name="telefono" placeholder="Teléfono de contacto">
			</div>
			<div class="input-field col s6">
				<i class="material-icons prefix">home</i>
				<input type="text" name="direccion" placeholder="Domicilio">
			</div>
			<div class="input-field col s6">
				<div class="file-field input-field">
      				<div class="btn">
        				<span><i class="material-icons">add_a_photo</i></span>
        				<input type="file" name="foto">
      				</div>	
      				<div class="file-path-wrapper">
        				<input class="file-path validate" type="text" placeholder="Sube tu foto">
      				</div>
    			</div>
			</div>
			<div class="input-field col s6">
				<button type="submit" name="registra_usuario" class="pink darken-3 btn waves-effect waves-light">Registrame<i class="material-icons right">sentiment_very_satisfied</i></button>

				<button type="reset" class="btn-flat waves-effect waves-light">Limpiar</button>
			</div>
		</form>
	</div>
</center>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
  });
</script>
</body>
</html>
<?php
if (isset($_POST['registra_usuario'])) {
	$grado_usuario = $_POST['grado'];
	$grupo_usuario = $_POST['grupo'];
	$especialidad_usuario = $_POST['especialidad'];
	$matricula_usuario = $_POST['matricula'];
	$nombre_usuario = $_POST['nombre'];
	$correo_usuario = $_POST['correo'];
	$pass_usuario = $_POST['pass'];
	$telefono_usuario = $_POST['telefono'];
	$domicilio_usuario = $_POST['direccion'];
	$foto_usuario = $_FILES['foto']['name'];
	$foto_usuario_tmp = $_FILES['foto']['tmp_name'];

	move_uploaded_file($foto_usuario_tmp,"imagenes/alumnos/$foto_usuario");

	$inserta_registro = "INSERT INTO usuarios(matricula,nombre,correo,pass,foto,grado,grupo,especialidad,telefono,direccion)VALUES('$matricula_usuario','$nombre_usuario','$correo_usuario','$pass_usuario','$foto_usuario','$grado_usuario','$grupo_usuario','$especialidad_usuario','$telefono_usuario','$domicilio_usuario')";

	$resultado = mysqli_query($conexion,$inserta_registro);

	if ($resultado) {
		$_SESSION['correo'] = $correo_usuario;
		header('Location: panel_usuario.php');
	}else{
		echo "Algo salió mal, intenta de nuevo o verifica tus datos.";
	}
}
?>
<?php 
ob_end_flush();
?>