<?php
include('conexion.php');
include ('head.php');
extract($_POST);
	mysqli_select_db($con,$db);
    $tildes = $con->query("SET NAMES 'utf8'"); 
	$sql="select * FROM users inner join address WHERE idUser='$id' and users.id='$id'";
	$cs=mysqli_query($con,$sql);
	if ($row_cnt = mysqli_num_rows($cs)>0){
             while($fila=mysqli_fetch_array($cs)){
                 echo
                     '
                     <form action="update.php" method="post">
                     <input type="text" name="id" id="id" " value="'.$id.'" hidden>
                              <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" value="'.$fila['name'].'" required>
                               <br>
                               <input class="form-control" type="text" name="edad" id="edad" placeholder="Edad" value="'.$fila['age'].'">
                               <br>
                               <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Nombre de Usuario" required value="'.$fila['username'].'">
                               <br>
                               <input class="form-control" type="email" name="correo" id="correo" placeholder="E-mail" required value="'.$fila['email'].'">
                               <br>
                               <input class="form-control" type="password" name="pass" id="pass" placeholder="*******" required value="'.$fila['password'].'">
                               <br>
                               <input class="form-control" type="text" name="numero" id="numero" placeholder="Numero de Calle" required value="'.$fila['number'].'">
                               <br>
                               <input class="form-control" type="text" name="calle" id="calle" placeholder="Calle" required value="'.$fila['street'].'">
                               <br>
                               <input class="form-control" type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required value="'.$fila['city'].'">
                               <br>
                              
                               <button type="submit" class="btn btn-primary">Enviar</button>
                               <button class="btn btn-info mostrar">Regresar</button>
                     </form>

                     ';
             }
        }
        else {
		echo "Errormessage: %s\n", mysqli_error($con);
	}
?>