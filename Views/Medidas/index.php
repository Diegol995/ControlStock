<?php include "Views/Templates/header.php";?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Medidas</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmMedidas();" title="Nueva Medida"><i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblMedidas">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Abreviación</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div class="modal fade" id="my_modal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="post" id="frmMedida">
                <div class="form-floating mb-3">
                    <input type="hidden" id="id" name="id">
                    <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    <label for="nombre">Nombre</label>
                </div>
                <div class="form-floating mb-3">
                    <input id="nombre_corto" class="form-control" type="text" name="nombre_corto" placeholder="Nombre Corto">
                    <label for="nombre_corto">Abreviación</label>
                </div>
                <button class="btn btn-primary mt-2" type="button" onclick="registrarMed(event);" id="btnAccion">Registrar</button>
                <button class="btn btn-danger mt-2" type="button" data-bs-dismiss="modal" onclick="btnCerrar();">Cancelar</button>
            </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>