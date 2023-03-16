                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>               
            <div id="cambiarPass" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-dark text-white">
                        <h5 class="modal-title">Modificar Contraseña</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="frmCambiarPass" onsubmit="frmCambiarPass(event);">
                            <div class="form-group">
                                <label for="clave_actual">Contraseña Actual</label>
                                <input id="clave_actual" class="form-control" type="password" name="clave_actual" placeholder="Contraseña Actual">
                            </div>
                            <div class="form-group">
                                <label for="clave_nueva">Nueva Contraseña</label>
                                <input id="clave_nueva" class="form-control" type="password" name="clave_nueva" placeholder="Nueva Contraseña ">
                            </div>
                            <div class="form-group">
                                <label for="confirmar_clave">Confirmar Contraseña</label>
                                <input id="confirmar_clave" class="form-control" type="password" name="confirmar_clave" placeholder="Confirmar Contraseña">
                            </div>
                            <button class="btn btn-primary" type="submit">Modificar</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            </div>
        </div>
        <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/chart.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/jquery-3.6.3.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/DataTables/datatables.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/select2.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/sweetalert2.all.min.js"></script>
        <script>
            const base_url = '<?php echo base_url; ?>';
        </script>
        <script src="<?php echo base_url; ?>Assets/js/funciones.js"></script>
    </body>
</html>