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
          <h1 class="h3 mb-4 text-gray-800">Escribir un Mensaje</h1>

          <!-- ########## Formulario de registro. ########## -->
          <div class="row mx-5 mt-5 justify-content-center">
            <div class="col-10">
              <form
                action="./php/peticion_registrar_mensaje.php"
                class="form"
                id="formularioRegistrarMensaje"
                method="POST">
                <div class="row mb-4">
                  <div class="col-10">
                    <label for="cuerpo" class="form-label">Cuerpo</label>
                    <textarea
                      class="form-control"
                      id="cuerpo"
                      name="cuerpo"
                      maxlength="500"
                      rows="4">
                      </textarea>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-3">
                    <label for="tipo-select" class="form-label">Tipo de Mensaje</label>
                    <select
                      class="form-control"
                      id="tipo-select"
                      name="tipo-select">
                      <option value="D" selected>Elige una Opción</option>
                      <option value="C">Correo</option>
                      <option value="T">Teléfono (SMS)</option>
                      <option value="W">Teléfono (WhatsApp)</option>
                    </select>
                  </div>
                  <div class="col-5" id="tipo-div-dinamico">
                    <label for="tipo" class="form-label">Referencia</label>
                    <input
                      type="text"
                      class="form-control"
                      id="tipo"
                      name="tipo"
                      disabled />
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col-5">
                    <label for="cliente" class="form-label">Cliente</label>
                    <select
                      class="form-control"
                      id="cliente"
                      name="cliente"
                      required>
                      <option value="D" selected>Sin clientes</option>
                      <!-- Datos -->
                    </select>
                  </div>
                </div>

                <div class="row">
                  <div class="col-3">
                    <button
                      class="btn btn-primary"
                      id="submitRegistrarMensaje">
                      Registrar
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- ########## Fin Formulario de registro. ########## -->

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
  include "./layout/modal_logout.php";
  ?>
  <!-- End of Logout Modal-->
  <!-- Scripts -->
  <?php
  include "./layout/scripts.php";
  ?>
  <!-- End of Scripts -->
  <script src="js/custom_scripts/registro_mensajes.js"></script>
</body>

</html>