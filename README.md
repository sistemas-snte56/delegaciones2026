# 📋 Sistema de Gestión de Delegaciones — SNTE Sección 56

Sistema administrativo para la gestión de delegaciones, maestros, regiones y secretarías del SNTE Sección 56, desarrollado con Laravel 12 y Filament 3.

> 🔄 Este proyecto es la migración y modernización de [delegaciones2024](https://github.com/sistemas-snte56/delegaciones2024), reescrito desde cero con un stack actualizado.

---

## 🚀 Stack Tecnológico

| Capa | Tecnología |
|---|---|
| Framework | Laravel 12 |
| Panel Admin | Filament 3 |
| Autenticación | Laravel Fortify / Filament Shield |
| Permisos | Spatie Laravel Permission |
| Generación de PDFs | Barryvdh DomPDF |
| Base de datos | MySQL 8+ |
| PHP | 8.2+ |

---

## 📦 Módulos del Sistema

### 🗺️ Regiones
Catálogo de regiones con su sede correspondiente. Incluye conteo de delegaciones por nomenclatura (D-I, D-II, D-III, D-IV, CT).

### 🏫 Delegaciones
Módulo principal del sistema. Gestiona el registro de delegaciones de activos, jubilados y centros de trabajo. Al crear una delegación se generan automáticamente los registros de maestros/secretarías correspondientes.

Tipos de delegación:
- **Tipo 1** — Delegación de Activos (7 secretarías)
- **Tipo 2** — Delegación de Jubilados (7 secretarías)
- **Tipo 3** — Centro de Trabajo (1 representante)

Funcionalidades adicionales:
- Impresión de hoja de delegación en PDF
- Impresión de directorio con datos e imagen institucional

### 👨‍🏫 Maestros / Dirigentes
Registro de los maestros que ocupan cargos dentro de cada delegación, asociados a una secretaría específica.

### 👤 Usuarios
Gestión de usuarios del sistema con asignación de rol, región, delegación y secretaría.

### 🔐 Roles y Permisos
Control de acceso granular mediante Spatie Permission. Roles configurables con asignación de permisos por módulo.

Permisos disponibles por módulo:
- `region.index`, `region.create`, `region.edit`, `region.destroy`
- `delegacion.index`, `delegacion.create`, `delegacion.edit`, `delegacion.destroy`
- `maestro.index`, `maestro.create`, `maestro.edit`, `maestro.destroy`
- `user.index`, `user.create`, `user.edit`, `user.destroy`
- `role.index`, `role.create`, `role.edit`, `role.destroy`
- `permission.index`, `permission.create`, `permission.edit`, `permission.destroy`

### 📊 Estadísticas
Visualización de delegaciones por región con conteos por tipo de nomenclatura y detalle por delegación.

---

## 🗄️ Estructura de Base de Datos

```
regiones
├── id
├── region
└── sede

delegaciones
├── id
├── region_id          → regiones
├── tipo_delegacion_id → tipo_delegaciones
├── delegacion_ct_id   → delegacion_o_ct
├── nomenclatura_id    → nomenclaturas
├── num_delegacional
├── nivel_delegacional
├── sede_delegacional
├── fecha_inicio
├── fecha_final
├── direccion
├── cp
├── ciudad
└── estado

maestros
├── id
├── delegacion_id → delegaciones
├── secretaria_id → secretarias
├── user_id       → users
├── titulo
├── nombre / apaterno / amaterno
├── genero        (Enum: MASCULINO, FEMENINO, OTRO)
├── email
├── telefono
├── direccion / cp / ciudad / estado
└── timestamps

secretarias
├── id
├── cartera_secretaria
└── nomenclatura_id

users
├── id
├── region_id     → regiones
├── delegacion_id → delegaciones
├── secretaria_id → secretarias
├── titulo / nombre / apaterno / amaterno
├── email / password
└── timestamps
```

---

## ⚙️ Instalación

### Requisitos previos
- PHP 8.2+
- Composer 2+
- MySQL 8+
- Node.js 18+

### Pasos

```bash
# 1. Clonar el repositorio
git clone https://github.com/sistemas-snte56/delegaciones-filament.git
cd delegaciones-filament

# 2. Instalar dependencias PHP
composer install

# 3. Instalar dependencias JS
npm install && npm run build

# 4. Configurar entorno
cp .env.example .env
php artisan key:generate

# 5. Configurar base de datos en .env
DB_DATABASE=delegaciones
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password

# 6. Ejecutar migraciones y seeders
php artisan migrate --seed

# 7. Crear usuario administrador de Filament
php artisan make:filament-user

# 8. Iniciar servidor
php artisan serve
```

---

## 🌱 Seeders incluidos

Los seeders poblan los catálogos base necesarios para operar el sistema:

| Seeder | Descripción |
|---|---|
| `RegionesTableSeeder` | Regiones de la sección |
| `GeneroTableSeeder` | Géneros (Masculino, Femenino) |
| `DelegacionCtTableSeeder` | Tipos de estructura (Delegación / CT) |
| `TipoDelegacionTableSeeder` | Tipos de delegación (Activos, Jubilados, CT) |
| `NomenclaturasTableSeeder` | Nomenclaturas (D-I, D-II, D-III, D-IV, CT) |
| `SecretariasTableSeeder` | Carteras de secretarías |
| `DelegacionesTableSeeder` | Delegaciones iniciales |
| `RoleSeeder` | Roles y permisos base |

---

## 🔄 Proyecto de origen

Este sistema es la evolución de `delegaciones2024`, que fue desarrollado con:
- Laravel 10 + AdminLTE 3 + Jetstream
- Livewire 3 para selectores dependientes
- Spatie Permission para roles y permisos
- DomPDF para generación de PDFs

La migración a este nuevo proyecto implicó:
- Actualización a Laravel 12 y Filament 3
- Corrección de typos en nombres de columnas (`num_delegaciona` → `num_delegacional`)
- Unificación de lógica duplicada entre controladores
- Sustitución de `genero` como tabla por Enum de PHP 8.1
- Reescritura de CRUDs como Resources de Filament
- Selectores dependientes migrados a Filament Select con `reactive()`

---

## 📄 Licencia

Uso interno — SNTE Sección 56. Todos los derechos reservados.
