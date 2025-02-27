<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button
        id="sidebarToggleTop"
        class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>
    <!-- End of Sidebar Toggle (Topbar) -->

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>
        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a
                class="nav-link dropdown-toggle"
                href="#"
                id="userDropdown"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
                <div id="perfilUsuario">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">...</span>
                    <img class="img-profile rounded-circle" src="./img/perfil/default.png"/>
                </div>
            </a>
            <!-- Dropdown - User Information -->
            <div
                class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a 
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#cambiarFotoPerfilModal">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cambiar Foto de Perfil
                </a>
                <a 
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#cambiarContraModal">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cambiar Contraseña
                </a>
                <div class="dropdown-divider"></div>
                <a
                    class="dropdown-item"
                    href="#"
                    data-toggle="modal"
                    data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Cerrar Sesión
                </a>
            </div>
            <!-- End of Dropdown - User Information -->
        </li>
        <!-- End of Nav Item - User Information -->
    </ul>
    <!-- End of Topbar Navbar -->
</nav>
