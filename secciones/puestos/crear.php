<!-- Importar conexión a BD-->
<?php include("../../bd.php"); 

if($_POST){
    print_r($_POST);

    //Validación: que exista la información enviada, lo vamos a igualar a ese valor,
    //de lo contratrio lo deja en blanco
    $nombredelpuesto = (isset($_POST["nombredelpuesto"])? $_POST["nombredelpuesto"]:"");
    //Preparar la inseción de los datos enviados por POST
    $sentencia = $conexion->prepare("INSERT INTO tbl_puestos(id,nombredelpuesto) VALUES (null, :nombredelpuesto)" );
    //Asignar los valores que vienen del formulario (POST)
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
    //Se ejecuta la sentencia con los valores de param asignados
    $sentencia->execute();
    //Redirecionar a la lista de puestos
    header("Location:index.php");
}
?>

<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/header.php"); ?>

<br/>

<div class="card">
    <div class="card-header">Puestos</div>
    <div class="card-body">

        <form action="" method="post" enctype="multipart/form-data">
            
            <div class="mb-3">
                <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
                <input
                    type="text"
                    class="form-control"
                    name="nombredelpuesto"
                    id="nombredelpuesto"
                    aria-describedby="helpId"
                    placeholder="Nombre del puesto"
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