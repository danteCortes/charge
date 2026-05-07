# Documentación API de Procesos

## Endpoints

### 1. Guardar un nuevo proceso
`*POST*` `/api/process`
Es un método post que registra un nuevo proceso en la base de datos:

#### Request Body:
```ts
{
    company: string;
    layout: string;
    process_type: string;
    responsible: string;
    template_name: string | null;
}
```
```json
{
    "company": "69f69b02f1fe7572b30d3a62",
    "layout": "69fbc2ed2e3996662d0fb525",
    "process_type": "Flujo",
    "responsible": "Joe Doe",
    "template_name": "Example 1"
}
```
|campo              |Requerido  |tipo                   |descripción|
|-------------------|-----------|-----------------------|---|
|*company*          |✅ si      |string                 |id de un registro en la tabla companies.|
|*layout*           |✅ si      |string                 |id de un registro en la tabla layouts.|
|*process_type*     |✅ si      |enum: Flujo, Refresco  |id de un registro en la tabla layouts.|
|*responsible*      |✅ si      |string                 |responsable del proceso.|
|*template_name*    |❌ no      |string                 |nombre identificador del proceso.|

#### ✅ 201 Response body
```ts
{
    "id": string;
    "company": string;
    "layout": string;
    "process_type": string;
    "responsible": string;
    "template_name": string | null;
    "start_date": string | null;
    "records": number;
    "status": 'Pendiente' | 'En progreso' | 'Pausado' | 'Error' | 'Finalizado' | 'Cancelado';
}
```
```json
{
    "id": "69fbc3f621d30438a2018272",
    "company": "69fbc2ed2e3996662d0fb522",
    "layout": "69fbc2ed2e3996662d0fb525",
    "process_type": "Flujo",
    "responsible": "Dante",
    "template_name": "Template 1",
    "start_date": null,
    "records": 0,
    "status": "Pendiente"
}
```

#### ❌ 422 Response Validation
```ts
{
    "message": string,
    "errors": Record<string, string[]>
}
```
```ts
{
    "message": "El campo empresa es obligatorio. (and 3 more errors)",
    "errors": {
        "company": [
            "El campo empresa es obligatorio."
        ],
        "layout": [
            "El campo interfaz es obligatorio."
        ],
        "process_type": [
            "El campo tipo de proceso es obligatorio."
        ],
        "responsible": [
            "El campo responsable es obligatorio."
        ]
    }
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

### 4. Listar procesos

Es un método GET que muestra los procesos paginados registrados en la base de datos.

#### Path example
```
{baseURL}/process/list?page=1&perPage=10&search=
```

#### Query Params

`page`: Número de página que se quiere listar</br>
`perPage`: cantidad de registros que se require listar en una página</br>
`search`: cadena de texto por el que se quiere filtrar los registros

#### Response body

```ts
{
    total: number,
    perPage: number,
    page: number,
    lastPage: number,
    from: number | null,
    to: number | null,
    items: {
        id: string,
        company_code: string,
        company_name: string,
        company_status: boolean,
        country: string,
        loadType: string,
        layout: string,
        responsible: string,
        templateName: string,
        startDate: string | null,
        records: number
    }[]
}
```

### 5. Obtener archivos

Es un método GET que muestra los archivos relacionados con un proceso registrado en la base de datos.

#### Path example
```
{baseURL}/process/{id}/files
```

#### Path Param

`id`: Id del proceso del que se quiere obtener sus archivos

#### Response body

```ts
{
    importFiles: {
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
