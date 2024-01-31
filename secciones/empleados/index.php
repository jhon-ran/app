<!-- Importar conexión a BD-->
<?php include("../../bd.php");

//******Inicia código para mostrar todos los registros******
/*Se prepara sentencia para seleccionar todos los datos 
En la sentencia se hace una subconsulta porque el idpuesto es índice & está ligado a la tabla puesto
el resultado de la subconsulta se guarda como el alias "puesto" y este es el que llama en la tabla
*/
$sentencia = $conexion->prepare("SELECT *,

(SELECT nombredelpuesto 
FROM tbl_puestos 
WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto

FROM tbl_empleados");

$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//Para probar que se esté leyendo todos los datos de la tabla, descomentar
//print_r($lista_tbl_puestos);
//******Termina código para mostrar todos los registros******
?>

?>

<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/header.php"); ?>

<br/>

<div class="card">
    <div class="card-header">
        
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button" >Agregar registro</a>
        
    </div>
    <div class="card-body">
    
     <div
        class="table-responsive-sm"
     >
        <table
            class="table"
        >
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Foto</th>
                    <th scope="col">CV</th>
                    <th scope="col">Puesto</th>
                    <th scope="col">Fecha de ingreso</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

            <?php foreach($lista_tbl_empleados as $registro){ ?>

                <tr class="">
                    <td><?php echo $registro['id']?></td>
                    <td scope="row"><?php echo $registro['primernombre']?>
                    <?php echo $registro['segundonombre']?>
                    <?php echo $registro['primerapellido']?>
                    <?php echo $registro['segundoapellido']?>
                    </td>
                    <td><?php echo $registro['foto']?></td>
                    <td><?php echo $registro['cv']?></td>
                    <td><?php echo $registro['puesto']?></td>
                    <td><?php echo $registro['fechadeingreso']?></td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="#" role="button">Carta</a>
                        |<a name="" id="" class="btn btn-info" href="#" role="button">Editar</a>
                        |<a name="" id="" class="btn btn-danger" href="#" role="button">Eliminar</a>
                    </td>
                </tr>
            <?php }?>

            </tbody>
        </table>
     </div>
     

    </div>
    
</div>


<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/footer.php"); ?>