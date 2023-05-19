<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Sistema Escolar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Escuela
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="grupo.php">Grupos</a></li>
                        <li><a class="dropdown-item" href="maestro.php">Maestros</a></li>
                        <li><a class="dropdown-item" href="materia.php">Materias</a></li>
                        </ul>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Alumnos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="alumno.php">Alumnos</a></li>
                        <li><a class="dropdown-item" href="tutor.php">Tutores</a></li>
                        <li><a class="dropdown-item" href="estadisticas.php">Estadisticas</a></li>
                        </ul>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="usuario.php">Usuarios</a></li>
                        <li><a class="dropdown-item" href="rol.php">Roles</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php?action=logout">Logout</a>
                </li>
            </ul>
            
        </div>
    </div>
</nav>