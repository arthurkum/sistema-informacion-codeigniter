<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-person-fill text-primary me-2"></i><?= esc($titulo) ?>
                </h3>
                <p class="text-muted mb-0"><?= $persona ? 'Modifique los datos personales y catálogos vinculados.' : 'Diligencie todos los campos requeridos para dar de alta a la persona.' ?></p>
            </div>
            <a href="<?= base_url('personas') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i> Volver al listado
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="<?= $persona ? base_url('personas/' . $persona['id']) : base_url('personas') ?>" method="post">
                    <?= csrf_field() ?>

                    <h5 class="fw-bold text-secondary mb-3 border-bottom pb-2">
                        <i class="bi bi-card-text me-1"></i> 1. Identificación y Datos Personales
                    </h5>

                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label for="tipo_documento" class="form-label fw-semibold">Tipo Documento <span class="text-danger">*</span></label>
                            <select class="form-select" id="tipo_documento" name="tipo_documento" required>
                                <?php
                                    $tipos = ['CC' => 'Cédula de Ciudadanía (CC)', 'TI' => 'Tarjeta de Identidad (TI)', 'CE' => 'Cédula de Extranjería (CE)', 'PASAPORTE' => 'Pasaporte', 'DNI' => 'DNI'];
                                    $tipoActual = old('tipo_documento', $persona['tipo_documento'] ?? 'CC');
                                    foreach ($tipos as $val => $label):
                                ?>
                                    <option value="<?= $val ?>" <?= $tipoActual == $val ? 'selected' : '' ?>><?= $label ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="numero_documento" class="form-label fw-semibold">Número de Documento <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="numero_documento" name="numero_documento" value="<?= old('numero_documento', $persona['numero_documento'] ?? '') ?>" placeholder="Ej: 1020304050" required minlength="4" maxlength="30">
                        </div>
                    </div>

                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="nombres" class="form-label fw-semibold">Nombres <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nombres" name="nombres" value="<?= old('nombres', $persona['nombres'] ?? '') ?>" placeholder="Ej: Carlos Andrés" required minlength="2" maxlength="100">
                        </div>
                        <div class="col-md-6">
                            <label for="apellidos" class="form-label fw-semibold">Apellidos <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?= old('apellidos', $persona['apellidos'] ?? '') ?>" placeholder="Ej: Gómez Restrepo" required minlength="2" maxlength="100">
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="fecha_nacimiento" class="form-label fw-semibold">Fecha de Nacimiento <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?= old('fecha_nacimiento', $persona['fecha_nacimiento'] ?? '') ?>" required max="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="correo_electronico" class="form-label fw-semibold">Correo Electrónico <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="correo_electronico" name="correo_electronico" value="<?= old('correo_electronico', $persona['correo_electronico'] ?? '') ?>" placeholder="ejemplo@correo.com" required maxlength="150">
                        </div>
                    </div>

                    <h5 class="fw-bold text-secondary mb-3 border-bottom pb-2">
                        <i class="bi bi-diagram-2 me-1"></i> 2. Relaciones con Catálogos del Sistema
                    </h5>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="sexo_id" class="form-label fw-semibold">Sexo Biológico <span class="text-danger">*</span></label>
                            <select class="form-select" id="sexo_id" name="sexo_id" required>
                                <option value="">-- Seleccionar Sexo --</option>
                                <?php foreach ($sexos as $s): ?>
                                    <option value="<?= $s['id'] ?>" <?= old('sexo_id', $persona['sexo_id'] ?? '') == $s['id'] ? 'selected' : '' ?>>
                                        <?= esc($s['nombre']) ?> (<?= esc($s['abreviatura'] ?: 'N/D') ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="estado_civil_id" class="form-label fw-semibold">Estado Civil <span class="text-danger">*</span></label>
                            <select class="form-select" id="estado_civil_id" name="estado_civil_id" required>
                                <option value="">-- Seleccionar Estado Civil --</option>
                                <?php foreach ($estadosCiviles as $ec): ?>
                                    <option value="<?= $ec['id'] ?>" <?= old('estado_civil_id', $persona['estado_civil_id'] ?? '') == $ec['id'] ? 'selected' : '' ?>>
                                        <?= esc($ec['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="genero_id" class="form-label fw-semibold">Identidad de Género <span class="text-danger">*</span></label>
                            <select class="form-select" id="genero_id" name="genero_id" required>
                                <option value="">-- Seleccionar Género --</option>
                                <?php foreach ($generos as $g): ?>
                                    <option value="<?= $g['id'] ?>" <?= old('genero_id', $persona['genero_id'] ?? '') == $g['id'] ? 'selected' : '' ?>>
                                        <?= esc($g['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="estado" name="estado" value="1" <?= old('estado', $persona['estado'] ?? 1) == 1 ? 'checked' : '' ?>>
                            <label class="form-check-label fw-semibold" for="estado">Persona Activa en el Sistema</label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="<?= base_url('personas') ?>" class="btn btn-light border">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-save2 me-1"></i> Guardar Persona
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
