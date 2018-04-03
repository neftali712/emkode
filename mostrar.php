<?php
include('conexion.php');
include('head.php');
?>

<body id="contenido">
<table class="table table-bordered" align="center">
    
    <thead>
      <tr>
          <th>Folio</th>
          <th>Nombre</th>
          <th>Usuario</th>
          <th>Ciudad</th>
          <th>Correo</th>
      </tr>
    </thead>
    <tbody id="cuerpo">
        <?php
        $tildes = $con->query("SET NAMES 'utf8'"); //Para que se inserten las tildes correctamente
        $sql="SELECT users.id,name, username, city, email from users INNER JOIN address WHERE users.id = address.idUser ";
        $cs=mysqli_query($con,$sql);
        if ($row_cnt = mysqli_num_rows($cs)>0){
             while($fila=mysqli_fetch_array($cs)){
                 echo
                     '
                     <tr data-id="'.$fila['id'].'">
                     <td>'.$fila['id'].'
                      </td>
                      <td>'.$fila['name'].'
                      </td>
                      <td>'.$fila['username'].'
                      </td>
                      <td>'.$fila['city'].'
                      </td>
                      <td>'.$fila['email'].'
                      </td>
                      <td>
                       <button class="btn btn-warning elimina">Eliminar</button>
                      </td>
                      <td>
                       <button class="btn btn-warning editar">Editar</button>
                      </td>
                    </tr>
                     ';
             }
        }
        
        ?>
    </tbody>
</table>
<button class=" btn btn-info back">Registrar Nuevo</button>
</body>
