<!-- Importar conexión a BD-->
<?php include("../../bd.php");

if($_POST){
    //Descomentar la línea de abajo si se quiere verificar que los datos por POST están llegando
    //print_r($_POST);

     //Recolecta datos de método POST: Validación: que exista la información enviada, lo vamos a igualar a ese valor,
    //de lo contratrio lo deja en blanco
    $usuario = (isset($_POST["usuario"])? $_POST["usuario"]:"");
    $password = (isset($_POST["password"])? $_POST["password"]:"");
    $correo = (isset($_POST["correo"])? $_POST["correo"]:"");
     //Preparar la inseción de los datos enviados por POST
     $sentencia = $conexion->prepare("INSERT INTO tbl_usuarios (id,usuario,password,correo) VALUES (NULL,:usuario,:password,:correo)");
     //Asignar los valores que vienen del formulario (POST)
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->execute();
    //Redirecionar a la lista de puestos
    header("Location:index.php");
}

?> 


<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/header.php"); ?>

<br/>

<div class="card">
    <div class="card-header">Datos del usuario</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input
                    type="text"
                    class="form-control"
                    name="usuario"
                    id="usuario"
                    aria-describedby="helpId"
                    placeholder="Nombre del usuario"
                />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    name="password"
                    id="password"
                    aria-describedby="helpId"
                    placeholder="Escriba contraseña"
                />
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input
                    type="email"
                    class="form-control"
                    name="correo"
                    id="correo"
                    aria-describedby="helpId"
                    placeholder="Escriba su correo"
                />
            </div>
            
            

            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            
            

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/footer.php"); ?>