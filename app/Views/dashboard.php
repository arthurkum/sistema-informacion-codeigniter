<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">
            <i class="bi bi-speedometer2 text-primary me-2"></i>Panel de Control
        </h2>
        <p class="text-muted mb-0">Sistema de información web desarrollado con CodeIgniter 4 bajo el patrón MVC y metodología Scrum.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('personas/new') ?>" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i> Registrar Persona
        </a>
        <a href="<?= base_url('scrum') ?>" class="btn btn-outline-dark">
            <i class="bi bi-kanban me-1"></i> Panel Scrum
        </a>
    </div>
</div>

<!-- Tarjetas de Métricas Principales -->
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-4">
        <div class="card stat-card primary p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Total Personas</span>
                    <h2 class="fw-bold text-primary mb-0"><?= esc($stats['total_personas']) ?></h2>
                    <small class="text-muted">Entidad Principal del Sistema</small>
                </div>
                <div class="rounded-circle bg-primary-subtle p-3 text-primary fs-3">
                    <i class="bi bi-people-fill"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top">
                <a href="<?= base_url('personas') ?>" class="text-primary small text-decoration-none fw-semibold">
                    Ver listado completo <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="card stat-card success p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Teléfonos Registrados</span>
                    <h2 class="fw-bold text-success mb-0"><?= esc($stats['total_telefonos']) ?></h2>
                    <small class="text-muted">Líneas fijas, móviles y WhatsApp</small>
                </div>
                <div class="rounded-circle bg-success-subtle p-3 text-success fs-3">
                    <i class="bi bi-telephone-fill"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top">
                <a href="<?= base_url('telefonos') ?>" class="text-success small text-decoration-none fw-semibold">
                    Gestionar teléfonos <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-4">
        <div class="card stat-card info p-3 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <span class="text-muted small text-uppercase fw-bold">Direcciones Físicas</span>
                    <h2 class="fw-bold text-info mb-0"><?= esc($stats['total_direcciones']) ?></h2>
                    <small class="text-muted">Residencia, trabajo y correspondencia</small>
                </div>
                <div class="rounded-circle bg-info-subtle p-3 text-info fs-3">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
            </div>
            <div class="mt-3 pt-2 border-top">
                <a href="<?= base_url('direcciones') ?>" class="text-info small text-decoration-none fw-semibold">
                    Gestionar direcciones <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Distribuciones y Catálogos -->
<div class="row g-4 mb-4">
    <!-- Distribución por Sexo -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-gender-ambiguous text-primary me-2"></i>Por Sexo Biológico
                </h6>
                <a href="<?= base_url('sexos') ?>" class="btn btn-sm btn-outline-primary py-0 px-2">CRUD</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php if (!empty($stats['por_sexo'])): ?>
                        <?php foreach ($stats['por_sexo'] as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                <span><?= esc($item['nombre']) ?></span>
                                <span class="badge bg-primary rounded-pill"><?= esc($item['total']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-muted text-center py-3">Sin registros</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Distribución por Género -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-rainbow text-warning me-2"></i>Por Identidad de Género
                </h6>
                <a href="<?= base_url('generos') ?>" class="btn btn-sm btn-outline-warning py-0 px-2 text-dark">CRUD</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php if (!empty($stats['por_genero'])): ?>
                        <?php foreach ($stats['por_genero'] as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                <span><?= esc($item['nombre']) ?></span>
                                <span class="badge bg-warning text-dark rounded-pill"><?= esc($item['total']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-muted text-center py-3">Sin registros</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>

    <!-- Distribución por Estado Civil -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-heart-half text-danger me-2"></i>Por Estado Civil
                </h6>
                <a href="<?= base_url('estados-civiles') ?>" class="btn btn-sm btn-outline-danger py-0 px-2">CRUD</a>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <?php if (!empty($stats['por_estado_civil'])): ?>
                        <?php foreach ($stats['por_estado_civil'] as $item): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                <span><?= esc($item['nombre']) ?></span>
                                <span class="badge bg-danger rounded-pill"><?= esc($item['total']) ?></span>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="list-group-item text-muted text-center py-3">Sin registros</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Últimas Personas Registradas -->
<div class="card mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0 text-dark">
                <i class="bi bi-person-lines-fill text-primary me-2"></i>Personas Registradas Recientemente
            </h5>
            <small class="text-muted">Vista rápida de personas con sus entidades asociadas</small>
        </div>
        <a href="<?= base_url('personas') ?>" class="btn btn-sm btn-outline-primary">
            Ver todas las personas <i class="bi bi-arrow-right"></i>
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Documento</th>
                    <th>Nombres y Apellidos</th>
                    <th>Correo Electrónico</th>
                    <th>Sexo</th>
                    <th>Estado Civil</th>
                    <th>Género</th>
                    <th class="text-center">Contactos</th>
                    <th class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($ultimasPersonas)): ?>
                    <?php foreach ($ultimasPersonas as $persona): ?>
                        <tr>
                            <td>
                                <span class="badge bg-secondary me-1"><?= esc($persona['tipo_documento']) ?></span>
                                <strong><?= esc($persona['numero_documento']) ?></strong>
                            </td>
                            <td>
                                <a href="<?= base_url('personas/' . $persona['id']) ?>" class="text-decoration-none fw-semibold text-dark">
                                    <?= esc($persona['nombres'] . ' ' . $persona['apellidos']) ?>
                                </a>
                            </td>
                            <td><?= esc($persona['correo_electronico']) ?></td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                    <?= esc($persona['sexo_nombre'] ?? 'N/A') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                    <?= esc($persona['estado_civil_nombre'] ?? 'N/A') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                    <?= esc($persona['genero_nombre'] ?? 'N/A') ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success-subtle text-success me-1" title="Teléfonos registrados">
                                    <i class="bi bi-telephone"></i> <?= $persona['total_telefonos'] ?>
                                </span>
                                <span class="badge bg-info-subtle text-info" title="Direcciones registradas">
                                    <i class="bi bi-geo-alt"></i> <?= $persona['total_direcciones'] ?>
                                </span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= base_url('personas/' . $persona['id']) ?>" class="btn btn-outline-info" title="Ver Detalle / Perfil">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="<?= base_url('personas/' . $persona['id'] . '/edit') ?>" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?= base_url('personas/' . $persona['id'] . '/delete') ?>" data-name="<?= esc($persona['nombres'] . ' ' . $persona['apellidos']) ?>" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                            No hay personas registradas aún. ¡Comience creando la primera!
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
