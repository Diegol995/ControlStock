<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bienvenido</title>
        <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
        </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header text-center">
                                        <h3 class="font-weight-light my-4">Login</h3>
                                        <img src="<?php echo base_url;?>Assets/img/logo.png" class="img-fluid rounded" alt="logo" width="150">
                                    </div>
                                    <div class="card-body">
                                        <form id="frmLogin">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="usuario" type="text" name="usuario" placeholder="Usuario" />
                                                <label for="usuario">Usuario</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="clave" type="password" name="clave" placeholder="Contraseña" />
                                                <label for="clave">Contraseña</label>
                                            </div>
                                            <button type="button" class="btn btn-primary" onclick="frmLogin(event);">Iniciar Sesión</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
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
            </div>
        </div>
        <script src="<?php echo base_url; ?>Assets/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/scripts.js"></script>
        <script src="<?php echo base_url; ?>Assets/js/login.js"></script>
        <script>
            const base_url = '<?php echo base_url; ?>';
        </script>
    </body>
</html>
