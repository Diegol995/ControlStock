<?php include "Views/Templates/header.php";?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Productos</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmProducto();" title="Nuevo Producto"><i class="fas fa-plus"></i></button>
<div class="table-resposive">
    <table class="table table-light" id="tblProductos">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Imagen</th>
                <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="my_modal" tabindex="-1" aria-labelledby="Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="frmProducto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="hidden" id="id" name="id">
                                <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código de Barras">
                                <label for="codigo">Código de Barras</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Nombre del Producto">
                                <label for="nombre">Descripción</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="precio_compra" class="form-control" type="text" name="precio_compra" placeholder="Precio Compras">
                                <label for="precio_compra">Precio Compra</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input id="precio_venta" class="form-control" type="text" name="precio_venta" placeholder="Precio Venta">
                                <label for="precio_venta">Precio Venta</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select id="medida" class="form-control" name="medida">
                                    <?php foreach ($data['medidas'] as $row) {  ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="medida">Medida</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <select id="categoria" class="form-control" name="categoria">
                                    <?php foreach ($data['categorias'] as $row) {  ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                                    <?php } ?>
                                </select>
                                <label for="categoria">Categoría</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Imagen</label>
                                <div class="card border-primary">
                                    <div class="card-body">
                                        <label for="imagen" id="img-icon" class="btn btn-primary"><i class="fas fa-image"></i></label>
                                        <span id="icon-cerrar"></span>
                                        <input id="imagen" class="d-none" type="file" name="imagen" onchange="preview(event);">
                                        <input type="hidden" id="img_actual" name="img_actual">
                                        <img class="img-thumbnail" id="img-preview">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mt-2" type="button" onclick="registrarProd(event);" id="btnAccion">Registrar</button>
                    <button class="btn btn-danger mt-2" type="button" data-bs-dismiss="modal" onclick="btnCerrar();">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>