<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4">

    <div class="container-fluid">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold" href="#">
            <img src="/fyp/img/LogoMaraliner.png"
                 alt="Logo"
                 width="100"
                 height="30">
        </a>

        <!-- MOBILE TOGGLE -->
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- NAV CONTENT -->
        <div class="collapse navbar-collapse"
             id="navbarSupportedContent">

            <!-- LEFT MENU -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active"
                       href="/fyp/views/admin/dashboard.php">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link"
                       href="/fyp/views/admin/tracking.php">
                        Track Bus
                    </a>
                </li>

                <!-- ADMIN ONLY -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle"
                       href="#"
                       role="button"
                       data-bs-toggle="dropdown">

                        Admin Panel

                    </a>

                    <ul class="dropdown-menu">

                        <li>
                            <a class="dropdown-item"
                               href="/fyp/views/admin/geofence.php">
                                📍 Geofence
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                               href="/fyp/views/admin/vehicles.php">
                                🚍 Vehicles
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item"
                               href="/fyp/views/admin/reports.php">
                                📊 Reports
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-danger"
                               href="/fyp/modules/auth/logout.php">
                                Logout
                            </a>
                        </li>

                    </ul>

                </li>

                <?php endif; ?>

            </ul>

            <!-- SEARCH -->
            <form class="d-flex me-3">

                <input class="form-control me-2"
                       type="search"
                       placeholder="Search">

                <button class="btn btn-outline-danger"
                        type="submit">

                    Search

                </button>

            </form>

            <!-- PROFILE -->
            <div class="dropdown">

                <button class="btn btn-light position-relative"
                        data-bs-toggle="dropdown">

                    <img src="/fyp/img/profile.png"
                         width="35"
                         height="35"
                         class="rounded-circle">

                    <!-- NOTIFICATION -->
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item" href="#">
                            👤 Profile
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            ⚙ Settings
                        </a>
                    </li>

                    <li><hr class="dropdown-divider"></li>

                    <li>
                        <a class="dropdown-item text-danger"
                           href="/fyp/modules/auth/logout.php">
                            Logout
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</nav>