# RUTAS API DEL PROYECTO

## Ruta base
La ruta base del proyecto es aquel que se mantiene en la raiz.
En Herd puede ser el dominio virtual, para nuestro ejemplo usaremos:
`http://localhost:8000/api` y lo llamaremos como: `{baseURL}`.

## Proceso
El proceso es el primer registro con el que se inicia la configuración y preparación de los archivos para ser exportados a un tabla final.

### Rutas

|Ruta                                   |Método |Descripción                        |
|---------------------------------------|-------|-----------------------------------|
|{baseURL}/process-config               |POST   |Crea un proceso nuevo              |
|{baseURL}/process-config/{id}          |PUT    |Actualiza un proceso               |
|{baseURL}/process-config/{id}          |GET    |Obtiene un proceso                 |
|{baseURL}/process-config/{id}/files    |GET    |Obtiene los archivos un proceso    |

### 1. Guardar un nuevo proceso

Es un método post que registra un nuevo proceso en la base de datos:

#### Request Body:

```ts
{
    "company": string | null;
    "load_type": string | null;
    "layout": string | null;
    "responsible": string | null;
    "template_name": string | null;
}
```

* __company:__ id de un registro en la tabla companies.
* __load_type:__ id de un registro en la tabla load_types.
* __layout:__ id de un registro en la tabla layouts.
* __responsible:__ responsable del proceso.
* __template_name:__ nombre identificador del proceso.

#### Response body

```ts
{
    "id": string;
    "company": string | null;
    "loadType": string | null;
    "layout": string | null;
    "responsible": string | null;
    "templateName": string | null;
    "startDate": string | null;
    "records": number;
    "status": 'Pendiente' | 'En progreso' | 'Pausado' | 'Error' | 'Finalizado' | 'Cancelado';
}
```

#### Response Validation
```ts
{
    "message": string,
    "errors": Record<string, string[]>
}
```

### 2. Actualizar un proceso

Es un método put que modifica los valores de un proceso en la base de datos:

#### Path Params

`id`: id del proceso que se quiere modificar

#### Request Body:

```ts
{
    "company": string | null;
    "load_type": string | null;
    "layout": string | null;
    "responsible": string | null;
    "template_name": string | null;
}
```

* __company:__ id de un registro en la tabla companies.
* __load_type:__ id de un registro en la tabla load_types.
* __layout:__ id de un registro en la tabla layouts.
* __responsible:__ responsable del proceso.
* __template_name:__ nombre identificador del proceso.

#### Response body

```ts
{
    "id": string;
    "company": string | null;
    "loadType": string | null;
    "layout": string | null;
    "responsible": string | null;
    "templateName": string | null;
    "startDate": string | null;
    "records": number;
    "status": 'Pendiente' | 'En progreso' | 'Pausado' | 'Error' | 'Finalizado' | 'Cancelado';
}
```

#### Response Validation
```ts
{
    "message": string,
    "errors": Record<string, string[]>
}
```

### 3. Mostrar un proceso

Es un método get que muestra los valores de un proceso en la base de datos:

#### Path Params

`id`: id del proceso que se quiere modificar

#### Response body

```ts
{
    "id": string;
    "company": string | null;
    "loadType": string | null;
    "layout": string | null;
    "responsible": string | null;
    "templateName": string | null;
    "startDate": string | null;
    "records": number;
    "status": 'Pendiente' | 'En progreso' | 'Pausado' | 'Error' | 'Finalizado' | 'Cancelado';
}
```