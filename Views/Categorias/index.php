<?php include "Views/Templates/header.php";?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Categorías</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmCategorias();" title="Nueva Categoría"><i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblCategorias">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="nueva_categoria" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nueva Categoria</h5>
                <button class="close bg-primary border border-primary h4" data-dismiss="modal" aria-label="Close" id="btnCerrar" onclick="btnCerrar();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCategoria">
                    <div class="form-group m-2">
                        <label for="nombre">Nombre</label>
                        <input type="hidden" id="id" name="id">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre">
                    </div>
                    <button class="btn btn-primary mt-2" type="button" onclick="registrarCat(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger mt-2" type="button" data-dismiss="modal" onclick="btnCerrar();">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>