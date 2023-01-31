<?php include "Views/Templates/header.php";?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Clientes</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmCliente();" title="Nuevo Cliente"><i class="fas fa-plus"></i></button>
<table class="table table-light" id="tblClientes">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Cuit/Cuil</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Estado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="nuevo_cliente" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Nuevo Cliente</h5>
                <button class="close bg-primary border border-primary h4" data-dismiss="modal" aria-label="Close" id="btnCerrar" onclick="btnCerrar();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmCliente">
                    <div class="form-group m-2">
                        <label for="cuit_cuil">Cuit/Cuil</label>
                        <input type="hidden" id="id" name="id">
                        <input id="cuit_cuil" class="form-control" type="text" name="cuit_cuil" placeholder="Cuit/Cuil">
                    </div>
                    <div class="form-group m-2">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del cliente">
                    </div>
                    <div class="form-group m-2">
                        <label for="telefono">Teléfono</label>
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono">
                    </div>
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <textarea id="direccion" class="form-control" name="direccion" placeholder="Dirección" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary mt-2" type="button" onclick="registrarCli(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger mt-2" type="button" data-dismiss="modal" onclick="btnCerrar();">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>