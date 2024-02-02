<!-- Importar conexión a BD-->
<?php include("../../bd.php"); 

if($_POST){
    //Descomentar las dos líneas de print si se quieren verificar que los datos pasen bien por POST
    //print_r($_POST);
    //Para mostrar los archivos adjuntos: fotos y pdf
    //print_r($_FILES);

    //******Inicia código para insertar registro******
    //Validación: que exista la información enviada, lo vamos a igualar a ese valor,
    //de lo contratrio lo deja en blanco
    $primernombre = (isset($_POST["primernombre"])? $_POST["primernombre"]:"");
    $segundonombre = (isset($_POST["segundonombre"])? $_POST["segundonombre"]:"");
    $primerapellido = (isset($_POST["primerapellido"])? $_POST["primerapellido"]:"");
    $segundoapellido = (isset($_POST["segundoapellido"])? $_POST["segundoapellido"]:"");
    //Para las fotos y pdfs hay que darle el parametro 'name'
    $foto = (isset($_FILES["foto"]['name'])? $_FILES["foto"]['name']:"");
    $cv = (isset($_FILES["cv"]['name'])? $_FILES["cv"]['name']:"");

    $idpuesto = (isset($_POST["idpuesto"])? $_POST["idpuesto"]:"");
    $fechadeingreso = (isset($_POST["fechadeingreso"])? $_POST["fechadeingreso"]:"");

    //Preparar la inseción de los datos enviados por POST
    $sentencia = $conexion->prepare("INSERT INTO `tbl_empleados` (`id`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `foto`, `cv`, `idpuesto`, `fechadeingreso`) 
    VALUES (NULL,:primernombre,:segundonombre,:primerapellido,:segundoapellido,:foto,:cv,:idpuesto,:fechadeingreso);" );
    //Asignar los valores que vienen del formulario (POST)
    $sentencia->bindParam(":primernombre",$primernombre);
    $sentencia->bindParam(":segundonombre",$segundonombre);
    $sentencia->bindParam(":primerapellido",$primerapellido);
    $sentencia->bindParam(":segundoapellido",$segundoapellido);

    //******Inicia código para adjuntar foto******
    //Obtenemos tiempo
    $fecha_ = new DateTime();
    //Crear nuevo nombre de archivo: Si $foto tiene un valor,se crea el nombre con time stamp y el valor de nombre de foto, si no queda vacio
    $nombreArchivo_foto = ($foto!='')?$fecha_->getTimestamp()."_".$_FILES["foto"]['name']:"";
    //Variable temp para guardar nombre de foto
    $tmp_foto = $_FILES["foto"]['tmp_name'];
    //Si el archivo tmp no está vacio
    if($tmp_foto!=''){
        //Movemos el archivo en direccion predeterminada
        move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
    }
    //Se actualiza en BD el nombre de archivo
    $sentencia->bindParam(":foto",$nombreArchivo_foto);
    //******Termina código para adjuntar foto******

    //******Inicia código para adjuntar pdf******
    $nombreArchivo_cv = ($cv!='')?$fecha_->getTimestamp()."_".$_FILES["cv"]['name']:"";
    //Variable temp para guardar nombre de foto
    $tmp_cv = $_FILES["cv"]['tmp_name'];
    //Si el archivo tmp no está vacio
    if($tmp_cv!=''){
        //Movemos el archivo en direccion predeterminada
        move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
    }

    $sentencia->bindParam(":cv",$nombreArchivo_cv);
    //******Termina código para adjuntar foto******

    $sentencia->bindParam(":idpuesto",$idpuesto);
    $sentencia->bindParam(":fechadeingreso",$fechadeingreso);
    //Se ejecuta la sentencia con los valores de param asignados
    $sentencia->execute();
    //Redirecionar a la lista de empleados después de insertar registro
    header("Location:index.php");

    //******Termina código para insertar registro******

}

//******Inicia código para mostrar todos los puestos******
//Se prepara sentencia para seleccionar todos los puestos de la tbl_puestos
$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
//Para probar que se esté leyendo todos los datos de la tabla, descomentar
//print_r($lista_tbl_puestos);
//******Termina código para mostrar todos los puestos******
?>

<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/header.php"); ?>
<br/>
<div class="card">
    <div class="card-header">Datos del empleado</div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="primernombre" class="form-label">Primer nombre</label>
            <input
                type="text"
                class="form-control"
                name="primernombre"
                id="primernombre"
                aria-describedby="helpId"
                placeholder="Primer nombre"
            />
        </div>

        <div class="mb-3">
            <label for="segundonombre" class="form-label">Segundo nombre</label>
            <input
                type="text"
                class="form-control"
                name="segundonombre"
                id="segundonombre"
                aria-describedby="helpId"
                placeholder="Segundo nombre"
            />
        </div>

        <div class="mb-3">
            <label for="primerapellido" class="form-label">Primer apellido </label>
            <input
                type="text"
                class="form-control"
                name="primerapellido"
                id="primerapellido"
                aria-describedby="helpId"
                placeholder="Primer apellido"
            />
        </div>

        <div class="mb-3">
            <label for="segundoapellido" class="form-label">Segundo apellido </label>
            <input
                type="text"
                class="form-control"
                name="segundoapellido"
                id="segundoapellido"
                aria-describedby="helpId"
                placeholder="Segundo apellido"
            />
        </div>

        <div class="mb-3">
            <label for="foto" class="form-label">Foto:</label>
            <input
                type="file"
                class="form-control"
                name="foto"
                id="foto"
                aria-describedby="helpId"
                placeholder="Foto"
            />
        </div>
        
        <div class="mb-3">
            <label for="cv" class="form-label">CV(PDF):</label>
            <input
                type="file"
                class="form-control"
                name="cv"
                id="cv"
                placeholder="CV"
                aria-describedby="fileHelpId"
            />
        </div>
        
        <div class="mb-3">
            <label for="idpuesto" class="form-label">Puesto:</label>

            <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                <?php foreach($lista_tbl_puestos as $registro){ ?>
                    <option value="<?php echo $registro['id']?>">
                    <?php echo $registro['nombredelpuesto']?></option>
                <?php }?>

            </select>
        </div>
        
        <div class="mb-3">
            <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
            <input
                type="date"
                class="form-control"
                name="fechadeingreso"
                id="fechadeingreso"
                aria-describedby="emailHelpId"
                placeholder="Fecha de ingreso"
            />
        </div>
        
        <button type="submit" class="btn btn-success">Agregar registro</button>
        <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
    
        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/footer.php"); ?>