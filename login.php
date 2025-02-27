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
            action="./php/login.php"
            class="form"
            id="formularioLogin"
            method="POST"
          >
            <div class="mb-5 text-center">
              <h3>Iniciar sesión</h3>
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
            <div class="mb-3">
              <label for="contra" class="form-label"><b>Contraseña</b></label>
              <input
                type="password"
                class="form-control"
                id="contra"
                name="contra"
                required
              />
            </div>
            <div class="mb-3 row justify-content-between align-items-center">
              <div class="col">
                <a href="./recuperar_contrasena">¿Olvidaste tu Contraseña?</a>
              </div>
              <div class="col text-right">
                <button class="btn btn-primary" id="submitLogin">
                  Ingresar
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <script src="js/custom_scripts/login.js"></script>
  </body>
</html>
