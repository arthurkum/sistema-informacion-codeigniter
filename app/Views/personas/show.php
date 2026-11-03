<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <div class="d-flex align-items-center gap-2">
            <h2 class="fw-bold text-dark mb-0">
                <?= esc($persona['nombres'] . ' ' . $persona['apellidos']) ?>
            </h2>
            <?php if ($persona['estado'] == 1): ?>
                <span class="badge bg-success-subtle text-success border border-success-subtle">Activo</span>
            <?php else: ?>
                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inactivo</span>
            <?php endif; ?>
        </div>
        <p class="text-muted mb-0">Perfil de persona y gestión de sus entidades relacionadas (Direcciones y Teléfonos).</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('personas/' . $persona['id'] . '/edit') ?>" class="btn btn-warning">
            <i class="bi bi-pencil-square me-1"></i> Editar Persona
        </a>
        <a href="<?= base_url('personas') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Listado General
        </a>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Tarjeta de Información Personal -->
    <div class="col-lg-4">
        <div class="card h-100 shadow-sm">
            <div class="card-header bg-white py-3 border-bottom">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-person-badge-fill text-primary me-2"></i>Información Personal
                </h5>
            </div>
            <div class="card-body">
                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle mb-2" style="width: 80px; height: 80px; font-size: 2.2rem;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h5 class="fw-bold text-dark mb-0"><?= esc($persona['nombres'] . ' ' . $persona['apellidos']) ?></h5>
                    <span class="badge bg-secondary"><?= esc($persona['tipo_documento']) ?>: <?= esc($persona['numero_documento']) ?></span>
                </div>

                <ul class="list-group list-group-flush small">
                    <li class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span class="text-muted"><i class="bi bi-envelope me-1"></i> Correo:</span>
                        <strong class="text-dark"><?= esc($persona['correo_electronico']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span class="text-muted"><i class="bi bi-calendar3 me-1"></i> Fecha Nacimiento:</span>
                        <strong><?= esc($persona['fecha_nacimiento']) ?></strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span class="text-muted"><i class="bi bi-hourglass-split me-1"></i> Edad Calculada:</span>
                        <?php
                            $nac = new DateTime($persona['fecha_nacimiento']);
                            $hoy = new DateTime();
                            $edad = $hoy->diff($nac)->y;
                        ?>
                        <span class="badge bg-info-subtle text-info border border-info-subtle"><?= $edad ?> años</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span class="text-muted"><i class="bi bi-gender-ambiguous me-1"></i> Sexo Biológico:</span>
                        <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                            <?= esc($persona['sexo_nombre'] ?? 'N/D') ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span class="text-muted"><i class="bi bi-heart me-1"></i> Estado Civil:</span>
                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                            <?= esc($persona['estado_civil_nombre'] ?? 'N/D') ?>
                        </span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between px-0 py-2">
                        <span class="text-muted"><i class="bi bi-rainbow me-1"></i> Identidad Género:</span>
                        <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                            <?= esc($persona['genero_nombre'] ?? 'N/D') ?>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-light border-top text-center py-2">
                <small class="text-muted">ID Sistema: #<?= $persona['id'] ?> | Registrado el <?= substr($persona['created_at'], 0, 10) ?></small>
            </div>
        </div>
    </div>

    <!-- Gestión de Teléfonos y Direcciones de esta Persona -->
    <div class="col-lg-8">
        <!-- Sub-bloque: Teléfonos Vinculados -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-telephone-fill text-success me-2"></i>Teléfonos Asociados
                </h5>
                <a href="<?= base_url('telefonos/new?persona_id=' . $persona['id']) ?>" class="btn btn-sm btn-success">
                    <i class="bi bi-plus-circle me-1"></i> Agregar Teléfono
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Tipo</th>
                            <th>Indicativo</th>
                            <th>Número Telefónico</th>
                            <th class="text-center">Principal</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($telefonos)): ?>
                            <?php foreach ($telefonos as $tel): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-dark border">
                                            <?= esc($tel['tipo_telefono']) ?>
                                        </span>
                                    </td>
                                    <td><span class="text-muted"><?= esc($tel['indicativo']) ?></span></td>
                                    <td><strong><?= esc($tel['numero']) ?></strong></td>
                                    <td class="text-center">
                                        <?php if ($tel['es_principal'] == 1): ?>
                                            <span class="badge bg-success"><i class="bi bi-star-fill me-1"></i> Principal</span>
                                        <?php else: ?>
                                            <span class="text-muted small">Secundario</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= base_url('telefonos/' . $tel['id'] . '/edit') ?>" class="btn btn-outline-warning" title="Editar teléfono">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?= base_url('telefonos/' . $tel['id'] . '/delete?volver=persona') ?>" data-name="Teléfono <?= esc($tel['numero']) ?>" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">
                                    <i class="bi bi-telephone-x fs-4 d-block mb-1 text-secondary"></i>
                                    No hay teléfonos vinculados a esta persona.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Sub-bloque: Direcciones Físicas Vinculadas -->
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-geo-alt-fill text-info me-2"></i>Direcciones Físicas Asociadas
                </h5>
                <a href="<?= base_url('direcciones/new?persona_id=' . $persona['id']) ?>" class="btn btn-sm btn-info text-white">
                    <i class="bi bi-plus-circle me-1"></i> Agregar Dirección
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light small">
                        <tr>
                            <th>Tipo</th>
                            <th>Dirección</th>
                            <th>Barrio / Sector</th>
                            <th>Ciudad / Región</th>
                            <th class="text-center">Principal</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($direcciones)): ?>
                            <?php foreach ($direcciones as $dir): ?>
                                <tr>
                                    <td>
                                        <span class="badge bg-secondary-subtle text-dark border">
                                            <?= esc($dir['tipo_direccion']) ?>
                                        </span>
                                    </td>
                                    <td><strong><?= esc($dir['direccion']) ?></strong></td>
                                    <td><?= esc($dir['barrio'] ?: 'N/D') ?></td>
                                    <td><?= esc($dir['ciudad']) ?>, <?= esc($dir['departamento_estado']) ?></td>
                                    <td class="text-center">
                                        <?php if ($dir['es_principal'] == 1): ?>
                                            <span class="badge bg-info"><i class="bi bi-check-circle-fill me-1"></i> Principal</span>
                                        <?php else: ?>
                                            <span class="text-muted small">Secundaria</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= base_url('direcciones/' . $dir['id'] . '/edit') ?>" class="btn btn-outline-warning" title="Editar dirección">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?= base_url('direcciones/' . $dir['id'] . '/delete?volver=persona') ?>" data-name="Dirección <?= esc($dir['direccion']) ?>" title="Eliminar">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">
                                    <i class="bi bi-geo-alt fs-4 d-block mb-1 text-secondary"></i>
                                    No hay direcciones domiciliarias registradas para esta persona.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

