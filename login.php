<?php
	
	//librerias
	require 'conexion/Conf.class.php';
	require 'conexion/DB.class.php';
	require 'libs/Usuario.php';
	require 'libs/Login.class.php';

	//instaciando la clase Db para la conexion a la base
	$db = Db::getInstance();
	//condicional - si existen datos por medio $_POST se hace
	if ($_POST) {
		
		//obtenemos datos especificos y eliminamos codigo de un posible inyeccion de SQL
		$nombre = mysql_real_escape_string( $_POST["nombre"] );
		$pass = mysql_real_escape_string( $_POST["pass"] );

		//Instaciamos clases
		$Usuario = new Usuario($nombre, $pass);
		$Login = new Login( $nombre, $pass );

		//se llama al metodo selectUsuario que devuelve un Consulta
		$sql = $Usuario->selectUsuario();
		//se ejecuta la consulta
		$result = $db->ejecutar($sql);
		//se obtiene datos del usuario
		$rowUsuario = $db->obtener_fila($result);
		//se verifica si el usuario realmente existe
		$login = $Login->verificarUsuario( $rowUsuario );

		//condiciona - si existe el usuario
		if ($login) {
			//direccionar
			header( "Location: index.php" );
		} else {
			//direccionar
			header( "Location: login.php?error=1" );
		}
		

	} else {
		//no hacer nada
	}
	
?>
<!doctype html>
<html lang="es">
<head>
	<title>Login</title>

	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta charset="UTF-8" />
</head>
<body>
	<section id="login">
		<header>
			<h2>Login</h2>
		</header>
		<form method="post" action="login.php">
			<?php
				if ($_GET["error"] == 1) {
					?>
					<p>Error</p>
					<?php
				}
			?>
			<dl>
				<dt><label for="nombre">Nombre:</label></dt>
				<dd><input type="text" name="nombre" value=""></dd><br>
				<dt><label for="pass">Password:</label></dt>
				<dd><input type="password" name="pass" value=""></dd><br>
			</dl>
			<input type="submit" value="Login">
		</form>
	</section>
</body>
</html>