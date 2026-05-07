# RUTAS API DEL PROYECTO

## Contenido
- [Ruta base](#ruta-base)
- [Proceso](#proceso)
- [Empresas](#empresas)
- [Interfaces](#interfaces)
- [Tipos de cargas](#tipos-de-cargas)

## Ruta base
La ruta base del proyecto es aquel que se mantiene en la raiz.
En Herd puede ser el dominio virtual, para nuestro ejemplo usaremos:
`http://localhost:8000/api` y lo llamaremos como: `{baseURL}`.

## Proceso
El proceso es el primer registro con el que se inicia la configuración y preparación de los archivos para ser exportados a un tabla final.

### Rutas

|Ruta                                   |Método |Descripción                        |
|---------------------------------------|-------|-----------------------------------|
|{baseURL}/process                      |POST   |Crea un proceso nuevo              |
|{baseURL}/process/{id}                 |PUT    |Actualiza un proceso               |
|{baseURL}/process/{id}                 |GET    |Obtiene un proceso                 |
|{baseURL}/process/{id}/files           |GET    |Obtiene los archivos un proceso    |
|{baseURL}/process/{id}/list            |GET    |Lista los procesos paginados       |

## Empresas

### 1. Listar empresas

Es un método GET que muestra todas las empresas registradas en la base de datos.

#### Path example
`{{baseURL}}/company`

#### Request body

```ts
{
    companies: {
        id: string;
        country_id: string;
        code: string;
        name: string;
        responsible: string;
        status: boolean;
    }[]
}
```

### 2. Listar empresas por país
`*GET*` `/api/company/get-companies-by-country`
Es un método GET que muestra todas las empresas registradas en la base de datos que tengan el id del pais en consulta.

#### Path example
`{{baseURL}}/company/get-companies-by-country?country_id={country_id}`

#### ✅ 200 Request body
```ts
{
    "companies": {
        "id": string;
        "country_id": string;
        "code": string;
        "name": string;
        "fantasy_name": string;
        "responsible": string;
        "status": boolean;
    }[]
}
```

#### ❌ 422 Validation errors
```ts
{
    "errors": Record<string, string[]>;
}
```
```json
{
    "errors": {
        "country_id": [
            "El id del país es obligatorio."
        ]
    }
}
```

## Interfaces

### 1. Listar interfaces

Es un método GET que muestra todas las interfaces registradas en la base de datos.

#### Path example
`{{baseURL}}/layout`

#### Request body

```ts
{
    layouts: {
        id: string;
        name: string;
    }[]
}
```

## Tipos de cargas

### 1. Listar tipos de cargas

Es un método GET que muestra todos los tipos de cargas registrados en la base de datos.

#### Path example
`{{baseURL}}/load-type`

#### Request body

```ts
{
    "loadTypes": {
        "id": string;
        "name": string;
    }[]
}
```

## Archivos

### 1. Subir archivos
Es un método POST para subir un array de archivos relacionados a un proceso.

#### Path example
`{baseURL}/uploaded-file`

#### Form data
|Clave          |Tipo   |Descripción                                        |
|---------------|-------|---------------------------------------------------|
|files[]        |file[] |Array de archivos que se quiere subir al sistema   |
|process_config |string |Id del proceso que procesará los archivos.         |

#### Response body

### 2. Actualizar archivo
**`PUT`** /api/uploaded-file/{id}
Es un método PUT para modificar los datos de un archivo relacionados a un proceso.

#### Path example
`{baseURL}/uploaded-file/jhsdfhw745837eyrfodf`

#### Form data
|Clave          |Tipo   |Descripción                                        |
|---------------|-------|---------------------------------------------------|
|files[]        |file[] |Array de archivos que se quiere subir al sistema   |
|process_config |string |Id del proceso que procesará los archivos.         |

#### Response body
```ts
{
    message: string;
    data: {
        id: string;
        fileName: string;
        fileFormat: 'TXT' | 'CSV' | 'XLSX';
        fileSize: number;
        storagePath: string;
        decimalSeparator: ',' | '.' | null;
        fileEncoding: 'UTF-8' | 'Latin1' | 'Windows-1252' | null;
        fileDelimiter: ';' | ',' | '|' | '\t' | null;
        spreadsheet: number | null;
        processConfig: string;
        firstRowHeaders: boolean;
        key: string | null;
        position: number | null;
        validRows: number;
        duplicatedRows: number;
        errorRows: number;
    }[]
}
```