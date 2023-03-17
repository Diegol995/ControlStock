<?php include "Views/Templates/header.php";?>
<div class="card">
    <div class="card-header bg-dark text-white">
        Datos de la empresa
    </div>
    <div class="card-body">
        <form id="frmEmpresa">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="id" class="form-control" type="hidden" name="id" value="<?php echo $data['id'] ?>">
                        <input id="nombre" class="form-control" type="text" name="nombre" placeholder="Razón Social" value="<?php echo $data['nombre'] ?>">
                        <label for="nombre">Razón Social</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="cuit_cuil" class="form-control" type="text" name="cuit_cuil" placeholder="Cuit/Cuil" value="<?php echo $data['cuit_cuil'] ?>">
                        <label for="cuit_cuil">Cuit/Cuil</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="telefono" class="form-control" type="text" name="telefono" placeholder="Teléfono" value="<?php echo $data['telefono'] ?>">
                        <label for="telefono">Teléfono</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input id="direccion" class="form-control" type="text" name="direccion" placeholder="Dirección" value="<?php echo $data['direccion'] ?>">
                        <label for="direccion">Dirección</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <textarea id="mensaje" class="form-control" name="mensaje" rows="3" placeholder="Mensaje"><?php echo $data['mensaje'] ?></textarea>
                        <label for="mensaje">Mensaje</label>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="button" onclick="ModificarEmpresa()">Modificar</button>
        </form>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>