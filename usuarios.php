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
          <h1 class="h3 mb-4 text-gray-800">Usuarios</h1>
          <button
            class="btn btn-success"
            onclick="window.location='registro_usuarios.php';">
            Registrar un Usuario
          </button>

          <!-- ########## Tabla Usuarios ########## -->
          <div class="row my-2 justify-content-center">
            <div class="col-12">
              <div class="table-responsive">
                <table
                  class="table table-primary table-striped table-bordered table-hover"
                  id="tablaUsuarios">
                  <thead>
                    <tr>
                      <th scope="col" class="col-1 text-center">#</th>
                      <th scope="col" class="text-center">Nombre</th>
                      <th scope="col" class="text-center">Apellidos</th>
                      <th scope="col" class="text-center">Teléfono</th>
                      <th scope="col" class="text-center">Correo</th>
                      <th scope="col" class="col-2 text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody id="cuerpoTablaUsuarios">
                    <tr>
                      <td colspan="6"><b>Sin datos...</b></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- ########## Fin de Tabla Usuarios ########## -->
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
  <!-- Modal Editar Usuario -->
  <div
    class="modal fade"
    id="modalEditarUsuario"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <b>Editar Usuario</b>
          <!--
              Por alguna razon, el botón no funciona.
              tuve que implementarle un onclick para forzar el cierre.
            -->
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            onclick="$('#modalEditarUsuario').modal('hide');"></button>
        </div>
        <div class="modal-body">
          <div class="row mx-3 mt-2 justify-content-center">
            <div class="col-12">
              <form
                action="./php/peticion_editar_usuario.php"
                class="form"
                id="formularioEditarUsuario"
                method="POST">
                <!-- Datos... -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Editar Usuario -->
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
  <script src="js/custom_scripts/tabla_usuarios.js"></script>
</body>

</html>