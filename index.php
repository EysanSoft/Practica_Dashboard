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
          <!-- <h1 class="h3 mb-4 text-gray-800">Mensajes de Clientes</h1> -->
          <div class="row my-2 justify-content-center">
            <div class="col-6">
              <div class="row mb-3 justify-content-start">
                <div class="col-6">
                  <label for="rangoSemanas" class="form-label">Semanas</label>
                  <select
                    class="form-control"
                    id="rangoSemanas"
                    name="rangoSemanas"
                    required>
                    <option value="D" selected>No Disponible</option>
                    <!-- Datos -->
                  </select>
                </div>
              </div>
              <div id="graficaMensajesDiarios" style="width:100%; height:400px;"></div>
            </div>
            <div class="col-6">
              <div class="row mb-3 justify-content-start">
                <div class="col-6">
                  <label for="rangoSemanas2" class="form-label">Semanas</label>
                  <select
                    class="form-control"
                    id="rangoSemanas2"
                    name="rangoSemanas2"
                    required>
                    <option value="D" selected>No Disponible</option>
                    <!-- Datos -->
                  </select>
                </div>
              </div>
              <div id="graficaPorcentajesMensajesDiarios" style="width:100%; height:400px;"></div>
            </div>
          </div>
          <div class="row my-4 justify-content-center">
            <div class="col-6">
              <div id="graficaMensajesMensuales" style="width:100%; height:400px;"></div>
            </div>
            <div class="col-6">
              <div id="graficaMensajesAnuales" style="width:100%; height:400px;"></div>
            </div>
          </div>
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
  <script src="node_modules/highcharts/highcharts.src.js"></script>
  <script src="js/custom_scripts/reportes.js"></script>
</body>

</html>