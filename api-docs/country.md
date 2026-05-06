# Documentación API de Países

## Endpoints

### 1. Listar Países

Retorna una lista de todos los países en la base de datos.

**Endpoint:** `GET /api/country`

**Respuesta:** `200 OK`

```json
{
  "countries": [
    {
      "id": "1",
      "name": "Colombia",
      "alpha2": "CO",
      "alpha3": "COL"
    },
    {
      "id": "2",
      "name": "Argentina",
      "alpha2": "AR",
      "alpha3": "ARG"
    },
    {
      "id": "3",
      "name": "Brasil",
      "alpha2": "BR",
      "alpha3": "BRA"
    }
  ]
}
```

---

### 2. Obtener Empresas por País

Retorna todas las empresas asociadas a un país específico.

**Endpoint:** `GET /api/country/{id}/companies`

**Parámetros:**
- `id` (parámetro de ruta, requerido): El identificador del país

**Respuesta:** `200 OK`

```json
{
  "companies": [
    {
      "id": "1",
      "country_id": "1",
      "code": "RECSA001",
      "name": "Recsa Company S.A.",
      "fantasy_name": "Recsa",
      "responsible": "John Doe",
      "status": true
    },
    {
      "id": "2",
      "country_id": "1",
      "code": "RECSA002",
      "name": "Recsa Logistics S.A.",
      "fantasy_name": "Recsa Logistics",
      "responsible": "Jane Smith",
      "status": true
    }
  ]
}
```

**Respuestas de Error:**
- `404 No Encontrado`: Si el país con el ID especificado no existe
