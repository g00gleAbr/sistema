<!DOCTYPE html>
<html>
<head>
</head>
<body>
<div class="card-panel">
	<span class="blue-text text-darken-2"><i class="material-icons left">feedback</i>Publicar un anuncio</span>
</div>
<form action="" method="post">
	<div class="row container">
		<div class="input-field col s7">
			<i class="material-icons prefix">title</i>
			<input type="text" name="titulo" id="title" required>
			<label for="title">Titulo del anuncio</label>
		</div>
		<div class="input-field col s7">
			<i class="material-icons prefix">description</i>
			<textarea name="descripcion" class="materialize-textarea" id="desc" length="255" required></textarea>
			<label for="desc">Descripción del anuncio</label>
		</div>
		<div class="input-fiel col s7">
			<i class="material-icons prefix">date_range</i>
			<input type="date" name="fecha" id="fec">
			<label for="fec">Fecha a realizar el evento</label>
		</div>
		<div class="input-field col s7">
			<button name="subir" type="submit" class="btn waves-effect waves-light">Subir</button>
			<button name="limpiar" type="reset" class="btn-flat waves-effect waves-light">Limpiar</button>
		</div>
	</div>
</form>
<script type="text/javascript">
  $('.datepicker').pickadate({
    selectMonths: true,
    selectYears: 15
  });
</script>
</body>
</html>
<?php 
if (isset($_POST['subir'])) {
	$titulo = $_POST['titulo'];
	$descripcion = $_POST['descripcion'];
	$fecha = $_POST['fecha'];
	$insertar = "INSERT INTO noticias(titulo,descripcion,fecha)VALUES('$titulo','$descripcion','$fecha')";
	$query = mysqli_query($conexion,$insertar);
	if ($query) {
		header('Location: ver_anuncios.php');
	}else{
		echo "Hubo un error, verifica o intenta de nuevo";
	}
}
?>