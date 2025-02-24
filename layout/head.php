<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta name="description" content="" />
<meta name="author" content="" />

<title>Dashboard</title>

<!-- Custom fonts for this template-->
<link
    href="vendor/fontawesome-free/css/all.min.css"
    rel="stylesheet"
    type="text/css" />
<link href="./css/google_fonts.css" rel="stylesheet" />
<link
    href="node_modules/sweetalert2/dist/sweetalert2.min.css"
    rel="stylesheet" />

<!-- Custom styles for this template-->
<link href="css/sb-admin-2.min.css" rel="stylesheet" />

<?php
session_start();
if (!isset($_SESSION["token"])) {
    header("Location: ./login");
    exit;
}
?>
