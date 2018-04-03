<?php 

include('conexion.php');
//CST


$name=$_POST['nombre'];
$age=$_POST['edad'];
$username=$_POST['usuario'];
$email=$_POST['correo'];
$password=$_POST['pass'];
$number=$_POST['numero'];
$street=$_POST['calle'];
$city=$_POST['ciudad'];



$tildes = $con->query("SET NAMES 'utf8'");
$query="INSERT INTO users (id,name,age,username,email,password) VALUES(null,'$name','$age','$username','$email','$password')";

$cs=mysqli_query($con,$query);

if($cs){
    //si se registra con exito al paciente
    $sql="SELECT id FROM users WHERE email='$email' AND password='$password'";
    $rs=mysqli_query($con, $sql);
    //checar si existe el paciente
    if($row_cnt = mysqli_num_rows($rs)>0){
        while($fila=mysqli_fetch_array($rs)){
            $idusuario=$fila['id'];
        }
        $query2="INSERT INTO address (id,number, street,city,idUser) VALUES(null,'$number','$street','$city','$idusuario')";
        $rs1=mysqli_query($con, $query2);
    }
    //fin de insert diag
    echo "<script>alert('BASE DE DATOS ACTUALIZADA')</script>";
    echo "<script>location.href='mostrar.php'</script>";
}else{
    echo "Errormessage: %s\n", mysqli_error($con);
}




 ?>