<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">
            <i class="bi bi-telephone-fill text-success me-2"></i>Gestión de Teléfonos
        </h2>
        <p class="text-muted mb-0">Control de números de contacto y líneas de comunicación vinculadas a cada persona.</p>
    </div>
    <a href="<?= base_url('telefonos/new') ?>" class="btn btn-success">
        <i class="bi bi-plus-circle-fill me-1"></i> Nuevo Teléfono
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0 text-dark">Listado General de Teléfonos</h6>
        <span class="badge bg-secondary-subtle text-dark border">Total: <?= count($telefonos) ?></span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Persona Vinculada</th>
                    <th>Tipo</th>
                    <th>Indicativo</th>
                    <th>Número Telefónico</th>
                    <th class="text-center">Principal</th>
                    <th style="width: 150px;" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($telefonos)): ?>
                    <?php foreach ($telefonos as $tel): ?>
                        <tr>
                            <td><span class="text-muted fw-bold">#<?= $tel['id'] ?></span></td>
                            <td>
                                <a href="<?= base_url('personas/' . $tel['persona_id']) ?>" class="fw-semibold text-dark text-decoration-none">
                                    <?= esc($tel['nombres'] . ' ' . $tel['apellidos']) ?>
                                </a>
                                <br>
                                <small class="text-muted"><?= esc($tel['tipo_documento']) ?>: <?= esc($tel['numero_documento']) ?></small>
                            </td>
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
                                    <a href="<?= base_url('telefonos/' . $tel['id'] . '/edit') ?>" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?= base_url('telefonos/' . $tel['id'] . '/delete') ?>" data-name="Teléfono <?= esc($tel['numero']) ?>" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="bi bi-telephone-x fs-1 d-block mb-2 text-secondary"></i>
                            No hay teléfonos registrados en este momento.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

