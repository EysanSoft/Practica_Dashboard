<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Head -->
  <?php
  include "./layout/head.php";
  ?>
  <link href="./css/datatables.min.css" rel="stylesheet">
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
          <h1 class="h3 mb-4 text-gray-800">Mensajes</h1>
          
          <!-- ########## Botones Personalizados ########## -->
          <div class="row align-items-center">
            <div class="col">
              <button class="btn btn-success" onclick="window.location='registro_mensajes.php';">
                Escribir Mensaje
              </button>
            </div>
            <div class="col-3">
              <label for="fechaIni" class="form-label">Fecha Inicial</label>
              <input class="form-control" type="date" id="fechaIni" name="fechaIni">
            </div>
            <div class="col-3">
              <label for="fechaFin" class="form-label">Fecha Final</label>
              <input class="form-control" type="date" id="fechaFin" name="fechaFin">
            </div>
          </div>
          <!-- ########## Fin de Botones Personalizados ########## -->

          <!-- ########## Tabla Mensajes ########## -->
          <div class="row my-2 justify-content-center">
            <div class="col-12">
              <div class="table-responsive">
                <table
                  class="table table-secondary table-striped table-bordered table-hover"
                  id="tablaMensajes">
                  <thead>
                    <tr>
                      <th scope="col" class="col-1 text-center">#</th>
                      <th scope="col" class="col-5 text-center">Cuerpo</th>
                      <th scope="col" class="col-1 text-center">Contacto</th>
                      <th scope="col" class="col-1 text-center">Tipo</th>
                      <th scope="col" class="col-1 text-center">Status</th>
                      <th scope="col" class="col-1 text-center">Cliente</th>
                      <th scope="col" class="col-1 text-center">Fecha y Hora</th>
                      <th scope="col" class="col-1 text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody id="cuerpoTablaMensajes">
                    <tr>
                      <td colspan="8"><b>Sin datos...</b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- ########## Fin de Tabla Mensajes ########## -->
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
  <script src="./js/pdfmake.min.js"></script>
  <script src="./js/vfs_fonts.js"></script>
  <script src="./js/datatables.min.js"></script>
  <script src="js/custom_scripts/tabla_mensajes.js"></script>
</body>

</html>