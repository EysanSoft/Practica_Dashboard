<!-- Scroll to Top Button -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- End of Scroll to Top Button -->

<!-- Modal Logout -->
<div
    class="modal fade"
    id="logoutModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b>Cerrar Sesión</b>
                <button
                    class="close"
                    type="button"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Esta seguro de que quiere cerrar la sesión?
            </div>
            <div class="modal-footer">
                <button
                    class="btn btn-secondary"
                    type="button"
                    data-dismiss="modal">
                    Regresar
                </button>
                <a class="btn btn-primary" id="logOut">Salir</a>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Logout -->

<!-- Modal Cambiar Contraseña -->
<div
    class="modal fade"
    id="cambiarContraModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <b>Cambiar Contraseña</b>
                <button
                    class="close"
                    type="button"
                    data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mx-3 mt-2 justify-content-center">
                    <div class="col-12">
                        <form action="./php/peticion_cambiar_contra.php" class="form" id="editarContraForm" method="POST">
                            <div class="mb-3">
                                <label for="contra" class="form-label">Contraseña Nueva</label>
                                <input type="password" class="form-control" id="contra" name="contra" required />
                            </div>
                            <div class="mb-3">
                                <label for="conContra" class="form-label">Confirmar Contraseña Nueva</label>
                                <input type="password" class="form-control" id="conContra" name="conContra" required />
                            </div>
                            <div class="mb-3">
                                <button class="btn btn-primary" id="submitCambiarContra">Cambiar Contraseña</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of Modal Cambiar Contraseña -->
