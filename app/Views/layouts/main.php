<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($titulo ?? 'Sistema de Información Web') ?> | CodeIgniter 4 MVC</title>

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            --sidebar-bg: #0f172a;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.07), 0 2px 4px -1px rgba(0, 0, 0, 0.04);
            --card-hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar-brand {
            font-weight: 700;
            letter-spacing: -0.5px;
        }
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            transition: all 0.2s ease;
        }
        .stat-card {
            border-left: 4px solid;
            background: #ffffff;
        }
        .stat-card.primary { border-left-color: #3b82f6; }
        .stat-card.success { border-left-color: #10b981; }
        .stat-card.info { border-left-color: #06b6d4; }
        .stat-card.warning { border-left-color: #f59e0b; }
        .stat-card.danger { border-left-color: #ef4444; }
        .stat-card.purple { border-left-color: #8b5cf6; }

        .table > :not(caption) > * > * {
            padding: 0.85rem 1rem;
            vertical-align: middle;
        }
        .badge {
            font-weight: 500;
            padding: 0.4em 0.7em;
        }
        .nav-link.active {
            color: #ffffff !important;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
        }
        .footer {
            margin-top: auto;
            background: #0f172a;
            color: #94a3b8;
            padding: 1.5rem 0;
        }
    </style>
</head>
<body>

    <!-- Navegación Superior -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm py-2">
        <div class="container-fluid px-lg-4">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= base_url('/') ?>">
                <i class="bi bi-diagram-3-fill text-primary fs-4"></i>
                <span>SisInfo <span class="badge bg-primary fs-6">MVC</span></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
                    <li class="nav-item">
                        <a class="nav-link <?= (current_url() == base_url('/') || current_url() == base_url('/index.php')) ? 'active' : '' ?>" href="<?= base_url('/') ?>">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(current_url(), 'personas') !== false ? 'active' : '' ?>" href="<?= base_url('personas') ?>">
                            <i class="bi bi-people-fill me-1"></i> Personas
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(current_url(), 'telefonos') !== false ? 'active' : '' ?>" href="<?= base_url('telefonos') ?>">
                            <i class="bi bi-telephone-fill me-1"></i> Teléfonos
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(current_url(), 'direcciones') !== false ? 'active' : '' ?>" href="<?= base_url('direcciones') ?>">
                            <i class="bi bi-geo-alt-fill me-1"></i> Direcciones
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle <?= (strpos(current_url(), 'sexos') !== false || strpos(current_url(), 'estados-civiles') !== false || strpos(current_url(), 'generos') !== false) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-collection-fill me-1"></i> Catálogos
                        </a>
                        <ul class="dropdown-menu shadow">
                            <li><a class="dropdown-item" href="<?= base_url('sexos') ?>"><i class="bi bi-gender-ambiguous me-2 text-primary"></i> Sexo Biológico</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('estados-civiles') ?>"><i class="bi bi-heart-half me-2 text-danger"></i> Estado Civil</a></li>
                            <li><a class="dropdown-item" href="<?= base_url('generos') ?>"><i class="bi bi-rainbow me-2 text-warning"></i> Género</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= strpos(current_url(), 'scrum') !== false ? 'active' : '' ?>" href="<?= base_url('scrum') ?>">
                            <i class="bi bi-kanban me-1 text-info"></i> Metodología Scrum
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-secondary-subtle text-light border border-secondary px-3 py-2">
                        <i class="bi bi-code-slash text-warning me-1"></i> CodeIgniter 4
                    </span>
                    <a href="<?= base_url('personas/new') ?>" class="btn btn-sm btn-primary">
                        <i class="bi bi-person-plus-fill me-1"></i> + Nueva Persona
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <main class="container-fluid px-lg-4 py-4 flex-grow-1">

        <!-- Mensajes Flash de Retroalimentación -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
                <i class="bi bi-check-circle-fill fs-5 me-2"></i>
                <div><?= session()->getFlashdata('success') ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill fs-5 me-2"></i>
                <div><?= session()->getFlashdata('error') ?></div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-warning alert-dismissible fade show shadow-sm" role="alert">
                <div class="d-flex align-items-center mb-1">
                    <i class="bi bi-exclamation-octagon-fill fs-5 me-2"></i>
                    <strong>Por favor corrija los siguientes errores:</strong>
                </div>
                <ul class="mb-0 ps-4">
                    <?php foreach (session()->getFlashdata('errors') as $error): ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- Sección de Contenido Inyectado -->
        <?= $this->renderSection('content') ?>

    </main>

    <!-- Modal Universal de Confirmación de Eliminación -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel"><i class="bi bi-trash3-fill me-2"></i>Confirmar Eliminación</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p class="mb-1" id="deleteModalMessage">¿Está seguro de que desea eliminar este registro?</p>
                    <p class="text-danger small fw-semibold mb-0"><i class="bi bi-exclamation-circle me-1"></i>Esta acción no se puede deshacer.</p>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="deleteConfirmBtn" class="btn btn-danger">Sí, Eliminar Registro</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de Página -->
    <footer class="footer">
        <div class="container-fluid px-lg-4">
            <div class="row align-items-center">
                <div class="col-md-6 text-center text-md-start mb-2 mb-md-0">
                    <p class="mb-0">
                        <i class="bi bi-mortarboard-fill text-primary me-1"></i>
                        <strong>Sistema de Información Web</strong> &copy; <?= date('Y') ?> | Arquitectura MVC en CodeIgniter 4
                    </p>
                    <small class="text-secondary">Entidades: Persona, Sexo, Dirección, Estado Civil, Género, Teléfono</small>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <span class="badge bg-dark-subtle border border-secondary text-light px-3 py-2">
                        <i class="bi bi-kanban-fill text-info me-1"></i> Metodología Ágil Scrum
                    </span>
                    <a href="<?= base_url('scrum') ?>" class="btn btn-sm btn-outline-light ms-2">
                        <i class="bi bi-journal-text me-1"></i> Ver Plan de Scrum
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5.3 Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        // Manejador del modal de eliminación seguro
        const deleteModal = document.getElementById('deleteModal');
        if (deleteModal) {
            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const url = button.getAttribute('data-url');
                const name = button.getAttribute('data-name') || 'este registro';
                
                const modalMessage = deleteModal.querySelector('#deleteModalMessage');
                const confirmBtn = deleteModal.querySelector('#deleteConfirmBtn');
                
                modalMessage.textContent = `¿Está seguro de que desea eliminar a "${name}"?`;
                confirmBtn.setAttribute('href', url);
            });
        }
    </script>
</body>
</html>
