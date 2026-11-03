<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-telephone-fill text-success me-2"></i><?= esc($titulo) ?>
                </h3>
                <p class="text-muted mb-0"><?= $telefono ? 'Actualice la información del número telefónico.' : 'Complete el formulario para vincular un teléfono a una persona.' ?></p>
            </div>
            <a href="<?= base_url('telefonos') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver al listado
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="<?= $telefono ? base_url('telefonos/' . $telefono['id']) : base_url('telefonos') ?>" method="post">
                    <?= csrf_field() ?>

                    <?php if ($selectedPersonaId): ?>
                        <input type="hidden" name="origen" value="persona">
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="persona_id" class="form-label fw-semibold">Persona Vinculada <span class="text-danger">*</span></label>
                        <select class="form-select" id="persona_id" name="persona_id" required>
                            <option value="">-- Seleccionar Persona --</option>
                            <?php foreach ($personas as $p): ?>
                                <option value="<?= $p['id'] ?>" <?= old('persona_id', $telefono['persona_id'] ?? $selectedPersonaId) == $p['id'] ? 'selected' : '' ?>>
                                    <?= esc($p['nombres'] . ' ' . $p['apellidos']) ?> (<?= esc($p['tipo_documento']) ?>: <?= esc($p['numero_documento']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="tipo_telefono" class="form-label fw-semibold">Tipo de Línea / Teléfono <span class="text-danger">*</span></label>
                        <select class="form-select" id="tipo_telefono" name="tipo_telefono" required>
                            <?php
                                $tipos = ['Móvil', 'WhatsApp', 'Fijo Residencial', 'Oficina / Trabajo', 'Familiar', 'Otro'];
                                $tipoActual = old('tipo_telefono', $telefono['tipo_telefono'] ?? 'Móvil');
                                foreach ($tipos as $t):
                            ?>
                                <option value="<?= $t ?>" <?= $tipoActual == $t ? 'selected' : '' ?>><?= $t ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="indicativo" class="form-label fw-semibold">Indicativo País</label>
                            <input type="text" class="form-control" id="indicativo" name="indicativo" value="<?= old('indicativo', $telefono['indicativo'] ?? '+57') ?>" placeholder="+57" maxlength="10">
                        </div>
                        <div class="col-md-8">
                            <label for="numero" class="form-label fw-semibold">Número Telefónico <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="numero" name="numero" value="<?= old('numero', $telefono['numero'] ?? '') ?>" placeholder="Ej: 3001234567 o 6044445555" required minlength="6" maxlength="30">
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="es_principal" name="es_principal" value="1" <?= old('es_principal', $telefono['es_principal'] ?? 0) == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label fw-semibold" for="es_principal">Marcar como Teléfono Principal de la Persona</label>
                        </div>
                        <div class="form-text">Si se marca, se convertirá en el contacto principal predeterminado de la persona.</div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="<?= $selectedPersonaId ? base_url('personas/' . $selectedPersonaId) : base_url('telefonos') ?>" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-success px-4">
                            <i class="bi bi-save2 me-1"></i> Guardar Teléfono
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

