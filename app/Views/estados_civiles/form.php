<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-heart-half text-danger me-2"></i><?= esc($titulo) ?>
                </h3>
                <p class="text-muted mb-0"><?= $estadoCivil ? 'Actualice la información del estado civil.' : 'Complete el formulario para registrar un nuevo estado civil.' ?></p>
            </div>
            <a href="<?= base_url('estados-civiles') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver al listado
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="<?= $estadoCivil ? base_url('estados-civiles/' . $estadoCivil['id']) : base_url('estados-civiles') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold">Nombre del Estado Civil <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre', $estadoCivil['nombre'] ?? '') ?>" placeholder="Ej: Soltero(a), Casado(a), Unión Libre" required minlength="3" maxlength="50">
                        <div class="form-text">Nombre descriptivo único.</div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Detalles legales o conceptuales del estado civil..." maxlength="255"><?= old('descripcion', $estadoCivil['descripcion'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" value="1" <?= old('estado', $estadoCivil['estado'] ?? 1) == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label fw-semibold" for="estado">Registro Activo</label>
                        </div>
                        <div class="form-text">Si se desactiva, no aparecerá en los nuevos registros de persona.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="<?= base_url('estados-civiles') ?>" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="bi bi-save2 me-1"></i> Guardar Registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
