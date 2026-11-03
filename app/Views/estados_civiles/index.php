<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold text-dark mb-1">
            <i class="bi bi-heart-half text-danger me-2"></i>Catálogo: Estado Civil
        </h2>
        <p class="text-muted mb-0">Gestión de estados civiles disponibles para asociar al perfil de las personas.</p>
    </div>
    <a href="<?= base_url('estados-civiles/new') ?>" class="btn btn-danger">
        <i class="bi bi-plus-circle-fill me-1"></i> Nuevo Estado Civil
    </a>
</div>

<div class="card">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0 text-dark">Listado de Registros</h6>
        <span class="badge bg-secondary-subtle text-dark border">Total: <?= count($estadosCiviles) ?></span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th style="width: 120px;" class="text-center">Estado</th>
                    <th style="width: 150px;" class="text-end">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($estadosCiviles)): ?>
                    <?php foreach ($estadosCiviles as $item): ?>
                        <tr>
                            <td><span class="text-muted fw-bold">#<?= $item['id'] ?></span></td>
                            <td class="fw-semibold text-dark"><?= esc($item['nombre']) ?></td>
                            <td><?= esc($item['descripcion'] ?: 'Sin descripción') ?></td>
                            <td class="text-center">
                                <?php if ($item['estado'] == 1): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <a href="<?= base_url('estados-civiles/' . $item['id'] . '/edit') ?>" class="btn btn-outline-warning" title="Editar">
                                        <i class="bi bi-pencil-square"></i> Editar
                                    </a>
                                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-url="<?= base_url('estados-civiles/' . $item['id'] . '/delete') ?>" data-name="<?= esc($item['nombre']) ?>" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            No hay estados civiles registrados.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
