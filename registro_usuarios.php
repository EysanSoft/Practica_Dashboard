<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Head -->
  <?php
  include "./layout/head.php";
  include "./layout/role_check.php";
  ?>
  <!-- End of Head -->
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <?php
    include "./layout/sidebar.php";
    ?>
    <!-- End of Sidebar -->
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <?php
        include "./layout/navbar.php";
        ?>
        <!-- End of Topbar -->
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Registro de Usuarios</h1>

          <!-- ########## Formulario de registro. ########## -->
          <div class="row mx-5 mt-5 justify-content-center">
            <div class="col-10">
              <form
                action="./php/peticion_registrar_usuario.php"
                class="form"
                id="formularioRegistrarUsuario"
                method="POST">
                <div class="row mb-4">
                  <div class="col-5">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input
                      type="text"
                      class="form-control"
                      id="nombre"
                      name="nombre"
                      maxlength="15"
                      required />
                  </div>
                  <div class="col-5">
                    <label for="apellido" class="form-label">Apellido</label>
                    <input
                      type="text"
                      class="form-control"
                      id="apellido"
                      name="apellido"
                      maxlength="30"
                      required />
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-5">
                    <label for="correo" class="form-label">Correo</label>
                    <input
                      type="email"
                      class="form-control"
                      id="correo"
                      name="correo"
                      required />
                  </div>
                  <div class="col-5">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input
                      type="tel"
                      class="form-control"
                      id="telefono"
                      name="telefono"
                      required />
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-5">
                    <label for="contra" class="form-label">Contraseña</label>
                    <input
                      type="password"
                      class="form-control"
                      id="contra"
                      name="contra"
                      required />
                  </div>
                  <div class="col-5">
                    <label for="conContra" class="form-label">Confirmar Contraseña</label>
                    <input
                      type="password"
                      class="form-control"
                      id="conContra"
                      name="conContra"
                      required />
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col-2">
                    <label for="rolId" class="form-label">Rol de Usuario</label>
                    <select class="form-control" id="rolId" name="rolId" required>
                      <option value="D" selected>Elige un rol</option>
                      <option value="1">Administrador</option>
                      <option value="2">Empleado</option>
                    </select>
                  </div>
                  <div class="col-3" id="permisosContainer">
                    <label for="permisos" class="form-label">Permisos de Empleado</label>
                    <select class="form-control" id="permisos" name="permisos">
                      <option selected>Sin Permisos</option>
                      <option value="C">Crear (Reportes de sus Mensajes)</option>
                      <option value="E">Eliminar</option>
                      <option value="C&E">Crear y Eliminar</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-10">
                    <small>
                      Mínimo 8 caracteres, una letra en mayúscula y otra en
                      minúscula, un número y un símbolo especial (#?!@$%^&*-)
                    </small>
                  </div>
                </div>
                <div class="row">
                  <div class="col-3">
                    <button
                      class="btn btn-primary"
                      id="submitRegistrarUsuario">
                      Registrar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- ########## Formulario de registro. ########## -->
           
        </div>
        <!-- End of Page Content -->
      </div>
      <!-- End of Main Content -->
      <!-- Footer -->
      <?php
      include "./layout/footer.php";
      ?>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
  <!-- Logout Modal-->
  <?php
  include "./layout/modals.php";
  ?>
  <!-- End of Logout Modal-->
  <!-- Scripts -->
  <?php
  include "./layout/scripts.php";
  ?>
  <!-- End of Scripts -->
  <script src="js/custom_scripts/registro_usuarios.js"></script>
</body>

</html>