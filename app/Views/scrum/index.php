<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold text-dark mb-1">
                <i class="bi bi-kanban-fill text-info me-2"></i>Gestión del Proyecto bajo Metodología Ágil Scrum
            </h2>
            <p class="text-muted mb-0">Organización del equipo, roles, historias de usuario, sprints, control de versiones y despliegue del sistema web.</p>
        </div>
        <a href="<?= base_url('/') ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i> Volver al Dashboard
        </a>
    </div>
</div>

<!-- 1. ROLES DEL EQUIPO SCRUM -->
<div class="card mb-4">
    <div class="card-header bg-white py-3 border-bottom">
        <h5 class="fw-bold mb-0 text-dark">
            <i class="bi bi-people text-primary me-2"></i>1. Distribución de Roles en el Scrum Team
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <span class="badge bg-primary mb-2">Rol Scrum</span>
                    <h5 class="fw-bold text-dark mb-1">Product Owner (PO)</h5>
                    <p class="text-muted small mb-3">Responsable de definir la visión del producto, maximizar el valor del software y priorizar el Product Backlog según las necesidades del negocio/docente.</p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> Definición de historias de usuario y criterios de aceptación.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> Priorización de los requerimientos CRUD.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> Validación final y aceptación de entregables en cada Sprint.</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <span class="badge bg-warning text-dark mb-2">Rol Scrum</span>
                    <h5 class="fw-bold text-dark mb-1">Scrum Master (SM)</h5>
                    <p class="text-muted small mb-3">Facilitador del equipo, garantiza la aplicación de las prácticas ágiles, remueve impedimentos y lidera las ceremonias de Scrum.</p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> Facilitación de Daily Scrums, Sprint Planning y Retrospectives.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> Monitoreo del flujo de trabajo y métricas de velocidad.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> Resolución de bloqueos técnicos y organizativos.</li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <span class="badge bg-info text-dark mb-2">Rol Scrum</span>
                    <h5 class="fw-bold text-dark mb-1">Development Team (Devs)</h5>
                    <p class="text-muted small mb-3">Equipo multifuncional encargado del diseño, codificación, pruebas y despliegue del sistema web bajo CodeIgniter 4 (MVC).</p>
                    <ul class="list-unstyled small mb-0">
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> <strong>Frontend:</strong> Vistas Bootstrap 5, responsividad, formularios y UX.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> <strong>Backend:</strong> Controladores, Modelos, Validaciones y Rutas CI4.</li>
                        <li><i class="bi bi-check-circle-fill text-success me-1"></i> <strong>Database/DevOps:</strong> Migraciones, seeders, Git y despliegue web.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 2. PRODUCT BACKLOG E HISTORIAS DE USUARIO -->
<div class="card mb-4">
    <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
        <div>
            <h5 class="fw-bold mb-0 text-dark">
                <i class="bi bi-list-check text-success me-2"></i>2. Product Backlog e Historias de Usuario (User Stories)
            </h5>
            <small class="text-muted">Requerimientos funcionales desglosados con estimación en Story Points y criterios de aceptación</small>
        </div>
        <span class="badge bg-success-subtle text-success border border-success-subtle px-3 py-2">Total: 34 Story Points</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width: 80px;">ID</th>
                    <th style="width: 250px;">Historia de Usuario</th>
                    <th>Criterios de Aceptación (Definición de Terminado)</th>
                    <th style="width: 100px;" class="text-center">Sprint</th>
                    <th style="width: 80px;" class="text-center">Puntos</th>
                    <th style="width: 110px;" class="text-center">Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>HU-01</strong></td>
                    <td>
                        <span class="fw-semibold">Configuración de Arquitectura MVC y BD</span><br>
                        <small class="text-muted">Como equipo, configurar CodeIgniter 4 y el esquema relacional para soportar las 6 entidades.</small>
                    </td>
                    <td class="small">
                        • Migraciones ejecutadas para sexos, estados civiles, géneros, personas, direcciones y teléfonos.<br>
                        • Claves primarias y foráneas con integridad referencial (CASCADE / RESTRICT).<br>
                        • Seeders ejecutados con datos iniciales coherentes.
                    </td>
                    <td class="text-center"><span class="badge bg-secondary">Sprint 1</span></td>
                    <td class="text-center fw-bold">5</td>
                    <td class="text-center"><span class="badge bg-success">Completado</span></td>
                </tr>
                <tr>
                    <td><strong>HU-02</strong></td>
                    <td>
                        <span class="fw-semibold">CRUD de Catálogo Sexo</span><br>
                        <small class="text-muted">Como administrador, gestionar los registros de sexo biológico con validación de unicidad.</small>
                    </td>
                    <td class="small">
                        • Crear, listar, editar y eliminar registros de sexo.<br>
                        • Bloqueo de eliminación si tiene personas asociadas.<br>
                        • Alertas de éxito y validación visibles.
                    </td>
                    <td class="text-center"><span class="badge bg-secondary">Sprint 2</span></td>
                    <td class="text-center fw-bold">3</td>
                    <td class="text-center"><span class="badge bg-success">Completado</span></td>
                </tr>
                <tr>
                    <td><strong>HU-03</strong></td>
                    <td>
                        <span class="fw-semibold">CRUD de Catálogo Estado Civil</span><br>
                        <small class="text-muted">Como usuario, gestionar opciones de estado civil con descripción y estado.</small>
                    </td>
                    <td class="small">
                        • Crear, listar, editar y eliminar estados civiles.<br>
                        • Prevenir eliminación accidental con confirmación modal.<br>
                        • Validación de longitud y obligatoriedad.
                    </td>
                    <td class="text-center"><span class="badge bg-secondary">Sprint 2</span></td>
                    <td class="text-center fw-bold">3</td>
                    <td class="text-center"><span class="badge bg-success">Completado</span></td>
                </tr>
                <tr>
                    <td><strong>HU-04</strong></td>
                    <td>
                        <span class="fw-semibold">CRUD de Catálogo Género</span><br>
                        <small class="text-muted">Como usuario, registrar y administrar las identidades de género con respeto a la inclusión.</small>
                    </td>
                    <td class="small">
                        • Crear, listar, editar y eliminar géneros.<br>
                        • Validación de nombres únicos en base de datos.<br>
                        • Protección de integridad con llaves foráneas.
                    </td>
                    <td class="text-center"><span class="badge bg-secondary">Sprint 2</span></td>
                    <td class="text-center fw-bold">3</td>
                    <td class="text-center"><span class="badge bg-success">Completado</span></td>
                </tr>
                <tr>
                    <td><strong>HU-05</strong></td>
                    <td>
                        <span class="fw-semibold">CRUD de la Entidad Persona</span><br>
                        <small class="text-muted">Como operador, registrar personas vinculándolas a sus respectivos sexo, estado civil y género.</small>
                    </td>
                    <td class="small">
                        • Formularios dinámicos con selects vinculados a tablas foráneas.<br>
                        • Validación de documento y correo único.<br>
                        • Vista de perfil detallado mostrando teléfonos y domicilios en pestañas o tarjetas.
                    </td>
                    <td class="text-center"><span class="badge bg-secondary">Sprint 3</span></td>
                    <td class="text-center fw-bold">8</td>
                    <td class="text-center"><span class="badge bg-success">Completado</span></td>
                </tr>
                <tr>
                    <td><strong>HU-06</strong></td>
                    <td>
                        <span class="fw-semibold">CRUD de Direcciones Físicas</span><br>
                        <small class="text-muted">Como usuario, registrar y asociar direcciones físicas a una persona específica.</small>
                    </td>
                    <td class="small">
                        • Asociación obligatoria a una persona.<br>
                        • Control de domicilio principal (solo 1 principal por persona).<br>
                        • Acceso directo desde el módulo general o desde el perfil de la persona.
                    </td>
                    <td class="text-center"><span class="badge bg-secondary">Sprint 3</span></td>
                    <td class="text-center fw-bold">5</td>
                    <td class="text-center"><span class="badge bg-success">Completado</span></td>
                </tr>
                <tr>
                    <td><strong>HU-07</strong></td>
                    <td>
                        <span class="fw-semibold">CRUD de Teléfonos</span><br>
                        <small class="text-muted">Como usuario, registrar números telefónicos clasificados por tipo (Móvil, WhatsApp, Oficina).</small>
                    </td>
                    <td class="small">
                        • Asociación obligatoria a una persona.<br>
                        • Indicativo telefónico y validación numérica mínima de 6 dígitos.<br>
                        • Marca de teléfono principal con actualización automática.
                    </td>
                    <td class="text-center"><span class="badge bg-secondary">Sprint 3</span></td>
                    <td class="text-center fw-bold">5</td>
                    <td class="text-center"><span class="badge bg-success">Completado</span></td>
                </tr>
                <tr>
                    <td><strong>HU-08</strong></td>
                    <td>
                        <span class="fw-semibold">Versionamiento en GitHub y Despliegue</span><br>
                        <small class="text-muted">Como equipo, publicar el código en GitHub con commits semánticos y desplegar en servidor web.</small>
                    </td>
                    <td class="small">
                        • Repositorio con README.md, .gitignore y script database.sql.<br>
                        • Commits convencionales (feat, fix, docs, chore).<br>
                        • Despliegue funcional en servidor web con acceso público o local verificado.
                    </td>
                    <td class="text-center"><span class="badge bg-secondary">Sprint 4</span></td>
                    <td class="text-center fw-bold">2</td>
                    <td class="text-center"><span class="badge bg-success">Completado</span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- 3. PLANIFICACIÓN DE SPRINTS (SPRINT PLANNING) -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-top border-4 border-primary">
            <div class="card-body">
                <span class="badge bg-primary mb-2">Sprint 1</span>
                <h6 class="fw-bold text-dark">Arquitectura y Modelo</h6>
                <p class="small text-muted mb-2"><strong>Meta:</strong> Configurar CI4, diseñar el DER relacional y crear migraciones y seeders.</p>
                <div class="small">
                    <span class="text-success"><i class="bi bi-check-all"></i> Base de datos relacional</span><br>
                    <span class="text-success"><i class="bi bi-check-all"></i> Estructura MVC en CI4</span><br>
                    <span class="text-success"><i class="bi bi-check-all"></i> Layout Bootstrap 5</span>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0">
                <span class="badge bg-success-subtle text-success">Velocidad: 5 pts</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-top border-4 border-warning">
            <div class="card-body">
                <span class="badge bg-warning text-dark mb-2">Sprint 2</span>
                <h6 class="fw-bold text-dark">Catálogos Auxiliares</h6>
                <p class="small text-muted mb-2"><strong>Meta:</strong> Construir los CRUD completos de Sexo, Estado Civil y Género.</p>
                <div class="small">
                    <span class="text-success"><i class="bi bi-check-all"></i> SexoModel / Controller / Views</span><br>
                    <span class="text-success"><i class="bi bi-check-all"></i> EstadoCivil CRUD completo</span><br>
                    <span class="text-success"><i class="bi bi-check-all"></i> Genero CRUD completo</span>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0">
                <span class="badge bg-success-subtle text-success">Velocidad: 9 pts</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-top border-4 border-success">
            <div class="card-body">
                <span class="badge bg-success mb-2">Sprint 3</span>
                <h6 class="fw-bold text-dark">Núcleo Persona y Contacto</h6>
                <p class="small text-muted mb-2"><strong>Meta:</strong> Implementar Persona con relaciones foráneas, teléfonos y direcciones.</p>
                <div class="small">
                    <span class="text-success"><i class="bi bi-check-all"></i> Persona CRUD + Vista Perfil</span><br>
                    <span class="text-success"><i class="bi bi-check-all"></i> Direccion CRUD vinculado</span><br>
                    <span class="text-success"><i class="bi bi-check-all"></i> Telefono CRUD vinculado</span>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0">
                <span class="badge bg-success-subtle text-success">Velocidad: 18 pts</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card h-100 border-top border-4 border-info">
            <div class="card-body">
                <span class="badge bg-info text-dark mb-2">Sprint 4</span>
                <h6 class="fw-bold text-dark">GitHub y Despliegue</h6>
                <p class="small text-muted mb-2"><strong>Meta:</strong> Repositorio en GitHub, script SQL, pruebas integrales y despliegue web.</p>
                <div class="small">
                    <span class="text-success"><i class="bi bi-check-all"></i> Commits semánticos Git</span><br>
                    <span class="text-success"><i class="bi bi-check-all"></i> Exportación database.sql</span><br>
                    <span class="text-success"><i class="bi bi-check-all"></i> Manual de despliegue servidor</span>
                </div>
            </div>
            <div class="card-footer bg-white border-top-0 pt-0">
                <span class="badge bg-success-subtle text-success">Velocidad: 2 pts</span>
            </div>
        </div>
    </div>
</div>

<!-- 4. GUÍA DE ENTREGA ACADÉMICA (GITHUB Y SERVIDOR) -->
<div class="card mb-4 border-primary">
    <div class="card-header bg-primary text-white py-3">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-cloud-check-fill me-2"></i>3. Datos de Entrega de la Actividad (GitHub y Despliegue Web)
        </h5>
    </div>
    <div class="card-body">
        <div class="row g-4">
            <div class="col-md-6">
                <h6 class="fw-bold text-dark"><i class="bi bi-github text-dark me-1"></i> A. Enlace del Repositorio de GitHub:</h6>
                <div class="input-group mb-2">
                    <span class="input-group-text bg-light"><i class="bi bi-link-45deg"></i></span>
                    <input type="text" class="form-control" readonly value="https://github.com/arthurkum/sistema-informacion-codeigniter" placeholder="Pega aquí el enlace de tu repositorio GitHub">
                </div>
                <small class="text-muted d-block mb-3">
                    El repositorio contiene el código fuente completo, estructura MVC, migraciones, seeders, el script <code>database.sql</code> y el archivo <code>README.md</code> detallado.
                </small>
            </div>

            <div class="col-md-6">
                <h6 class="fw-bold text-dark"><i class="bi bi-globe2 text-primary me-1"></i> B. Dirección de Acceso al Sistema Implementado (Servidor Web):</h6>
                <div class="input-group mb-2">
                    <span class="input-group-text bg-light"><i class="bi bi-browser-chrome"></i></span>
                    <input type="text" class="form-control" readonly value="http://localhost:8080/ o https://tu-sitio.infinityfreeapp.com" placeholder="URL pública de acceso al sistema">
                </div>
                <small class="text-muted d-block mb-3">
                    Desplegado en servidor web Apache/PHP con base de datos MySQL conectada y operaciones CRUD verificadas.
                </small>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

