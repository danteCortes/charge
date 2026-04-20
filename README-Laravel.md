# 🍃 Backend – Laravel 11 · API RESTful

> Proyecto Full Stack · Backend con Arquitectura Hexagonal, Modular y Factory Method

---

## 🗂️ Estructura de Archivos

```
src/
├── app/
│   ├── Modules/
│   │   ├── User/
│   │   │   ├── Domain/                 ← Entidades, Value Objects, Interfaces (Puertos)
│   │   │   │   ├── Entities/
│   │   │   │   ├── ValueObjects/
│   │   │   │   └── Contracts/          ← UserRepositoryInterface, UserServiceInterface
│   │   │   ├── Application/            ← Casos de uso, DTOs, Factories
│   │   │   │   ├── UseCases/
│   │   │   │   │   ├── CreateUserUseCase.php
│   │   │   │   │   └── FindUserUseCase.php
│   │   │   │   ├── DTOs/
│   │   │   │   │   └── UserDTO.php
│   │   │   │   └── Factories/
│   │   │   │       └── UserFactory.php
│   │   │   ├── Infrastructure/         ← Adaptadores: Eloquent, Repositorios concretos
│   │   │   │   ├── Repositories/
│   │   │   │   │   └── UserMongoRepository.php
│   │   │   │   └── Models/
│   │   │   │       └── UserModel.php
│   │   │   └── Http/                   ← Controladores, Requests, Resources
│   │   │       ├── Controllers/
│   │   │       │   └── UserController.php
│   │   │       ├── Requests/
│   │   │       │   └── CreateUserRequest.php
│   │   │       └── Resources/
│   │   │           └── UserResource.php
│   │   ├── Auth/
│   │   │   └── ... (misma estructura)
│   │   └── Product/
│   │       └── ... (misma estructura)
│   └── Shared/
│       ├── BaseRepository.php
│       ├── BaseUseCase.php
│       └── Traits/
│           └── ApiResponse.php
├── routes/
│   └── api.php
├── config/
│   └── database.php
├── database/
│   └── seeders/
└── .env
```

---

## 🏛️ Arquitectura

### Hexagonal (Puertos y Adaptadores)

El **dominio** no depende de ningún framework. Las interfaces (puertos) están en `Domain/Contracts/` y las implementaciones concretas (adaptadores) viven en `Infrastructure/`.

```
[HTTP Request]
     │
     ▼
[Controller] ──► [UseCase] ──► [Domain Entity]
                    │
                    ▼
             [RepositoryInterface]  ← Puerto
                    │
                    ▼
          [MongoRepository]         ← Adaptador (Eloquent / MongoDB)
```

### Modular

Cada módulo (`User`, `Auth`, `Product`, ...) es un **bounded context** autocontenido. Puedes agregar o eliminar módulos sin tocar otros.

### Responsabilidad Única (SRP)

| Clase | Única responsabilidad |
|---|---|
| `UserController` | Recibir la request HTTP y delegar |
| `CreateUserUseCase` | Orquestar la creación de un usuario |
| `UserMongoRepository` | Persistir/recuperar en MongoDB |
| `UserFactory` | Construir instancias de `User` |

### Factory Method

Centraliza la construcción de objetos complejos:

```php
// app/Modules/User/Application/Factories/UserFactory.php
class UserFactory
{
    public static function fromRequest(CreateUserRequest $request): User
    {
        return new User(
            id: UserId::generate(),
            email: new Email($request->email),
            name: $request->name,
        );
    }
}
```

---

## ⚙️ Stack Tecnológico

| Herramienta | Versión | Rol |
|---|---|---|
| PHP | 8.3 | Lenguaje base |
| Laravel | 11.x | Framework principal |
| MongoDB Atlas | Cloud | Base de datos |
| mongodb/laravel-mongodb | 4.x | Driver ODM |
| Laravel Sanctum | 3.x | Autenticación API |
| Eloquent | nativo | ORM / ODM |

---

## 🧪 Calidad de Código

### Laravel Pint — Code Style

Formateador oficial de Laravel basado en PHP-CS-Fixer. Mantiene un estilo consistente en todo el proyecto sin discusiones sobre formato.

```bash
composer require laravel/pint --dev

# Formatear todo el proyecto
./vendor/bin/pint

# Ver cambios sin aplicar
./vendor/bin/pint --test
```

Configuración en `pint.json`:
```json
{
    "preset": "laravel",
    "rules": {
        "single_quote": true,
        "array_syntax": { "syntax": "short" }
    }
}
```

### PHPUnit / Pest — Tests Unitarios

Tests unitarios e integración para UseCases, Repositorios y DTOs. La arquitectura hexagonal facilita testear el dominio **sin base de datos real** usando mocks.

```bash
# Ejecutar todos los tests
php artisan test

# Con Pest (sintaxis fluida)
./vendor/bin/pest

# Solo tests unitarios
php artisan test --testsuite=Unit
```

Ejemplo de test de un UseCase:
```php
// tests/Unit/User/CreateUserUseCaseTest.php
it('creates a user successfully', function () {
    $repo = Mockery::mock(UserRepositoryInterface::class);
    $repo->shouldReceive('save')->once();

    $useCase = new CreateUserUseCase($repo);
    $result = $useCase->execute(new CreateUserDTO('John', 'john@example.com'));

    expect($result)->toBeInstanceOf(User::class);
});
```

---

## ✅ Ventajas de este Stack

- **Dominio aislado** – la lógica de negocio no depende de Laravel ni de MongoDB.
- **Testeable** – los UseCases se prueban con mocks de los repositorios, sin BD real.
- **Intercambiable** – cambiar MongoDB por PostgreSQL solo implica crear un nuevo adaptador.
- **Escalable** – cada módulo puede crecer o moverse a un microservicio de forma independiente.
- **Onboarding rápido** – un nuevo dev solo necesita entender un módulo a la vez.

---

## 🔧 Recomendaciones

1. **Define contratos primero** – escribe las interfaces en `Domain/Contracts/` antes de implementar.
2. **Valida en Form Requests** – nunca en el controlador directamente.
3. **Proyecta en MongoDB** – usa `select()` o `project()` en aggregations para no traer campos innecesarios.
4. **Variables de entorno** – todas las credenciales en `.env`, nunca hardcodeadas.
5. **Respuestas consistentes** – usa el trait `ApiResponse` para normalizar éxitos y errores.

---

## 🚀 Próximos Pasos

- [ ] Fase 1 – Configurar GitHub Actions para CI/CD
- [ ] Fase 1 – Dockerizar la aplicación (`docker-compose.yml`)
- [ ] Fase 1 – Escribir tests unitarios para los UseCases
- [ ] Fase 2 – Completar flujo de autenticación con Sanctum
- [ ] Fase 2 – Configurar índices en Atlas + Aggregation Pipelines
- [ ] Fase 3 – Generar documentación OpenAPI / Swagger
- [ ] Fase 3 – Implementar Rate Limiting y Logging estructurado
- [ ] Fase 3 – Deploy en Railway / Render

---

## 📦 Instalación

```bash
git clone <repo>
cd backend-laravel

composer install
cp .env.example .env
php artisan key:generate

# Configurar MONGODB_URI en .env
php artisan serve
```

---

> Arquitectura: Hexagonal · Modular · SRP · Factory Method
