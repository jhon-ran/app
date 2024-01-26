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
        

        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>


<!-- ../../ sube 2 niveles para poder acceder al folder de templates-->
<?php include("../../templates/footer.php"); ?>