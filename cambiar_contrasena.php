<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link
      href="vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
      type="text/css"
    />
    <link
      href="node_modules/sweetalert2/dist/sweetalert2.min.css"
      rel="stylesheet"
    />
    <link href="css/sb-admin-2.min.css" rel="stylesheet" />
    <?php
    if (!isset($_GET["token"]) || !isset($_GET["userId"])) {
        header("Location: ./login");
        exit;
    }
    ?>
    <style>
      body {
        background-color: #4e72df60;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <div
        class="row justify-content-center align-items-center"
        style="height: 90vh"
      >
        <div class="col-5 p-4 border border-3 rounded">
          <form
            action="./php/peticion_cambiar_contra.php"
            class="form"
            id="editarContraForm"
            method="POST"
          >
            <div class="mb-3 text-center">
              <h3>Cambiar Contraseña</h3>
            </div>
            <div class="mb-3 text-center">
                <p>La contraseña debe contener mínimo 8 caracteres, una letra en mayúscula y otra en minúscula, un número y un símbolo especial: #?!@$%^&*-</p>
            </div>
            <div class="mb-3">
              <label for="contra" class="form-label">Contraseña Nueva</label>
              <input type="password" class="form-control" id="contra" name="contra" required />
            </div>
            <div class="mb-3">
                <label for="conContra" class="form-label">Confirmar Contraseña Nueva</label>
                <input type="password" class="form-control" id="conContra" name="conContra" required />
            </div>
            <div class="mb-3 text-right">
                <button class="btn btn-primary" id="submitCambiarContra">
                    Cambiar Contraseña
                </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <script src="js/custom_scripts/cambiar_contrasena.js"></script>
  </body>
</html>
