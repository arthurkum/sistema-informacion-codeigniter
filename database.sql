-- ============================================================
-- SISTEMA DE INFORMACIÓN WEB CON CODEIGNITER 4 (ARQUITECTURA MVC)
-- Script de Base de Datos MySQL: Creación de Esquema y Datos Iniciales
-- Metodología Ágil Scrum
-- ============================================================

CREATE DATABASE IF NOT EXISTS `sisinfo_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sisinfo_db`;

-- Desactivar temporalmente revisión de claves foráneas
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `telefonos`;
DROP TABLE IF EXISTS `direcciones`;
DROP TABLE IF EXISTS `personas`;
DROP TABLE IF EXISTS `generos`;
DROP TABLE IF EXISTS `estados_civiles`;
DROP TABLE IF EXISTS `sexos`;

-- ============================================================
-- 1. TABLA: SEXOS (Entidad: Sexo)
-- ============================================================
CREATE TABLE `sexos` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(50) NOT NULL UNIQUE,
    `abreviatura` VARCHAR(10) NULL,
    `descripcion` VARCHAR(255) NULL,
    `estado` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 2. TABLA: ESTADOS_CIVILES (Entidad: Estado Civil)
-- ============================================================
CREATE TABLE `estados_civiles` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(50) NOT NULL UNIQUE,
    `descripcion` VARCHAR(255) NULL,
    `estado` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 3. TABLA: GENEROS (Entidad: Género)
-- ============================================================
CREATE TABLE `generos` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `nombre` VARCHAR(50) NOT NULL UNIQUE,
    `descripcion` VARCHAR(255) NULL,
    `estado` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 4. TABLA: PERSONAS (Entidad: Persona)
-- ============================================================
CREATE TABLE `personas` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `tipo_documento` VARCHAR(20) NOT NULL DEFAULT 'CC',
    `numero_documento` VARCHAR(30) NOT NULL UNIQUE,
    `nombres` VARCHAR(100) NOT NULL,
    `apellidos` VARCHAR(100) NOT NULL,
    `fecha_nacimiento` DATE NOT NULL,
    `correo_electronico` VARCHAR(150) NOT NULL UNIQUE,
    `sexo_id` INT UNSIGNED NOT NULL,
    `estado_civil_id` INT UNSIGNED NOT NULL,
    `genero_id` INT UNSIGNED NOT NULL,
    `foto` VARCHAR(255) NULL,
    `estado` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,
    CONSTRAINT `fk_persona_sexo` FOREIGN KEY (`sexo_id`) REFERENCES `sexos` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `fk_persona_estado_civil` FOREIGN KEY (`estado_civil_id`) REFERENCES `estados_civiles` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT `fk_persona_genero` FOREIGN KEY (`genero_id`) REFERENCES `generos` (`id`) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 5. TABLA: DIRECCIONES (Entidad: Dirección)
-- ============================================================
CREATE TABLE `direcciones` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `persona_id` INT UNSIGNED NOT NULL,
    `tipo_direccion` VARCHAR(50) NOT NULL DEFAULT 'Residencia',
    `direccion` VARCHAR(255) NOT NULL,
    `barrio` VARCHAR(100) NULL,
    `ciudad` VARCHAR(100) NOT NULL,
    `departamento_estado` VARCHAR(100) NOT NULL,
    `codigo_postal` VARCHAR(20) NULL,
    `es_principal` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,
    CONSTRAINT `fk_direccion_persona` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ============================================================
-- 6. TABLA: TELEFONOS (Entidad: Teléfono)
-- ============================================================
CREATE TABLE `telefonos` (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `persona_id` INT UNSIGNED NOT NULL,
    `tipo_telefono` VARCHAR(50) NOT NULL DEFAULT 'Móvil',
    `indicativo` VARCHAR(10) NOT NULL DEFAULT '+57',
    `numero` VARCHAR(30) NOT NULL,
    `es_principal` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` DATETIME NULL,
    `updated_at` DATETIME NULL,
    CONSTRAINT `fk_telefono_persona` FOREIGN KEY (`persona_id`) REFERENCES `personas` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- DATOS INICIALES (SEEDS)
-- ============================================================

INSERT INTO `sexos` (`id`, `nombre`, `abreviatura`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Masculino', 'M', 'Sexo biológico masculino', 1, NOW(), NOW()),
(2, 'Femenino', 'F', 'Sexo biológico femenino', 1, NOW(), NOW()),
(3, 'Intersexual', 'I', 'Variaciones biológicas de características sexuales', 1, NOW(), NOW());

INSERT INTO `estados_civiles` (`id`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Soltero(a)', 'Persona que no ha contraído matrimonio legalmente', 1, NOW(), NOW()),
(2, 'Casado(a)', 'Persona que ha contraído matrimonio civil o religioso', 1, NOW(), NOW()),
(3, 'Unión Libre', 'Convivencia marital sin vínculo matrimonial formal', 1, NOW(), NOW()),
(4, 'Divorciado(a)', 'Persona con disolución legal de matrimonio', 1, NOW(), NOW()),
(5, 'Viudo(a)', 'Persona cuyo cónyuge ha fallecido', 1, NOW(), NOW());

INSERT INTO `generos` (`id`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Masculino (Cisgénero)', 'Identidad concordante con sexo asignado masculino', 1, NOW(), NOW()),
(2, 'Femenino (Cisgénero)', 'Identidad concordante con sexo asignado femenino', 1, NOW(), NOW()),
(3, 'Transgénero', 'Identidad que difiere del sexo asignado al nacer', 1, NOW(), NOW()),
(4, 'No Binario', 'Identidad fuera del binarismo hombre/mujer', 1, NOW(), NOW()),
(5, 'Prefiero no especificar', 'Reserva su declaración de identidad de género', 1, NOW(), NOW());

INSERT INTO `personas` (`id`, `tipo_documento`, `numero_documento`, `nombres`, `apellidos`, `fecha_nacimiento`, `correo_electronico`, `sexo_id`, `estado_civil_id`, `genero_id`, `foto`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'CC', '1020304050', 'Carlos Andrés', 'Gómez Restrepo', '1992-05-14', 'carlos.gomez@example.com', 1, 2, 1, NULL, 1, NOW(), NOW()),
(2, 'CC', '1098765432', 'María Fernanda', 'López Salazar', '1995-11-23', 'maria.lopez@example.com', 2, 1, 2, NULL, 1, NOW(), NOW()),
(3, 'CE', '5544332211', 'Alex', 'Martínez Peña', '1998-08-30', 'alex.martinez@example.com', 1, 3, 4, NULL, 1, NOW(), NOW());

INSERT INTO `direcciones` (`id`, `persona_id`, `tipo_direccion`, `direccion`, `barrio`, `ciudad`, `departamento_estado`, `codigo_postal`, `es_principal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Residencia', 'Calle 45 # 12-34 Apto 502', 'Laureles', 'Medellín', 'Antioquia', '050031', 1, NOW(), NOW()),
(2, 1, 'Trabajo', 'Carrera 43A # 1Sur-50 Of 801', 'El Poblado', 'Medellín', 'Antioquia', '050022', 0, NOW(), NOW()),
(3, 2, 'Residencia', 'Carrera 7 # 72-41 Torre B', 'Rosales', 'Bogotá D.C.', 'Cundinamarca', '110221', 1, NOW(), NOW()),
(4, 3, 'Residencia', 'Avenida 6N # 28N-15', 'Santa Mónica', 'Cali', 'Valle del Cauca', '760026', 1, NOW(), NOW());

INSERT INTO `telefonos` (`id`, `persona_id`, `tipo_telefono`, `indicativo`, `numero`, `es_principal`, `created_at`, `updated_at`) VALUES
(1, 1, 'Móvil', '+57', '3001234567', 1, NOW(), NOW()),
(2, 1, 'Oficina', '+57', '6044445555', 0, NOW(), NOW()),
(3, 2, 'Móvil', '+57', '3159876543', 1, NOW(), NOW()),
(4, 3, 'WhatsApp', '+57', '3205556677', 1, NOW(), NOW());

