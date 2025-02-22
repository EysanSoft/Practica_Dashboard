<ul
    class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
    id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a
        class="sidebar-brand d-flex align-items-center justify-content-center"
        href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dashboard</div>
    </a>
    
    <!-- Divider -->
    <hr class="sidebar-divider my-0" />

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Admin Only Modules -->
    <?php
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
        if ($_SESSION["roleId"] == 1) {
            include "admin_access.php";
        }
    }
    else {
        if ($_SESSION["roleId"] == 1) {
            include "admin_access.php";
        }
    }
    ?>
    
    <!-- Divider -->
    <hr class="sidebar-divider" />

    <!-- Heading -->
    <div class="sidebar-heading">Administrar</div>

    <!-- Nav Item - Mensajes -->
    <li class="nav-item">
        <a class="nav-link" href="mensajes.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Mensajes</span>
        </a>
    </li>

    <!-- Nav Item - Reportes -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="reportes.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Reportes</span>
        </a>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block" />

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>