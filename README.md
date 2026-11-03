# Sistema de Información Web con CodeIgniter 4 (Arquitectura MVC)

> **Actividad de Aprendizaje:** Desarrollo y despliegue de un sistema de información web con CodeIgniter aplicando la metodología ágil **Scrum** y el patrón de arquitectura **Modelo-Vista-Controlador (MVC)**.

---

## 📌 Tabla de Contenidos
1. [Descripción del Proyecto](#descripción-del-proyecto)
2. [Arquitectura y Tecnologías](#arquitectura-y-tecnologías)
3. [Modelo de Datos y Entidades](#modelo-de-datos-y-entidades)
4. [Metodología Ágil Scrum](#metodología-ágil-scrum)
   - [Roles del Equipo](#roles-del-equipo)
   - [Product Backlog e Historias de Usuario](#product-backlog-e-historias-de-usuario)
   - [Planificación y Ejecución de Sprints](#planificación-y-ejecución-de-sprints)
5. [Requisitos Previos](#requisitos-previos)
6. [Instalación y Configuración Local](#instalación-y-configuración-local)
7. [Buenas Prácticas de Control de Versiones (Git y GitHub)](#buenas-prácticas-de-control-de-versiones-git-y-github)
8. [Guía de Despliegue en Servidor Web](#guía-de-despliegue-en-servidor-web)
9. [Verificación del Correcto Funcionamiento](#verificación-del-correcto-funcionamiento)
10. [Enlaces de Entrega](#enlaces-de-entrega)

---

## 📖 Descripción del Proyecto

El presente sistema es una plataforma web desarrollada en **CodeIgniter 4** que implementa de forma completa las operaciones **CRUD** (Crear, Consultar, Actualizar y Eliminar) para la gestión organizada y relacionada de las siguientes 6 entidades:

1. **Persona:** Entidad principal que almacena los datos de identificación y biográficos del individuo.
2. **Sexo:** Catálogo de sexo biológico con claves foráneas hacia Persona.
3. **Estado Civil:** Catálogo con opciones como Soltero(a), Casado(a), Unión Libre, Divorciado(a), etc.
4. **Género:** Catálogo de identidades de género (Cisgénero, Transgénero, No Binario, etc.).
5. **Dirección:** Entidad de ubicación física vinculada directamente con una Persona (soporte para múltiples direcciones por persona y control de domicilio principal).
6. **Teléfono:** Entidad de contacto vinculada con una Persona (soporte para múltiples líneas: Móvil, WhatsApp, Oficina, y control de teléfono principal).

El software cuenta además con un **Dashboard administrativo** con métricas estadísticas y un **Módulo de Gestión Scrum** integrado para evidenciar la planeación ágil del equipo.

---

## 🏗 Arquitectura y Tecnologías

El sistema sigue estrictamente el patrón arquitectónico **Modelo-Vista-Controlador (MVC)**:

- **Modelo (Model):** Representa las tablas de la base de datos, encapsulando las reglas de validación en servidor, integridad referencial y consultas relacionales mediante Query Builder.
- **Vista (View):** Interfaces de usuario responsivas construidas con HTML5, Bootstrap 5.3, Bootstrap Icons y SweetAlert2 para la confirmación de acciones destructivas.
- **Controlador (Controller):** Gestiona las peticiones HTTP (GET, POST), coordina la lógica de negocio, valida los datos de entrada y despacha las vistas con mensajes de retroalimentación (Flash Messages).

### Stack Tecnológico:
- **Backend:** PHP 8.2+ con CodeIgniter 4.7+
- **Base de Datos:** MySQL / MariaDB (Motor InnoDB con llaves foráneas e integridad referencial)
- **Frontend:** Bootstrap 5.3, Bootstrap Icons 1.11, Google Fonts Inter
- **Control de Versiones:** Git con estándar Conventional Commits
- **Servidor Web:** Apache / PHP Built-in Server

---

## 🗄 Modelo de Datos y Entidades

El diagrama entidad-relación comprende las siguientes cardinalidades:
- `sexos` (1:N) `personas` (Restricción ON DELETE RESTRICT)
- `estados_civiles` (1:N) `personas` (Restricción ON DELETE RESTRICT)
- `generos` (1:N) `personas` (Restricción ON DELETE RESTRICT)
- `personas` (1:N) `direcciones` (Eliminación en cascada ON DELETE CASCADE)
- `personas` (1:N) `telefonos` (Eliminación en cascada ON DELETE CASCADE)

### Resumen de Tablas:

| Tabla | Clave Primaria | Claves Foráneas | Propósito |
|---|---|---|---|
| `sexos` | `id` | Ninguna | Catálogo de sexos biológicos (Masculino, Femenino, Intersexual). |
| `estados_civiles` | `id` | Ninguna | Catálogo de estados civiles (Soltero, Casado, Unión Libre, etc.). |
| `generos` | `id` | Ninguna | Catálogo de identidades de género reconocidas. |
| `personas` | `id` | `sexo_id`, `estado_civil_id`, `genero_id` | Almacena documento, nombres, apellidos, fecha de nacimiento y correo. |
| `direcciones` | `id` | `persona_id` | Almacena tipo de dirección, calle, barrio, ciudad y país. |
| `telefonos` | `id` | `persona_id` | Almacena número telefónico, indicativo y tipo de línea. |

---

## 🏃 Metodología Ágil Scrum

El proyecto fue planificado y ejecutado simulando el ciclo de vida de **Scrum**.

### Roles del Equipo:
- **Product Owner (PO):** Define la visión del producto, redacta las Historias de Usuario, prioriza el Product Backlog y valida la aceptación final de cada entregable.
- **Scrum Master (SM):** Facilita las ceremonias ágiles, elimina impedimentos técnicos del equipo y vela por el cumplimiento de las buenas prácticas de Scrum.
- **Development Team:**
  - *Desarrollador Backend:* Creación de controladores, modelos, validaciones y rutas en CodeIgniter 4.
  - *Desarrollador Frontend:* Diseño de vistas responsivas, modales y layouts en Bootstrap 5.
  - *Especialista en BD & DevOps:* Diseño del esquema relacional, migraciones, seeders, control de versiones Git y despliegue en servidor.

### Product Backlog e Historias de Usuario:

| ID | Historia de Usuario | Criterios de Aceptación | Puntos | Sprint |
|---|---|---|:---:|:---:|
| **HU-01** | Configuración de Arquitectura MVC y BD | Esquema MySQL con Foreign Keys, migraciones y seeders iniciales funcionales. | 5 | Sprint 1 |
| **HU-02** | CRUD de Catálogo Sexo | Crear, listar, editar y eliminar con validación de nombres únicos y protección de borrado si está asociado. | 3 | Sprint 2 |
| **HU-03** | CRUD de Catálogo Estado Civil | Operaciones CRUD completas con retroalimentación mediante alertas flash. | 3 | Sprint 2 |
| **HU-04** | CRUD de Catálogo Género | Operaciones CRUD completas garantizando diversidad e inclusión en los registros. | 3 | Sprint 2 |
| **HU-05** | CRUD de Entidad Persona | Registro con validación de documento y correo único, cálculo automático de edad y vista detallada. | 8 | Sprint 3 |
| **HU-06** | CRUD de Direcciones Físicas | Asociación a una persona, control de dirección principal y gestión desde la vista de persona o catálogo general. | 5 | Sprint 3 |
| **HU-07** | CRUD de Teléfonos | Asociación a persona, clasificación por tipo de línea y control de contacto principal. | 5 | Sprint 3 |
| **HU-08** | Versionamiento y Despliegue Web | Publicación en repositorio GitHub con historial de commits y despliegue en servidor web accesible. | 2 | Sprint 4 |

---

## 💻 Requisitos Previos

- **PHP 8.1 o superior** (probado en PHP 8.2 con la extensión `intl` habilitada).
- **MySQL / MariaDB** (servidor local XAMPP, WAMP o contenedor Docker).
- **Git** instalado para el control de versiones.
- Navegador web moderno (Chrome, Firefox, Edge).

---

## ⚙ Instalación y Configuración Local

### 1. Clonar el repositorio
```bash
git clone https://github.com/arthurkum/sistema-informacion-codeigniter.git
cd sistema-informacion-codeigniter
```

### 2. Configurar el archivo `.env`
Copia el archivo de plantilla `env` a `.env` (si aún no existe) y revisa las credenciales de base de datos:
```ini
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = sisinfo_db
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port = 3306
```

### 3. Crear y Poblar la Base de Datos
Puedes crear la base de datos de cualquiera de estas dos formas:

#### Opción A (Recomendada - Script SQL directo):
1. Inicia **XAMPP Control Panel** y presiona **Start** en MySQL.
2. Abre **phpMyAdmin** (`http://localhost/phpmyadmin`).
3. Ve a la pestaña **Importar** (Import) y selecciona el archivo `database.sql` ubicado en la raíz del proyecto.
4. Presiona **Continuar**. El script creará la base de datos `sisinfo_db`, las 6 tablas con sus claves foráneas y los datos iniciales de prueba.

#### Opción B (Mediante CodeIgniter Spark CLI):
Si tienes MySQL corriendo:
```bash
php spark migrate
php spark db:seed DatabaseSeeder
```

### 4. Habilitar la extensión `intl` en PHP (si aplica)
En el archivo `C:\xampp\php\php.ini`, asegúrate de que la línea:
```ini
extension=intl
```
no tenga un punto y coma `;` al principio.

### 5. Iniciar el servidor local
Ejecuta en la terminal de la raíz del proyecto:
```bash
php spark serve
```
Abre tu navegador en: **`http://localhost:8080`**

---

## 🐙 Buenas Prácticas de Control de Versiones (Git y GitHub)

El proyecto implementa la convención **Conventional Commits** para mantener un historial trazable:

- `feat:` Nueva funcionalidad desarrollada (ej. `feat: crud de personas`).
- `fix:` Corrección de errores detectados.
- `docs:` Documentación, diagramas o actualización de README.
- `chore:` Tareas de configuración, dependencias o inicialización.

### Pasos para publicar en tu cuenta de GitHub:
```bash
# 1. Crear un repositorio vacío en github.com (ej. sistema-informacion-codeigniter)
# 2. Vincular el repositorio remoto (reemplaza con tu URL):
git remote add origin https://github.com/arthurkum/sistema-informacion-codeigniter.git

# 3. Subir las ramas y commits:
git push -u origin main
```

---

## 🌐 Guía de Despliegue en Servidor Web

Para cumplir con el requerimiento de **desplegar la aplicación en un servidor web y verificar su funcionamiento**:

### Opción 1: Despliegue en Hosting Gratuito (InfinityFree / ByetHost / AlwaysData)
1. **Crear una cuenta** en [InfinityFree](https://www.infinityfree.com/) o [AlwaysData](https://www.alwaysdata.com/).
2. **Crear una Base de Datos MySQL** desde el panel de control (cPanel).
3. **Importar la Base de Datos:**
   - Abre phpMyAdmin en el hosting.
   - Importa el archivo `database.sql` en la base de datos creada.
4. **Subir los Archivos mediante FTP (FileZilla) o File Manager:**
   - Sube la carpeta `app`, `system`, `writable` a la raíz de tu cuenta de hosting.
   - Sube el contenido de la carpeta `public` (incluyendo `index.php` y `.htaccess`) directamente a la carpeta pública (`htdocs` o `public_html`).
   - En `index.php`, asegúrate de que la ruta hacia `FCAPPPATH` apunte correctamente a `app/Config/Paths.php`.
5. **Configurar `.env` en el servidor:**
   - Coloca la URL de tu dominio asignado en `app.baseURL`.
   - Ajusta los datos del host de base de datos, usuario, contraseña y nombre de la BD suministrados por el hosting.

### Opción 2: Despliegue en Servidor Local XAMPP (Apache)
1. Copia o mueve la carpeta del proyecto a `C:\xampp\htdocs\sistema_web`.
2. En `.env`, configura:
   ```ini
   app.baseURL = 'http://localhost/sistema_web/public/'
   ```
3. Inicia Apache y MySQL desde el XAMPP Control Panel.
4. Accede desde tu navegador a `http://localhost/sistema_web/public/`.

---

## ✅ Verificación del Correcto Funcionamiento

Lista de comprobación (Checklist) para la sustentación y revisión docente:

- [x] **Arquitectura MVC:** Separación estricta entre Modelos (`app/Models`), Vistas (`app/Views`) y Controladores (`app/Controllers`).
- [x] **CRUD Entidad Persona:** Creación, lectura, edición y eliminación de personas con validación de unicidad.
- [x] **CRUD Entidad Sexo:** Catálogo completo con integridad referencial.
- [x] **CRUD Entidad Estado Civil:** Catálogo con opciones activas/inactivas.
- [x] **CRUD Entidad Género:** Catálogo de identidades de género con control de duplicados.
- [x] **CRUD Entidad Dirección:** Asociación directa con persona, tipo de dirección y selección de dirección principal.
- [x] **CRUD Entidad Teléfono:** Asociación con persona, tipo de línea e indicativo con selección de teléfono principal.
- [x] **Integridad Referencial:** Llaves foráneas con eliminación en cascada en teléfonos y direcciones, y restricción de borrado en catálogos utilizados.
- [x] **Interfaz de Usuario:** Dashboard con estadísticas numéricas y gráficas, diseño responsivo en Bootstrap 5 y modales de confirmación.
- [x] **Metodología Scrum:** Sección interactiva dentro del sistema (`/scrum`) con roles, Product Backlog, criterios de aceptación y Sprint Planning.
- [x] **Script SQL:** Archivo `database.sql` autosuficiente listo para importar.

---

## 🔗 Enlaces de Entrega

| Entregable | Enlace / URL |
|---|---|
| **Repositorio de GitHub:** | `https://github.com/arthurkum/sistema-informacion-codeigniter` |
| **Dirección del Sistema en Servidor:** | `http://localhost:8080/` *(o URL pública de hosting)* |

---
*Desarrollado para la Actividad de Aprendizaje: Desarrollo y despliegue de un sistema de información web con CodeIgniter.*
