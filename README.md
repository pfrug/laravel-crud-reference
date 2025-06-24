# Descripción General

Este proyecto es una demostración funcional de la arquitectura propuesta por CGI, desarrollada con Laravel 12. Sirve como referencia inicial y no representa el alcance final del sistema real.
La arquitectura está diseñada para aplicaciones desacopladas, orientadas a servicios, y con un enfoque en buenas prácticas de desarrollo backend.
Esta demo implementa un CRUD completo para entidades de tipo **cliente**, expuesto a través de una API RESTful. La intención principal es demostrar una estructura limpia, coherente y extensible para aplicaciones modernas.

---

## Funcionalidad Incluida

### Clientes (CRUD)

- Gestión completa de clientes: alta, baja, modificación y consulta.
- Validaciones robustas usando **Form Requests**, incluyendo validaciones personalizadas (como NIF español).
- Serialización de modelos mediante **Laravel API Resources** para estructurar la salida JSON.
- Lógica de negocio aislada mediante clases de servicio (**Services**).
- Uso de **eventos y listeners** para ejecutar lógica desacoplada como el envío de correos.
- Envío automático de correo de bienvenida al crear un cliente (**WelcomeClientMail**).
- Arquitectura desacoplada en capas, alineada con principios **SOLID**.
- Tests automatizados con **PHPUnit** para garantizar funcionalidad y estabilidad.

---

## Endpoints disponibles

### Autenticación

- `POST /api/login` — Inicio de sesión usando JWT.
- `GET /api/me` — Obtener información del usuario autenticado.
- `POST /api/logout` — Cierre de sesión.

### Datos auxiliares

- `GET /api/countries` — Listado de países.
- `GET /api/client-groups` — Grupos de clientes.
- `GET /api/payment-terms` — Condiciones de pago.
- `GET /api/sales-reps` — Representantes de ventas.

### Gestión de Clientes

- `GET /api/clients` — Listado paginado de clientes.
- `POST /api/clients` — Crear un nuevo cliente.
- `GET /api/clients/{id}` — Ver un cliente específico.
- `PUT /api/clients/{id}` — Actualizar cliente completo.
- `PATCH /api/clients/{id}` — Actualización parcial.
- `DELETE /api/clients/{id}` — Eliminar cliente.

---

## Arquitectura y Buenas Prácticas Aplicadas

- **Form Requests**: encapsulan reglas de validación reutilizables.
- **API Resources**: controlan la transformación de modelos antes de exponerlos al cliente.
- **Services**: encapsulan la lógica de negocio, manteniendo los controladores delgados y simples.
- **Events & Listeners**: desacoplan acciones secundarias como notificaciones o tareas asincrónicas.
- **Queued Mailables**: los correos electrónicos son enviados a través del sistema de colas de Laravel, evitando bloqueos durante la ejecución de peticiones HTTP. El envío de mails, como el correo de bienvenida al crear un cliente, se maneja mediante `Mailable` encolados, configurados para ejecutarse en segundo plano mediante `queue()`.

---

## Setup Inicial

1. Instalar dependencias:
   ```bash
   composer install
   ```

2. Configurar entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

3. Ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```

4. Levantar entorno local con Docker (Laravel Sail):
   ```bash
   ./vendor/bin/sail up -d
   ```

---

## Ejecutar los tests

```bash
./vendor/bin/phpunit
```
