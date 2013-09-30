<?php
	//nuevo comentarios
	//liberias
	require 'conexion/Conf.class.php';
	require 'conexion/DB.class.php';
	require 'libs/Usuario.php';
	require 'libs/Login.class.php';

	//instaciando la clase Db para la conexion a la base
	$db = Db::getInstance();

	//Instaciamos clases
	$Login = new Login();
	$Usuario = new Usuario();
	
	//verificar si esta logeado el usuario
	if (  $Login->getStatus() == true ) {
		//guardamos el Id del usuario en $_SESSION
		$Usuario->setId( $_SESSION["sid"] );
		//Pedimos una consulta de los datos del usuario
		$sql = $Usuario->datosUsuario();
		//ejecutamos la consulta
		$result = $db->ejecutar($sql);
		//obtenemos los datos del usuario
		$Usuarios = $db->obtener_fila($result);

	} else {
		// si no esta logueado direcciona
		header("Location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Index de login</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
	<header>
		<h1>Pruebas</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Inicio</a></li>
			<li><a href="#">Configuraciones</a></li>
			<li><a href="logout.php">Log out</a></li>
		</ul>
	</nav>
	<section id="intro">
		<header>
			<h2>¡Bienvenidos <?php echo $Usuarios[0]["nombre"]; ?> al panel de control!</h2>
		</header>
	
	</section>
	<aside>
	</aside>
	<footer>
	</footer>
</body>
</html>