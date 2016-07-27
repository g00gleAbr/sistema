<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card-panel">
	<span class="blue-text text-darken-2"><i class="material-icons left">settings</i>Modifica tu los datos de tu cuenta</span>
</div>
<?php 
$usuario = $_SESSION['correo'];
$select = "SELECT * FROM usuarios WHERE correo = '$usuario'";
$query_select = mysqli_query($conexion,$select);
while ($row_edita = mysqli_fetch_array($query_select)) {
	$matricula = $row_edita['matricula'];
	$nombre = $row_edita['nombre'];
	$correo = $row_edita['correo'];
	$grado = $row_edita['grado'];
	$grupo = $row_edita['grupo'];
	$especialidad = $row_edita['especialidad'];
	$telefono = $row_edita['telefono'];
	$direccion = $row_edita['direccion'];

	$select_grupo = "SELECT * FROM grupo WHERE id = '$grupo'";
	$query_grupo = mysqli_query($conexion,$select_grupo);
	$row_grupo = mysqli_fetch_array($query_grupo);
	$id_grupo = $row_grupo['id'];
	$nombre_grupo = $row_grupo['grupo'];

	$select_especialidad = "SELECT * FROM especialidad WHERE id = '$especialidad'";
	$query_esp = mysqli_query($conexion,$select_especialidad);
	$row_esp = mysqli_fetch_array($query_esp);
	$id_esp = $row_esp['id'];
	$nombre_esp = $row_esp['nombre'];
}
?>
<div class="row" style="padding-left:20x;">
	<form action="" method="post" enctype="multipart/form-data">
		<div class="input-field col s5">
			<select name="grado">
					<option value="<?php echo $grado; ?>"><?php echo $grado; ?></option>	
					<?php 
					$grado = "SELECT * FROM grado";
					$query_grado = mysqli_query($conexion,$grado);
					while ($row_grado = mysqli_fetch_array($query_grado)) {
						$id_grad = $row_grado['id'];
						$nombre_grad = $row_grado['nombre'];
						echo "
						<option value = '$id_grad'>$nombre_grad</option>
						";
					}
					?>
				</select>
			</div>
			<div class="input-field col s5">
				<select name="grupo">
					<option value="<?php echo $id_grupo; ?>"><?php echo $nombre_grupo; ?></option>	
					<?php 
					$grupo = "SELECT * FROM grupo";
					$query_grupo = mysqli_query($conexion,$grupo);
					while ($row = mysqli_fetch_array($query_grupo)) {
						$id_grup = $row['id'];
						$nombre_grup = $row['grupo'];
						echo "
						<option value='$id_grup'>$nombre_grup</option>
						";
					}
					?>
				</select>
			</div>
			<div class="input-field col s5">
				<select name="especialidad">
					<option value="<?php echo $id_esp; ?>"><?php echo $nombre_esp; ?></option>
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
			<div class="input-field col s5">
				<i class="material-icons prefix">credit_card</i>
				<input type="text" name="matricula" placeholder="Matrícula de alumno" value="<?php echo $matricula; ?>">
			</div>
			<div class="input-field col s5">
				<i class="material-icons prefix">face</i>
				<input type="text" name="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
			</div>
			<div class="input-field col s5">
				<i class="material-icons prefix">email</i>
				<input type="text" name="correo" placeholder="Correo otorgado por el plantel" value="<?php echo $correo; ?>">
			</div>
			<div class="input-field col s5">
				<i class="material-icons prefix">phone</i>
				<input type="text" name="telefono" placeholder="Teléfono de contacto" value="<?php echo $telefono; ?>">
			</div>
			<div class="input-field col s5">
				<i class="material-icons prefix">home</i>
				<input type="text" name="direccion" placeholder="Domicilio" value="<?php echo $direccion; ?>">
			</div>
			<div class="input-field col s5">
				<div class="file-field input-field">
      				<div class="btn">
        				<span><i class="material-icons">add_a_photo</i></span>
        				<input type="file" name="foto" value="<?php echo $foto; ?>">
      				</div>	
      				<div class="file-path-wrapper">
        				<input class="file-path validate" type="text" placeholder="Para confirmar, sube tu foto de nuevo">
      				</div>
    			</div>
			</div>
			<div class="input-field col s8">
				<button type="submit" name="actualizar" class="blue-grey lighten-1 btn waves-effect waves-light">Actualizar</button>

				<button type="reset"  name="cancelar" class="btn-flat waves-effect waves-light">Cancelar</button>
			</div>
		</form>
	</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('select').material_select();
  });
</script>
</body>
</html>
<?php 
if (isset($_POST['actualizar'])) {
	$matricula_nuevo = $_POST['matricula'];
	$nombre_nuevo = $_POST['nombre'];
	$correo_nuevo = $_POST['correo'];
	$telefono_nuevo = $_POST['telefono'];
	$direccion_nuevo = $_POST['direccion'];
	$grado_nuevo = $_POST['grado'];
	$especialidad_nuevo = $_POST['especialidad'];
	$grupo_nuevo = $_POST['grupo'];
	$foto_nuevo = $_FILES['foto']['name'];
	$foto_nuevo_tmp = $_FILES['foto']['tmp_name'];

	move_uploaded_file($foto_nuevo_tmp,"imagenes/alumnos/$foto_nuevo");

	$actualiza_alumno = "UPDATE usuarios SET matricula = '$matricula_nuevo', nombre = '$nombre_nuevo', correo = '$correo_nuevo', foto = '$foto_nuevo', grado = '$grado_nuevo', grupo = '$grupo_nuevo', especialidad = '$especialidad_nuevo', telefono = '$telefono_nuevo', direccion = '$direccion_nuevo' WHERE correo = '$usuario'";
	$query_actualiza = mysqli_query($conexion,$actualiza_alumno);
	if ($query_actualiza) {
		header('Location: panel_usuario.php?cuenta_usuario');
	}else{
		echo "Hubo un error, verifica o intenta de nuevo.";
	}
}elseif (isset($_GET['cancelar'])) {
	header('Location: panel_usuario.php?cuenta_usuario');
}
?>