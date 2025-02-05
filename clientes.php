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
          <h1 class="h3 mb-4 text-gray-800">Clientes</h1>
          <button
            class="btn btn-success"
            onclick="window.location='registro_clientes.php';">
            Registrar un Cliente
          </button>

          <!-- ########## Tabla Clientes ########## -->
          <div class="row my-2 justify-content-center">
            <div class="col-12">
              <div class="table-responsive">
                <table
                  class="table table-success table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th scope="col" class="col-1 text-center">#</th>
                      <th scope="col" class="text-center">Nombre</th>
                      <th scope="col" class="text-center">Apellidos</th>
                      <th scope="col" class="text-center">Correo</th>
                      <th scope="col" class="text-center">Teléfono</th>
                      <th scope="col" class="col-2 text-center">Acción</th>
                    </tr>
                  </thead>
                  <tbody id="tablaClientes">
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
  include "./layout/modal_logout.php";
  ?>
  <!-- End of Logout Modal-->
  <!-- Modal Editar Cliente -->
  <div
    class="modal fade"
    id="modalEditarCliente"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <b>Editar Cliente</b>
          <!--
              Por alguna razon, el botón no funciona.
              tuve que implementarle un onclick para forzar el cierre.
            -->
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
            onclick="$('#modalEditarCliente').modal('hide');"></button>
        </div>
        <div class="modal-body">
          <div class="row mx-3 mt-2 justify-content-center">
            <div class="col-12">
              <form
                action="./php/peticion_editar_cliente.php"
                class="form"
                id="formularioEditarCliente"
                method="POST">
                <!-- Datos... -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End of Modal Editar Cliente -->
  <!-- Scripts -->
  <?php
  include "./layout/scripts.php";
  ?>
  <!-- End of Scripts -->
  <script src="js/custom_scripts/tabla_clientes.js"></script>
</body>

</html>