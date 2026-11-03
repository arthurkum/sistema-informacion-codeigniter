<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-gender-ambiguous text-primary me-2"></i><?= esc($titulo) ?>
                </h3>
                <p class="text-muted mb-0"><?= $sexo ? 'Actualice la información del registro de sexo.' : 'Complete el formulario para registrar un nuevo sexo.' ?></p>
            </div>
            <a href="<?= base_url('sexos') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver al listado
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="<?= $sexo ? base_url('sexos/' . $sexo['id']) : base_url('sexos') ?>" method="post">
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label for="nombre" class="form-label fw-semibold">Nombre del Sexo <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nombre" name="nombre" value="<?= old('nombre', $sexo['nombre'] ?? '') ?>" placeholder="Ej: Masculino, Femenino, Intersexual" required minlength="3" maxlength="50">
                        <div class="form-text">Debe ser un nombre único descriptivo.</div>
                    </div>

                    <div class="mb-3">
                        <label for="abreviatura" class="form-label fw-semibold">Abreviatura / Código</label>
                        <input type="text" class="form-control" id="abreviatura" name="abreviatura" value="<?= old('abreviatura', $sexo['abreviatura'] ?? '') ?>" placeholder="Ej: M, F, I" maxlength="10">
                        <div class="form-text">Abreviatura corta para representaciones compactas.</div>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label fw-semibold">Descripción</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción adicional o definición conceptual..." maxlength="255"><?= old('descripcion', $sexo['descripcion'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" value="1" <?= old('estado', $sexo['estado'] ?? 1) == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label fw-semibold" for="estado">Registro Activo</label>
                        </div>
                        <div class="form-text">Si se desactiva, no aparecerá en los nuevos registros de persona.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="<?= base_url('sexos') ?>" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2 me-1"></i> Guardar Registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

