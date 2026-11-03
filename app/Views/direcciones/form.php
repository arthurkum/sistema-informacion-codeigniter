<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-geo-alt-fill text-info me-2"></i><?= esc($titulo) ?>
                </h3>
                <p class="text-muted mb-0"><?= $direccion ? 'Actualice la información de la dirección física.' : 'Complete el formulario para asociar una dirección a una persona.' ?></p>
            </div>
            <a href="<?= base_url('direcciones') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver al listado
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="<?= $direccion ? base_url('direcciones/' . $direccion['id']) : base_url('direcciones') ?>" method="post">
                    <?= csrf_field() ?>

                    <?php if ($selectedPersonaId): ?>
                        <input type="hidden" name="origen" value="persona">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="persona_id" class="form-label fw-semibold">Persona Vinculada <span class="text-danger">*</span></label>
                        <select class="form-select" id="persona_id" name="persona_id" required>
                            <option value="">-- Seleccionar Persona --</option>
                            <?php foreach ($personas as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= old('persona_id', $direccion['persona_id'] ?? $selectedPersonaId) == $p['id'] ? 'selected' : '' ?>>
                                    <?= esc($p['nombres'] . ' ' . $p['apellidos']) ?> (<?= esc($p['tipo_documento']) ?>: <?= esc($p['numero_documento']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="tipo_direccion" class="form-label fw-semibold">Tipo de Dirección <span class="text-danger">*</span></label>
                            <select class="form-select" id="tipo_direccion" name="tipo_direccion" required>
                                <?php
                                    $tipos = ['Residencia', 'Trabajo', 'Fiscal', 'Correspondencia', 'Familiar', 'Otra'];
                                    $tipoActual = old('tipo_direccion', $direccion['tipo_direccion'] ?? 'Residencia');
                                    foreach ($tipos as $t):
                                ?>
                                    <option value="<?= $t ?>" <?= $tipoActual == $t ? 'selected' : '' ?>><?= $t ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="codigo_postal" class="form-label fw-semibold">Código Postal</label>
                            <input type="text" class="form-control" id="codigo_postal" name="codigo_postal" value="<?= old('codigo_postal', $direccion['codigo_postal'] ?? '') ?>" placeholder="Ej: 050031" maxlength="20">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="direccion" class="form-label fw-semibold">Dirección Física Completa <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="direccion" name="direccion" value="<?= old('direccion', $direccion['direccion'] ?? '') ?>" placeholder="Ej: Calle 45 # 12-34 Apto 502" required minlength="4" maxlength="255">
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="barrio" class="form-label fw-semibold">Barrio / Sector</label>
                            <input type="text" class="form-control" id="barrio" name="barrio" value="<?= old('barrio', $direccion['barrio'] ?? '') ?>" placeholder="Ej: Laureles" maxlength="100">
                        </div>
                        <div class="col-md-4">
                            <label for="ciudad" class="form-label fw-semibold">Ciudad / Municipio <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?= old('ciudad', $direccion['ciudad'] ?? '') ?>" placeholder="Ej: Medellín" required minlength="2" maxlength="100">
                        </div>
                        <div class="col-md-4">
                            <label for="departamento_estado" class="form-label fw-semibold">Departamento / Estado <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="departamento_estado" name="departamento_estado" value="<?= old('departamento_estado', $direccion['departamento_estado'] ?? '') ?>" placeholder="Ej: Antioquia" required minlength="2" maxlength="100">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="es_principal" name="es_principal" value="1" <?= old('es_principal', $direccion['es_principal'] ?? 0) == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label fw-semibold" for="es_principal">Marcar como Dirección Principal de la Persona</label>
                        </div>
                        <div class="form-text">Si se marca, reemplazará cualquier otra dirección principal asignada previamente a esta persona.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="<?= $selectedPersonaId ? base_url('personas/' . $selectedPersonaId) : base_url('direcciones') ?>" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-info text-white px-4">
                            <i class="bi bi-save2 me-1"></i> Guardar Dirección
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

