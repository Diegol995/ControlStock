<?php
    class Compras extends Controller{
        public function __construct(){
            session_start();
            parent::__construct();
        }

        public function index(){
            $this->views->getView($this, 'index');
        }

        public function ventas(){
            $data = $this->model->getClientes();
            $this->views->getView($this, 'ventas', $data);
        }

        public function historial_ventas(){
            $this->views->getView($this, 'historial_ventas');
        }

        public function buscarCodigo($cod){
            $data = $this->model->getProdCod($cod);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function ingresar(){
            //id del detalle
            $id = $_POST['id'];
            //Se obtienen los datos el producto mediante el id para después cargarlos en la tabla
            //detalle con la cantidad que ingresa el usuario y el subtotal calculado
            $datos = $this->model->getProductos($id);
            $id_producto = $datos['id'];
            $id_usuario = $_SESSION['id_usuario'];
            $precio = $datos['precio_compra'];
            $cantidad = $_POST['cantidad'];
            //Se comprueba que si se registra la compra de otro producto y ese producto ya está
            //cargado, que no agregue otra fila sino que sume la cantidad al mismo
            $comprobar = $this->model->consultarDetalle('detalle', $id_producto, $id_usuario);
            if (empty($comprobar)){
                $sub_total = $precio * $cantidad;
                $data = $this->model->registrarDetalle('detalle', $id_producto, $id_usuario, $precio, $cantidad, $sub_total);
                if ($data == "Ok"){
                    $msg = array('msg' => 'Ok', 'icono' => 'success');
                }else{
                    $msg = array('msg' => '¡Error al ingresar el producto!', 'icono' => 'error');
                }
            }else
            {
                $total_cantidad = $comprobar['cantidad'] + $cantidad;
                $sub_total = $total_cantidad * $precio;
                $data = $this->model->actualizarDetalle('detalle', $precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
                if ($data == "modificado"){
                    $msg = array('msg' => 'modificado', 'icono' => 'success');
                }else{
                    $msg = array('msg' => '¡Error al modificar el producto!', 'icono' => 'error');
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function ingresarVenta(){
            //id del detalle
            $id = $_POST['id'];
            //Se obtienen los datos el producto mediante el id para después cargarlos en la tabla
            //detalle con la cantidad que ingresa el usuario y el subtotal calculado
            $datos = $this->model->getProductos($id);
            $id_producto = $datos['id'];
            $id_usuario = $_SESSION['id_usuario'];
            $precio = $datos['precio_venta'];
            $cantidad = $_POST['cantidad'];
            //Se comprueba que si se registra la compra de otro producto y ese producto ya está
            //cargado, que no agregue otra fila sino que sume la cantidad al mismo
            $comprobar = $this->model->consultarDetalle('detalle_temp', $id_producto, $id_usuario);
            if (empty($comprobar)){
                $sub_total = $precio * $cantidad;
                $data = $this->model->registrarDetalle('detalle_temp', $id_producto, $id_usuario, $precio, $cantidad, $sub_total);
                if ($data == "Ok"){
                    $msg = array('msg' => 'Ok', 'icono' => 'success');
                }else{
                    $msg = array('msg' => '¡Error al ingresar el producto!', 'icono' => 'error');
                }
            }else
            {
                $total_cantidad = $comprobar['cantidad'] + $cantidad;
                $sub_total = $total_cantidad * $precio;
                $data = $this->model->actualizarDetalle('detalle_temp', $precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
                if ($data == "modificado"){
                    $msg = array('msg' => 'modificado', 'icono' => 'success');
                }else{
                    $msg = array('msg' => '¡Error al modificar el producto!', 'icono' => 'error');
                }
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function listar($table){
            $id_usuario = $_SESSION['id_usuario'];
            $data['detalle'] = $this->model->getDetalle($table, $id_usuario);
            $data['total_pagar'] = $this->model->calcularCompra($table, $id_usuario);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function delete($id){
            $data = $this->model->deleteDetalle('detalle', $id);
            if ($data == "Ok")
            {
                $msg = "Ok";
            }
            else
            {
                $msg = "Error al eliminar el producto.";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function deleteVenta($id){
            $data = $this->model->deleteDetalle('detalle_temp', $id);
            if ($data == "Ok")
            {
                $msg = "Ok";
            }
            else
            {
                $msg = "Error al eliminar el producto.";
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrarCompra(){
            $id_usuario = $_SESSION['id_usuario'];
            $total = $this->model->calcularCompra('detalle', $id_usuario);
            $data = $this->model->registrarCompra($id_usuario, $total['total']);
            if ($data == 'Ok'){
                $detalle = $this->model->getDetalle('detalle', $id_usuario);
                $id_compra = $this->model->getId('compras');
                foreach ($detalle as $row){
                    $id_producto = $row['id_producto'];
                    $cantidad = $row['cantidad'];
                    $precio = $row['precio'];
                    $sub_total = $cantidad * $precio;
                    $this->model->registarDetalleCompra($id_compra['id'], $id_producto,$cantidad, $precio, $sub_total);
                    //Se actualiza el stock de productos
                    $stock_actual = $this->model->getProductos($id_producto);
                    $stock = $stock_actual['cantidad'] + $cantidad;
                    $this->model->actualizarStock($stock, $id_producto);
                }
                //Se vacía la tabla detalle
                $vaciar = $this->model->vaciarDetalle('detalle', $id_usuario);
                if ($vaciar == "Ok")
                {
                    $msg = array('msg' => 'Ok', 'id_compra' => $id_compra['id']);
                }
            }else{
                $msg = 'Error al generar la compra.';
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrarVenta($id_cliente){
            $id_usuario = $_SESSION['id_usuario'];
            $total = $this->model->calcularCompra('detalle_temp', $id_usuario);
            $data = $this->model->registrarVenta($id_usuario, $id_cliente, $total['total']);
            if ($data == 'Ok'){
                $detalle = $this->model->getDetalle('detalle_temp', $id_usuario);
                $id_venta = $this->model->getId('ventas');
                foreach ($detalle as $row){
                    $id_producto = $row['id_producto'];
                    $cantidad = $row['cantidad'];
                    $desc = $row['descuento'];
                    $precio = $row['precio'];
                    $sub_total = ($cantidad * $precio) - $desc;
                    $this->model->registarDetalleVenta($id_venta['id'], $id_producto, $cantidad, $desc,$precio, $sub_total);
                    //Se actualiza el stock de productos
                    $stock_actual = $this->model->getProductos($id_producto);
                    $stock = $stock_actual['cantidad'] - $cantidad;
                    $this->model->actualizarStock($stock, $id_producto);
                }
                //Se vacía la tabla detalle
                $vaciar = $this->model->vaciarDetalle('detalle_temp', $id_usuario);
                if ($vaciar == "Ok")
                {
                    $msg = array('msg' => 'Ok', 'id_venta' => $id_venta['id']);
                }
            }else{
                $msg = 'Error al generar la venta.';
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function generarPdf($id_compra){
            require('Libraries/fpdf/fpdf.php');

            $empresa = $this->model->getEmpresa();
            //Se obtienen los detalles de los productos comprados
            $productos = $this->model->getProdCompra($id_compra);
            //Se crea una instancia y como parámetro se pasa el tamaño de la hoja
            //En este caso se usa un array para que sea tamaño ticket
            $pdf = new FPDF('P','mm',array(110, 200));
            $pdf->AddPage();
            $pdf->SetMargins(1, 0, 0);
            $pdf->SetTitle('Reporte Compra');
            $pdf->Image(base_url . "Assets/img/logo.jpeg", 85, 0, 25, 25);

            //Salto de linea
            $pdf->Ln();

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(17,5, "Cuit/Cuil: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $empresa['cuit_cuil'], 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(17,5, utf8_decode("Teléfono: "), 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $empresa['telefono'], 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(19,5, utf8_decode("Dirección: "), 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $empresa['direccion'], 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(23,5, "Nro Compra: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $id_compra, 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(35,5, "Usuario Encargado: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $productos[0]['nombre'], 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(15,5, "Fecha: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, date('d-m-Y'), 0, 1, 'L');
            $pdf->Ln();
            
            //ENCABEZADO DE PRODUCTOS
            //Color de fondo
            $pdf->SetFillColor(0, 0, 0);
            //Color del texto
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
            $pdf->Cell(65, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
            $pdf->Cell(15, 5, 'Precio', 0, 0, 'L', true);
            $pdf->Cell(18, 5, 'Sub Total', 0, 1, 'L', true);
            $pdf->SetTextColor(0, 0, 0);
            foreach ($productos as $row){
                $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
                $pdf->Cell(65, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
                $pdf->Cell(15, 5, '$'.$row['precio'], 0, 0, 'L');
                $pdf->Cell(18, 5, '$'.$row['sub_total'], 0, 1, 'L');
            }
            $pdf->Ln();
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(105, 5, 'Total a Pagar', 0, 1, 'R');
            $pdf->Cell(105, 5, '$'.$productos[0]['total'], 0, 1, 'R');

            $pdf->SetY(169);
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,10,utf8_decode($empresa['mensaje']),0,0,'C');
            $pdf->Output();
        }

        public function historial(){
            $this->views->getView($this, 'historial');
        }

        public function listar_historial(){
            $data = $this->model->getHistorialCompras();
            for ($i=0; $i < count($data); $i++){
                $data[$i]['acciones'] = '<div>
                    <a class="btn btn-danger" target="blank" href="'.base_url. "Compras/generarPdf/" .$data[$i]['id'].'" title="Generar PDF"><i class="fas fa-file-pdf"></i></a>
                    </div>';
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function listar_historialVentas(){
            $data = $this->model->getHistorialVentas();
            for ($i=0; $i < count($data); $i++){
                $data[$i]['acciones'] = '<div>
                    <a class="btn btn-danger" target="blank" href="'.base_url. "Compras/generarPdfVenta/" .$data[$i]['id'].'" title="Generar PDF"><i class="fas fa-file-pdf"></i></a>
                    </div>';
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function generarPdfVenta($id_venta){
            require('Libraries/fpdf/fpdf.php');

            $empresa = $this->model->getEmpresa();
            $descuento = $this->model->getDescuento($id_venta);
            //Se obtienen los detalles de los productos comprados
            $productos = $this->model->getProdVenta($id_venta);
            //Se crea una instancia y como parámetro se pasa el tamaño de la hoja
            //En este caso se usa un array para que sea tamaño ticket
            $pdf = new FPDF('P','mm',array(110, 200));
            $pdf->AddPage();
            $pdf->SetMargins(1, 0, 0);
            $pdf->SetTitle('Reporte Venta');
            $pdf->Image(base_url . "Assets/img/logo.jpeg", 85, 0, 25, 25);

            //Salto de linea
            $pdf->Ln();

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(17,5, "Cuit/Cuil: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $empresa['cuit_cuil'], 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(17,5, utf8_decode("Teléfono: "), 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $empresa['telefono'], 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(19,5, utf8_decode("Dirección: "), 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $empresa['direccion'], 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(23,5, "Nro Venta: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $id_venta, 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(35,5, "Usuario Encargado: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $productos[0]['nombre'], 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(15,5, "Fecha: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, date('d-m-Y'), 0, 1, 'L');
            $pdf->Ln();

            //ENCABEZADO DE CLIENTES
            $cliente = $this->model->clienteVenta($id_venta);
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(35,5, "Nombre Cliente: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, utf8_decode($cliente['nombre']), 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(17,5, "Cuit/Cuil: ", 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $cliente['cuit_cuil'], 0, 1, 'L');
            
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(19,5, utf8_decode("Dirección: "), 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, utf8_decode($cliente['direccion']), 0, 1, 'L');

            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(17,5, utf8_decode("Teléfono: "), 0, 0, 'L');
            $pdf->SetFont('Arial','',10);
            $pdf->Cell(20,5, $cliente['telefono'], 0, 1, 'L');
            $pdf->Ln();

            //ENCABEZADO DE PRODUCTOS
            //Color de fondo
            $pdf->SetFillColor(0, 0, 0);
            //Color del texto
            $pdf->SetTextColor(255, 255, 255);
            $pdf->Cell(10, 5, 'Cant', 0, 0, 'L', true);
            $pdf->Cell(65, 5, utf8_decode('Descripción'), 0, 0, 'L', true);
            $pdf->Cell(15, 5, 'Precio', 0, 0, 'L', true);
            $pdf->Cell(18, 5, 'Sub Total', 0, 1, 'L', true);
            $pdf->SetTextColor(0, 0, 0);
            foreach ($productos as $row){
                $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
                $pdf->Cell(65, 5, utf8_decode($row['descripcion']), 0, 0, 'L');
                $pdf->Cell(15, 5, '$'.$row['precio'], 0, 0, 'L');
                $pdf->Cell(18, 5, '$'.$row['sub_total'], 0, 1, 'L');
            }
            $pdf->Ln();
            $pdf->SetFont('Arial','B',10);
            $pdf->Cell(105, 5, 'Descuento Total', 0, 1, 'R');
            $pdf->Cell(105, 5, '$'.$descuento['total'], 0, 1, 'R');
            $pdf->Cell(105, 5, 'Total a Pagar', 0, 1, 'R');
            $pdf->Cell(105, 5, '$'.$productos[0]['total'], 0, 1, 'R');

            $pdf->SetY(169);
            $pdf->SetFont('Arial','I',8);
            $pdf->Cell(0,10,utf8_decode($empresa['mensaje']),0,0,'C');
            $pdf->Output();
        }

        public function calcularDescuento($datos){
            $array = explode(',', $datos);
            $id = $array[0];
            $desc = $array[1];
            if (empty($id) || empty($desc)){
                $msg = array ('msg' => '¡El campo no puede estar vacío!', 'icono' => 'warning');
            }else{
                $desc_actual = $this->model->verificarDescuento($id);
                $desc_total = $desc_actual['descuento'] + $desc;
                $sub_total = ($desc_actual['cantidad'] * $desc_actual['precio']) - $desc_total;
                $data = $this->model->actualizarDescuento($desc_total, $sub_total,$id);
                if ($data == 'Ok'){
                    $msg = array ('msg' => '¡Descuento aplicado!', 'icono' => 'success');
                }else{
                    $msg = array ('msg' => '¡No se aplicó el descuento!', 'icono' => 'error');
                }
                echo json_encode($msg, JSON_UNESCAPED_UNICODE);
                die();
            }
        }
    }
?>