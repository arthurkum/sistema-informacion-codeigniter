@echo off
title Sistema Web CodeIgniter 4 - Servidor Local
echo ========================================================
echo Iniciando Servidor Local de CodeIgniter 4...
echo ========================================================
echo.
echo El sistema estara disponible en:
echo   --^> http://localhost:8080/
echo.
echo Presione CTRL + C para detener el servidor.
echo ========================================================
echo.

"C:\xampp\php\php.exe" spark serve --port 8080
pause

