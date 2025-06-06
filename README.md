# API de Gestión de Inventario - Prueba Técnica

API RESTful desarrollada con Laravel 12 para la gestión de inventario de productos con sistema de roles y autenticación.

## 🚀 **Características**

- ✅ Autenticación con Laravel Sanctum
- ✅ Sistema de roles (Admin/User) con enum
- ✅ CRUD completo de productos, categorías y usuarios
- ✅ Autorización basada en roles
- ✅ Validación de datos con Form Requests
- ✅ Arquitectura en capas (Repository + Service Pattern)
- ✅ API Resources para transformación de datos
- ✅ Seeders con datos de prueba
- ✅ Middleware personalizado para autorización

## 🛠️ **Stack Tecnológico**

- **PHP**: 8.2+
- **Laravel**: 12.x
- **Base de Datos**: PostgreSQL
- **Autenticación**: Laravel Sanctum
- **Gestor de Paquetes**: Composer

## 🔧 **Instalación con Docker**

1. **Clonar el repositorio**
```bash
git clone https://github.com/Malpor23/prueba-smart.git
cd prueba-smart
```

2. **Configurar el entorno:**

- Copiar el archivo `.env.example` a `.env`
- Configurar la conexión a la base de datos en el archivo `.env`

```bash
copy .env.example .env
```

```bash
DB_CONNECTION=pgsql
DB_HOST=postgres
DB_PORT=5432
DB_DATABASE=smart_db
DB_USERNAME=postgres
DB_PASSWORD=smart_password
```

3. **Iniciar los contenedores Docker:**

```bash
# Levantar
docker-compose up -d

# Entrar al contenedor de PHP
docker-compose exec php bash

# Establecer permisos para directorios
chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache

# Instalar dependencias
composer install

# Generar key
php artisan key:generate

# Ejecutar migraciones iniciales con seeders
php artisan migrate --seed
```

4. **Acceder a la aplicación:**

La API estará disponible en: http://localhost

## 🔧 **Instalación Local**

### Prerrequisitos
- PHP 8.2 o superior
- Composer
- Base de datos PostgreSQL

1. **Clonar el repositorio**
```bash
git clone https://github.com/Malpor23/prueba-smart.git
cd prueba-smart
```

2. **Instalar dependencias**
```bash
composer install
```

3. **Configurar variables de entorno**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configurar base de datos en `.env`**
```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=prueba_smart
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password
```

5. **Ejecutar migraciones y seeders**
```bash
php artisan migrate --seed
```

6. **Iniciar servidor de desarrollo**
```bash
php artisan serve
```
La API estará disponible en: http://localhost:8000

## 🔐 Usuarios de Prueba

### Administrador
- Email : admin@example.com
- Password : password
- Rol : admin
- 
### Usuario Regular
- Email : user@example.com
- Password : password
- Rol : user
- 
## 📚 Endpoints de la API

### Autenticación

| Método | Endpoint        | Descripción       | Autorización |
|--------|-----------------|-------------------|--------------|
| POST   | `/api/register` | Registrar usuario | Pública      |
| POST   | `/api/login`    | Iniciar sesión    | Pública      |
| POST   | `/api/logout`   | Cerrar sesión     | Autenticado  |

### Productos

| Método | Endpoint             | Descripción         | Autorización |
|--------|----------------------|---------------------|--------------|
| GET    | `/api/products`      | Listar productos    | Autenticado  |
| GET    | `/api/products/{id}` | Ver producto        | Autenticado  |
| POST   | `/api/products`      | Crear producto      | Solo Admin   |
| PUT    | `/api/products/{id}` | Actualizar producto | Solo Admin   |
| DELETE | `/api/products/{id}` | Eliminar producto   | Solo Admin   |

### Categorías

| Método | Endpoint               | Descripción          | Autorización |
|--------|------------------------|----------------------|--------------|
| GET    | `/api/categories`      | Listar categorías    | Autenticado  |
| GET    | `/api/categories/{id}` | Ver categoría        | Autenticado  |
| POST   | `/api/categories`      | Crear categoría      | Solo Admin   |
| PUT    | `/api/categories/{id}` | Actualizar categoría | Solo Admin   |
| DELETE | `/api/categories/{id}` | Eliminar categoría   | Solo Admin   |

### Usuarios

| Método | Endpoint          | Descripción        | Autorización |
|--------|-------------------|--------------------|--------------|
| GET    | `/api/users`      | Listar usuarios    | Solo Admin   |
| GET    | `/api/users/{id}` | Ver usuario        | Solo Admin   |
| POST   | `/api/users`      | Crear usuario      | Solo Admin   |
| PUT    | `/api/users/{id}` | Actualizar usuario | Solo Admin   |
| DELETE | `/api/users/{id}` | Eliminar usuario   | Solo Admin   |

### Paginación, relaciones, filtros y ordenamiento

```bash
# Para paginar utilizar los parámetros page y per_page
/api/categories?page=1&per_page=5

# Para cargar la relación (en productos - relación category) usar el parámetro with_category
/api/products?page=1&per_page=5&with_category=true
/api/products?with_category=true

# Para el ordenamiento utilizar los parámetros sort_field y sort_direction
/api/products?page=1&per_page=10&sort_field=id&sort_direction=desc
/api/products?sort_field=id&sort_direction=desc

# Para el filtrado utilizar el parámetro search
/api/users?search=admin
```

## 🧪 Pruebas con Postman

1. **Importar colección:** Importa el archivo [postman_collection.json](postman_collection.json)
2. **Configurar environment:** Crea un environment con la variable base_url (con docker = http://localhost, local = http://localhost:8000)
3. **Flujo de pruebas:**
   - Ejecutar "Login Admin" para obtener token de administrador
   - Ejecutar "Login Usuario" para obtener token de usuario
   - Probar endpoints según los permisos de cada rol

## 🏗️ Arquitectura y Patrones

### Decisiones de Diseño

1. **Enum vs Tabla de Roles**

    **Decisión:** Se eligió enum para los roles.

    **Justificación:**
   - Solo se requieren 2 roles fijos (admin/user)
   - No hay necesidad de roles dinámicos
   - Mayor rendimiento al evitar JOINs
   - Simplicidad en validaciones
   - Fácil mantenimiento
   
2. **Middleware Personalizado vs Paquetes**

   **Decisión:** Se implementó middleware personalizado ( AdminMiddleware ).

    **Justificación:**

   - Control total sobre la lógica de autorización
   - No hay dependencias externas innecesarias
   - Simplicidad para solo 2 roles
   - Fácil debugging y mantenimiento
   - Mejor rendimiento

3. **Patrones implementados:**
   - **Repository Pattern:** Abstracción de acceso a datos
   - **Service Pattern:** Lógica de negocio centralizada
   - **Resource Pattern:** Transformación consistente de datos
   - **Form Request Pattern:** Validación centralizada
  
**Beneficios:**
- Separación clara de responsabilidades
- Código reutilizable y testeable
- Fácil mantenimiento y escalabilidad
- Cumplimiento de principios SOLID
