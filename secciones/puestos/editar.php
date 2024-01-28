<?php 
include("../../bd.php"); 

//******Inicia código para recibir registro******
//Para verificar que se envía un id
if(isset($_GET['txtID'])){
    //Si esta variable existe, se asigna ese valor, de lo contrario se queda
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:$_GET['txtID'];
    //Se prepara sentencia para editar dato seleccionado (id)
    $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
    //Asignar los valores que vienen del método GET (id seleccionado por params)
    $sentencia->bindParam(":id",$txtID);
    //Se ejecuta la sentencia con el valor asignado para borrar
    $sentencia->execute();
    //Popular el formulario con los valores de 1 registro
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $nombredelpuesto = $registro["nombredelpuesto"];
}
//******Termina código para recibir registro******


//******Inicia código para modificar registro******
if($_POST){
    //Descomentar esta línea para comprobar que se reciben datos
    //print_r($_POST);

    $txtID = (isset($_POST['txtID']))?$_POST['txtID']:"";
    //Validación: que exista la información enviada, lo vamos a igualar a ese valor,
    //de lo contratrio lo deja en blanco
    $nombredelpuesto = (isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
    //Preparar modificar el registro enviados por POST
    $sentencia = $conexion->prepare("UPDATE tbl_puestos SET nombredelpuesto=:nombredelpuesto WHERE id=:id");
    //Asignar los valores que vienen del formulario (POST)
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    $sentencia->bindParam(":id",$txtID);
    //Se ejecuta la sentencia con los valores de param asignados
    $sentencia->execute();
    header("Location:index.php");
}
//******Termina código para recibir registro******

?>

<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/header.php"); ?>

<br/>

<div class="card">
    <div class="card-header">Puestos</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">

            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text"
                    value = "<?php echo $txtID;?>"
                    class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID"/>
            </div>
            
            <div class="mb-3">
                <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
                <input type="text" 
                value = "<?php echo $nombredelpuesto;?>"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto"/>
            </div>

            <button type="submit" class="btn btn-success">Editar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>

<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/footer.php"); ?>