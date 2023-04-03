<?php include "Views/Templates/header.php";?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body">
                <i class="fas fa-user fa-2x"></i>
                Usuarios
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url; ?>Usuarios">Ver Detalles</a>
                <span class="text-white"><?php echo $data['usuarios']['total'] ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-4">
            <div class="card-body">
                <i class="fas fa-user fa-2x"></i>
                Clientes
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url;?>Clientes">Ver Detalles</a>
                <span class="text-white"><?php echo $data['clientes']['total'] ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body">
                <i class="fab fa-product-hunt fa-2x"></i>
                Productos
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url;?>Productos">Ver Detalles</a>
                <span class="text-white"><?php echo $data['productos']['total'] ?></span>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-4">
            <div class="card-body">
                <i class="fas fa-cart-shopping fa-2x"></i>
                Ventas del Día
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?php echo base_url;?>Compras/historial_ventas">Ver Detalles</a>
                <span class="text-white"><?php echo $data['ventas']['total'] ?></span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-area me-1"></i>
                Productos más vendidos
            </div>
            <div class="card-body"><canvas id="stockMinimo" width="100%" height="40"></canvas></div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Productos con Stock mínimo
            </div>
            <div class="card-body"><canvas id="ProductosVendidos" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php";?>