<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Head -->
  <?php
  include "./layout/head.php";
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
          <h1 class="h3 mb-4 text-gray-800">Registro de Clientes</h1>

          <!-- ########## Formulario de registro. ########## -->
          <div class="row mx-5 mt-5 justify-content-center">
            <div class="col-10">
              <form
                action="./php/peticion_registrar_cliente.php"
                class="form"
                id="formularioRegistrarCliente"
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
                <div class="row">
                  <div class="col-3">
                    <button
                      class="btn btn-primary"
                      id="submitRegistrarCliente">
                      Registrar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- ########## FinFormulario de registro. ########## -->
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
  <script src="js/custom_scripts/registro_clientes.js"></script>
</body>

</html>