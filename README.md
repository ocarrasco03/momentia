<p align="center">
<a href="https://github.com/ocarrasco03/momentia/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Momentia Backend API

Backend API REST desarrollada en **Laravel 12** para una plataforma SaaS de invitaciones digitales inteligentes orientada a eventos sociales (bodas, XV años, eventos privados).

El sistema está diseñado bajo una arquitectura **stateless**, desacoplada del frontend, y consumida exclusivamente por una **SPA (React / Next.js)**.

---

## 🚀 Características Principales

- API RESTful versionada
- Autenticación stateless mediante tokens
- Gestión completa de eventos:
  - Eventos
  - Invitaciones digitales
  - Invitados
  - Confirmaciones (RSVP)
  - Mesas y asignación de asientos
- Cotizaciones y contratación del servicio
- Roles y permisos
- Jobs y colas para procesos asíncronos
- Cache y locks con Redis
- Almacenamiento S3-compatible
- Escalabilidad para múltiples clientes y eventos concurrentes

---

## 🏗️ Arquitectura

- **Framework:** Laravel 12
- **Tipo:** API REST (sin Blade, sin vistas)
- **Base de datos:** PostgreSQL
- **Autenticación:** Laravel Sanctum (tokens)
- **Cache / Queues:** Redis
- **Storage:** S3-compatible
- **Frontend:** SPA (ReactJS / NextJS)

---

## 🔐 Autenticación y Seguridad

- Tokens personales usando Sanctum
- Protección de rutas mediante middleware
- Rate limiting a nivel de API
- Roles y permisos (Spatie)
- API completamente stateless

---

## 📦 Requisitos

- PHP >= 8.3
- Composer
- PostgreSQL
- Redis
- Docker (opcional, recomendado)

---

## ⚙️ Instalación Local

### 1. Clonar repositorio

```bash
git clone https://github.com/tu-org/momentia-backend.git
cd momentia-backend
```

### 2. Instalar dependencias

```bash
composer install
```

### 3. Variables de entorno

```bash
cp .env.example .env
php artisan key:generate
```

Configura al menos:

```
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=momentia
DB_USERNAME=postgres
DB_PASSWORD=secret

REDIS_HOST=redis
REDIS_PORT=6379

FILESYSTEM_DISK=s3
```

### 4. Migraciones y seeders

```bash
php artisan migrate --seed
```

### 5. Ejecutar servidor

```bash
php artisan serve
```

## License

The momentia is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
