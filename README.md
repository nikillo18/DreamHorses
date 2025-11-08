
# Dreamhorses

DreamHorses es una plataforma web desarrollada para permitir la gestión completa de la administración de caballos de carrera, sus cuidadores y los studs (centros de entrenamiento).
# Características Principales:
 Usuarios:
- Registro, inicio de sesión y verificación de correo electrónico.
- Sistema de roles y permisos ( Jefe y Cuidador).alquiladas.
- Panel de perfil con datos personales y opciones de edición.
- Control de acceso a funcionalidades según el rol asignado.
# Caballos
- CRUD completo de caballos .
- El jefe puede crear caballos, asignar cuidadores y eliminarlos.
- El cuidador solo puede editar los datos de los caballos que cuida.
- Sección de fotos del caballo con carga múltiple de imágenes.
- Visualización de la información del caballo.
# Carrera 
- Registro de carreras.
- Se permite el guardado de un video 
# Entrenamientos
- Registro de entrenamientos diarios.
- Cálculo y visualización del tiempo.
- Acceso filtrado.
# Gastos
- Registro de gastos.
- Visualización gráfica de gastos.
- Generación de PDFs con resúmenes de gastos.
# Visitas Veterinarias
- Control de visitas.
- Asociación directa entre visita y caballo.
# Herrería
- Registro de trabajos realizados.
- Asociación con cada caballo y su historial de mantenimiento.
# Eventos
- Se guardan fechas(Entrenamientos, visitas veterinarias, carreras y otros eventos.)
- Cada usuario puede visualizar el calendario de sus propios caballos
# Studs
- Los jefes pueden contratar y despedir studs.
- Los cuidadores pueden unirse hasta dos studs y cada usuario solo puede crear un stud propio.
- Gestión del personal del stud
# Panel y Reportes 
- Panel de control con resúmenes de gastos, caballos y eventos.
- Gráficos interactivos de rendimiento y uso de recursos.

# Tecnologías Utilizadas:
- Backend: PHP >= 8.1  con Laravel 10
- Frontend: Tailwind CSS, Blade Templates,DaisyUI,Alpine.js,     Chart.js,FullCalendar
- Base de Datos: MySQL
- Autenticación: Laravel Breeze 
## Instalacion
Siga estos pasos para configurar y ejecutar el proyecto localmente:



1. Descargue el proyecto o clone el repositorio:

```bash
git clone [URL del repositorio]
```
2. Antes de ejecutar cualquier comando, dirigirse a la carpeta ap,
   que se encuentra en el directorio principal del proyecto
```bash
cd [/ruta/a/mi/proyecto/app/]
```
3. Copie el archivo .env.example y renómbrelo a .env:
```bash
 env.example 
```
4. Instale todas las dependencias del proyecto:
```bash
composer install
```
5. Configure la clave de la aplicación:
``` bash
php artisan key:generate --ansi
```
6. Instale las dependencias 
```bash
npm install
```
7. Ejecute las migraciones para configurar la base de datos:
```bash
php artisan migrate --seed
```
8.  Ejecutar
```bash
    php artisan storage:link 
```
9. Ejecute el gestor de paquetes 

```bash
npm run dev
```
10. Inicie el servidor local:

```bash
php artisan serve
```
11. Visite la aplicación en el navegador:
```bash
http://127.0.0.1:8000
```


