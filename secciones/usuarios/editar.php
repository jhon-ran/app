<?php 
include("../../bd.php"); 

//******Inicia código para recibir registro******
//Para verificar que se envía un id
if(isset($_GET['txtID'])){
    //Si esta variable existe, se asigna ese valor, de lo contrario se queda
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:$_GET['txtID'];
    //Se prepara sentencia para editar dato seleccionado (id)
    $sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    //Asignar los valores que vienen del método GET (id seleccionado por params)
    $sentencia->bindParam(":id",$txtID);
    //Se ejecuta la sentencia con el valor asignado para borrar
    $sentencia->execute();
    //Popular el formulario con los valores de 1 registro
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $usuario = $registro["usuario"];
    $password = $registro["password"];
    $correo = $registro["correo"];

}
//******Termina código para recibir registro******

//******Empieza código para modificar registro******
if($_POST){
    //Descomentar la línea de abajo si se quiere verificar que los datos por POST están llegando
    //print_r($_POST);

     //Recolecta datos de método POST: Validación: que exista la información enviada, lo vamos a igualar a ese valor,
    //de lo contratrio lo deja en blanco
    $txtID = (isset($_POST["txtID"])? $_POST["txtID"]:"");
    $usuario = (isset($_POST["usuario"])? $_POST["usuario"]:"");
    $password = (isset($_POST["password"])? $_POST["password"]:"");
    $correo = (isset($_POST["correo"])? $_POST["correo"]:"");
     //Preparar la inseción de los datos enviados por POST
     $sentencia = $conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario,
        password=:password,correo=:correo WHERE id=:id");
     //Asignar los valores que vienen del formulario (POST)
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    //Redirecionar a la lista de puestos
    header("Location:index.php");
}
//******Empieza código para modificar registro******
?> 


<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/header.php"); ?>

<br/>
<div class="card">
    <div class="card-header">Datos del usuario</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                    <label for="txtID" class="form-label">ID:</label>
                    <input type="text"
                        value = "<?php echo $txtID;?>"
                        class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID"/>
            </div>
                
            <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input
                    type="text"
                    value = "<?php echo $usuario;?>"
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
                    value = "<?php echo $password;?>"
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
                    value = "<?php echo $correo;?>"
                    class="form-control"
                    name="correo"
                    id="correo"
                    aria-describedby="helpId"
                    placeholder="Escriba su correo"
                />
            </div>
            
            <button type="submit" class="btn btn-success">Editar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            
        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/footer.php"); ?>