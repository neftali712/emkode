<?php 
include('conexion.php');
include ('head.php');
	extract($_POST);
	mysqli_select_db($con,$db);
	//$pass = base64_encode($pass);
    $tildes = $con->query("SET NAMES 'utf8'"); //Para que se inserten las tildes correctamente
	$sql="DELETE FROM users WHERE id='$id'";
	//$sql="SELECT id,nombre FROM users ";
	$cs=mysqli_query($con,$sql);

	if ($cs) {
		echo "<script>location.href='mostrar.php'</script>";
	}else {
		echo "Errormessage: %s\n", mysqli_error($con);
	}

 ?>