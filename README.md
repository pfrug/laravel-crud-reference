# Descripción General

Este proyecto es una demostración funcional de la arquitectura propuesta por CGI, desarrollada con Laravel 12. Sirve como referencia inicial y no representa el alcance final del sistema real.
La arquitectura está diseñada para aplicaciones desacopladas, orientadas a servicios, y con un enfoque en buenas prácticas de desarrollo backend.
Esta demo implementa un CRUD completo para entidades de tipo **cliente**, expuesto a través de una API RESTful.

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

Con esta demo se pretende establecer una guía de referencia para la implementación de una arquitectura en capas recomendada para el desarrollo del sistema final. El objetivo es ilustrar cómo estructurar un proyecto Laravel utilizando componentes desacoplados que favorezcan la escalabilidad, la mantenibilidad y la separación de responsabilidades. Estas capas, agregadas manualmente sobre la estructura básica del framework, representan una forma de organización que facilita el trabajo en equipo, las pruebas automatizadas y la evolución del sistema a largo plazo.

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
