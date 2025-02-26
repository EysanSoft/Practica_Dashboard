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
            action="./php/recuperar_contrasena.php"
            class="form"
            id="formularioRecuCon"
            method="POST"
          >
            <div class="mb-3 text-center">
                <h3>Recuperar Contraseña</h3>
            </div>
            <div class="mb-3 text-center">
                <p>Si tiene una cuenta con nosotros, ingrese su correo de esta misma para poder cambiar su contraseña.</p>
            </div>
            <div class="mb-3">
              <label for="correo" class="form-label"><b>Correo</b></label>
              <input
                type="email"
                class="form-control"
                id="correo"
                name="correo"
                required
              />
            </div>
            <div class="mb-3 text-right">
                <button class="btn btn-primary" id="submitRecuCon">
                    Enviar
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

    <script src="js/custom_scripts/recuperar_contrasena.js"></script>
  </body>
</html>
