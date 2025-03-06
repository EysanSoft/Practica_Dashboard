<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Head -->
    <?php
    include "./layout/head.php";
    include "./layout/role_check.php";
    ?>
    <!-- <style>
        #camera {
            width: 100%;
            max-width: 500px;
        }

        #photo {
            display: none;
        }
    </style> -->
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
                    <h1 class="h3 mb-4 text-gray-800">Camara</h1>
                    <!-- Begin Fotos con Cámara -->
                    <canvas id="canvas" style="display: none;"></canvas>
                    <div class="row text-center mb-2">
                        <div class="col-3">
                            <video id="video">Video no disponible.</video>
                            <hr>
                            <button class="btn btn-primary" id="start-button">Tomar foto</button>
                        </div>
                        <div class="col-3" id="output-div" style="display: none;">
                            <img id="photo" alt="La imagen capturada aparecerá en esta caja." />
                            <hr>
                            <button class="btn btn-success" id="save-button">Guardar Imagen</button>
                        </div>
                    </div>
                    <!-- End of Fotos con Cámara -->
                    <!-- Begin Video y Audio con Cámara -->
                    <div class="row text-center">
                        <div class="col-3">
                            <video id="preview" width="320" style="display: none;" autoplay muted></video>
                            <hr>
                            <button class="btn btn-primary" id="startButton">Empezar a Grabar</button>
                            <button class="btn btn-danger" id="stopButton">Detener la Grabación</button>
                            <p id="log" class="mt-2"></p>
                        </div>
                        <div class="col-3" id="output-div-2" style="display: none;">
                            <video id="recording" width="320" controls></video>
                            <hr>
                            <a id="downloadButton" class="button btn btn-success">Descargar</a>
                        </div>
                    </div>
                    <!-- End of Video y Audio con Cámara -->
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
    <script src="js/custom_scripts/fotos_camara.js"></script>
    <script src="js/custom_scripts/videos_camara.js"></script>
</body>

</html>