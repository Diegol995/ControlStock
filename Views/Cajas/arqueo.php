<?php include "Views/Templates/header.php";?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Arqueo de Caja</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="arqueoCaja();" title="Nueva Caja"><i class="fas fa-plus"></i></button>
<button class="btn btn-warning mb-2 <?php echo $data; ?>" type="button" onclick="cerrarCaja();" id="btnCerrarCaja" title="Cerrar Caja">Cerrar caja</button>
<table class="table table-light" id="t_arqueo">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Monto inicial</th>
            <th>Monto final</th>
            <th>Fecha de apertura</th>
            <th>Fecha de cierre</th>
            <th>Ventas totales</th>
            <th>Monto total</th>
            <th>Estado</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<div id="abrir_caja" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="title">Arqueo Caja</h5>
                <button class="close bg-primary border border-primary h4" data-dismiss="modal" aria-label="Close" id="btnCerrar" onclick="btnCerrar();">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmAbrirCaja" onsubmit="abrirArqueo(event);">
                    <div class="form-group m-2">
                        <input type="hidden" id="id" name="id">
                        <label for="monto_inicial">Monto Inicial</label>
                        <input autocomplete="off" id="monto_inicial" class="form-control" type="text" name="monto_inicial" placeholder="Monto inicial" required>
                    </div>
                    <div id="ocultar_campos">
                        <div class="form-group">
                            <label for="monto_final">Monto Final</label>
                            <input id="monto_final" class="form-control" type="text" disabled>
                        </div>
                        <div class="form-group">
                            <label for="total_ventas">Total Ventas</label>
                            <input id="total_ventas" class="form-control" type="text" disabled>
                        </div>
                        <div class="form-group">
                            <label for="monto_general">Monto Total</label>
                            <input id="monto_general" class="form-control" type="text" disabled>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-2" type="submit"  id="btnAccion">Abrir</button>
                    <button class="btn btn-danger mt-2" type="button" data-dismiss="modal" onclick="btnCerrar();">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>