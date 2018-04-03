<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php
    include('head.php');
    ?>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
  
   <form action="registrar.php" method="post" class="form-control">
       <input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre" required >
       <br>
       <input class="form-control" type="text" name="edad" id="edad" placeholder="Edad">
       <br>
       <input class="form-control" type="text" name="usuario" id="usuario" placeholder="Nombre de Usuario" required>
       <br>
       <input class="form-control" type="email" name="correo" id="correo" placeholder="E-mail" required>
       <br>
       <input class="form-control" type="password" name="pass" id="pass" placeholder="*******" required>
       <br>
       <input class="form-control" type="text" name="numero" id="numero" placeholder="Numero de Calle" required>
       <br>
       <input class="form-control" type="text" name="calle" id="calle" placeholder="Calle" required>
       <br>
       <input class="form-control" type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required>
       <br>
       <button type="submit" class="btn btn-primary">Enviar</button>
       <button class="btn btn-info mostrar">Ver Todo</button>
   </form>
   
    
</body>
</html>