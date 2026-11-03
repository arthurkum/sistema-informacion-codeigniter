<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">
            <i class="bi bi-geo-alt-fill text-info me-2"></i>Gestión de Direcciones Físicas
        </h2>
        <p class="text-muted mb-0">Control de domicilios asociados a cada persona en el sistema.</p>
    </div>
    <a href="<?= base_url('direcciones/new') ?>" class="btn btn-info text-white">
        <i class="bi bi-plus-circle-fill me-1"></i> Nueva Dirección
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0 text-dark">Listado General de Direcciones</h6>
        <span class="badge bg-secondary-subtle text-dark border">Total: <?= count($direcciones) ?></span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Persona Vinculada</th>
                    <th>Tipo</th>
                    <th>Dirección Física</th>
                    <th>Barrio / Sector</th>
                    <th>Ciudad y Departamento</th>
                    <th class="text-center">Principal</th>
                    <th style="width: 150px;" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($direcciones)): ?>
                    <?php foreach ($direcciones as $dir): ?>
                        <tr>
                            <td><span class="text-muted fw-bold">#<?= $dir['id'] ?></span></td>
                            <td>
                                <a href="<?= base_url('personas/' . $dir['persona_id']) ?>" class="fw-semibold text-dark text-decoration-none">
                                    <?= esc($dir['nombres'] . ' ' . $dir['apellidos']) ?>
                                </a>
                                <br>
                                <small class="text-muted"><?= esc($dir['tipo_documento']) ?>: <?= esc($dir['numero_documento']) ?></small>
                            </td>
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
                                    <a href="<?= base_url('direcciones/' . $dir['id'] . '/edit') ?>" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?= base_url('direcciones/' . $dir['id'] . '/delete') ?>" data-name="Dirección <?= esc($dir['direccion']) ?>" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-5">
                            <i class="bi bi-geo-alt fs-1 d-block mb-2 text-secondary"></i>
                            No hay direcciones registradas actualmente.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
