<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Head -->
  <?php
  include "./layout/head.php";
  ?>
  <link
    href="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.css"
    rel="stylesheet"
    integrity="sha384-M6C9anzq7GcT0g1mv0hVorHndQDVZLVBkRVdRb2SsQT7evLamoeztr1ce+tvn+f2"
    crossorigin="anonymous">
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
          <button class="btn btn-success" onclick="window.location='registro_mensajes.php';">
            Escribir Mensaje
          </button>
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
  include "./layout/modal_logout.php";
  ?>
  <!-- End of Logout Modal-->
  <!-- Scripts -->
  <?php
  include "./layout/scripts.php";
  ?>
  <!-- End of Scripts -->
  <script
    src="https://cdn.datatables.net/v/bs5/dt-2.2.2/datatables.min.js"
    integrity="sha384-k90VzuFAoyBG5No1d5yn30abqlaxr9+LfAPp6pjrd7U3T77blpvmsS8GqS70xcnH"
    crossorigin="anonymous">
  </script>
  <script src="js/custom_scripts/tabla_mensajes.js"></script>
</body>

</html>