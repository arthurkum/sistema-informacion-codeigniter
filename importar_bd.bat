@echo off
title Importar Base de Datos MySQL - SisInfo
echo ========================================================
echo Importando database.sql a MySQL local (XAMPP)...
echo Asegurese de que MySQL este iniciado en XAMPP Control Panel.
echo ========================================================
echo.

if exist "C:\xampp\mysql\bin\mysql.exe" (
    "C:\xampp\mysql\bin\mysql.exe" -u root < database.sql
    if %ERRORLEVEL% equ 0 (
        echo [OK] Base de datos 'sisinfo_db' importada exitosamente con todas sus tablas y datos iniciales.
    ) else (
        echo [ERROR] No se pudo importar la base de datos. Verifique que MySQL este iniciado en XAMPP.
    )
) else (
    echo [ERROR] No se encontro mysql.exe en C:\xampp\mysql\bin\
)

echo.
pause
