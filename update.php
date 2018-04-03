<?php 
  include('conexion.php');
  
    $name=$_POST['nombre'];
    $age=$_POST['edad'];
    $username=$_POST['usuario'];
    $email=$_POST['correo'];
    $password=$_POST['pass'];
    $number=$_POST['numero'];
    $street=$_POST['calle'];
    $city=$_POST['ciudad'];
    $id=$_POST['id'];

  $tildes = $con->query("SET NAMES 'utf8'");
  $query2="UPDATE users SET name='$name',age='$age',username='$username',email='$email',password='$password' where id='$id'";

  $query3=" update address set number='$number',street='$street',city='$city' where idUser=$id";

  $cs=mysqli_query($con,$query2);
  

  if($cs){
      $cs=mysqli_query($con,$query3);
      if($cs){
          echo "<script>location.href='mostrar.php'</script>";
      }else{
          echo "Errormessage: %s\n", mysqli_error($con);
      }
      
  }else{
      echo "Errormessage: %s\n", mysqli_error($con);
  }
 ?>