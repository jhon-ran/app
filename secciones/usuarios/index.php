<!-- Importar conexión a BD-->
<?php include("../../bd.php"); 


//******Inicia código para eliminar registro******
//Para recolectar información del url con el botón "eliminar" método GET
if(isset($_GET['txtID'])){

    //Si esta variable existe, se asigna ese valor, de lo contrario se queda
    $txtID = (isset($_GET['txtID']))?$_GET['txtID']:$_GET['txtID'];
    //Se prepara sentencia para borrar dato seleccionado (id)
    $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id");
    //Asignar los valores que vienen del método GET (id seleccionado por params)
    $sentencia->bindParam(":id",$txtID);
    //Se ejecuta la sentencia con el valor asignado para borrar
    $sentencia->execute();
    //Redirecionar después de eliminar a la lista de puestos
    header("Location:index.php");
}
//******Termina código para eliminar registro******


//******Inicia código para mostrar todos los registros******
//Se prepara sentencia para seleccionar todos los datos 
$sentencia = $conexion->prepare("SELECT * FROM tbl_usuarios");
$sentencia->execute();
$lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//Para probar que se esté leyendo todos los datos de la tabla, descomentar
//print_r($lista_tbl_usuarios);
//******Termina código para mostrar todos los registros******

?>
<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/header.php"); ?>

<br/>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button" >Agregar usuarios</a>
    </div>
    <div class="card-body">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre del usuario</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach($lista_tbl_usuarios as $registro){ ?>

                <tr class="">
                    <td scope="row"><?php echo $registro['id']?></td>
                    <td><?php echo $registro['usuario']?></td>
                    <td>******</td>
                    <td><?php echo $registro['correo']?></td>
                    <td>
                        <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']?>" role="button">Editar</a>
                            | 
                        <!--Envia el id através de la url-->
                        <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']?>" role="button">Eliminar</a>
                     </td>
                </tr>

            <?php }?>

            </tbody>
        </table>
    </div>
    </div>

<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/footer.php"); ?>