# Descripción General

Este proyecto es una demostración básica de cómo estructurar aplicaciones Laravel utilizando una arquitectura en capas. Está desarrollado con Laravel 12 y tiene como objetivo servir como guía para implementar buenas prácticas en proyectos reales.
La demo incluye un CRUD completo para la entidad cliente, expuesto a través de una API RESTful, y presenta una estructura modular orientada a servicios, validaciones formales, eventos y colas para tareas desacopladas.

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

## Capas de Arquitectura

Esta demo busca servir como referencia práctica para estructurar aplicaciones Laravel con una arquitectura en capas. Las capas implementadas no son generadas por defecto por el framework, sino incorporadas manualmente para fomentar un diseño modular, mantenible y escalable.
Cada componente (servicios, eventos, validaciones, etc.) está aislado según su responsabilidad, lo que facilita la evolución del sistema, el trabajo en equipo y la implementación de pruebas automatizadas.

- **Events**: para emitir acciones del sistema de forma desacoplada.
- **Listeners**: capturan y manejan eventos, como el envío de correos.
- **Mail**: definición de correos estructurados usando Mailables, enviados encolados para evitar bloqueos durante la petición HTTP.
- **Services**: lógica de negocio encapsulada, separada del controlador.
- **Rules**: validaciones personalizadas para campos complejos.
- **Helpers**: funciones auxiliares reutilizables en todo el sistema.
- **Http**:
  - `Requests`: validaciones encapsuladas vía FormRequest.
  - `Resources`: transformación de modelos a estructuras JSON controladas.
- **Providers**: configuración personalizada, como el `EventServiceProvider`.

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
   ./vendor/bin/sail build
   ./vendor/bin/sail up -d
   ```

---

## Ejecutar los tests

```bash
./vendor/bin/phpunit
```

---
## Colección de Postman
Colección de Postman disponible para consulta y prueba de los endpoints expuestos por la API:
postman/AS400_demo.postman_collection.json
