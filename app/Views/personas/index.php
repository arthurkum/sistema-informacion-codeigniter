<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">
            <i class="bi bi-people-fill text-primary me-2"></i>Gestión de Personas
        </h2>
        <p class="text-muted mb-0">Entidad central del sistema vinculada con Sexo, Estado Civil, Género, Direcciones y Teléfonos.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?= base_url('personas/new') ?>" class="btn btn-primary">
            <i class="bi bi-person-plus-fill me-1"></i> Registrar Persona
        </a>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0 text-dark">
            <i class="bi bi-table me-2 text-secondary"></i>Listado General de Personas
        </h6>
        <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3 py-2">
            Total Registros: <?= count($personas) ?>
        </span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Documento</th>
                    <th>Nombres y Apellidos</th>
                    <th>Correo Electrónico</th>
                    <th>Sexo</th>
                    <th>Estado Civil</th>
                    <th>Género</th>
                    <th class="text-center">Contactos</th>
                    <th style="width: 170px;" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($personas)): ?>
                    <?php foreach ($personas as $persona): ?>
                        <tr>
                            <td><span class="text-muted fw-bold">#<?= $persona['id'] ?></span></td>
                            <td>
                                <span class="badge bg-secondary me-1"><?= esc($persona['tipo_documento']) ?></span>
                                <strong><?= esc($persona['numero_documento']) ?></strong>
                            </td>
                            <td>
                                <a href="<?= base_url('personas/' . $persona['id']) ?>" class="fw-semibold text-dark text-decoration-none">
                                    <?= esc($persona['nombres'] . ' ' . $persona['apellidos']) ?>
                                </a>
                            </td>
                            <td class="text-muted small"><?= esc($persona['correo_electronico']) ?></td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                    <?= esc($persona['sexo_nombre'] ?? 'N/D') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                    <?= esc($persona['estado_civil_nombre'] ?? 'N/D') ?>
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">
                                    <?= esc($persona['genero_nombre'] ?? 'N/D') ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="<?= base_url('personas/' . $persona['id']) ?>" class="text-decoration-none me-1" title="Teléfonos registrados">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                                        <i class="bi bi-telephone"></i> <?= $persona['total_telefonos'] ?>
                                    </span>
                                </a>
                                <a href="<?= base_url('personas/' . $persona['id']) ?>" class="text-decoration-none" title="Direcciones registradas">
                                    <span class="badge bg-info-subtle text-info border border-info-subtle">
                                        <i class="bi bi-geo-alt"></i> <?= $persona['total_direcciones'] ?>
                                    </span>
                                </a>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= base_url('personas/' . $persona['id']) ?>" class="btn btn-outline-info" title="Ver Perfil y Relaciones">
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
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="bi bi-people fs-1 d-block mb-2 text-secondary"></i>
                            No hay personas registradas en el sistema.
                            <div class="mt-2">
                                <a href="<?= base_url('personas/new') ?>" class="btn btn-sm btn-primary">Registrar la primera persona</a>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
