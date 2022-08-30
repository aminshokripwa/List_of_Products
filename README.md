# List_of_Products

Show products details

Requirements
------------

  * PHP 8.0.2 or higher;
  
How to use
------------

- Clone the repository with __git clone__
- Run __composer install__
- Run __symfony server:start
OR
- Run __php bin/console server:run

API to use
------------

Example - GET resource: GET /api/products?page=1&category=boots
```json
{
    "status": "success",
    "allRecords": 5,
    "page": "1",
    "allPage": 1,
    "products": [
        ...
    ]
}

Example - GET resource: GET /api/products?page=1&PriceLessThan=79000
```json
{
    "status": "success",
    "allRecords": 2,
    "page": "1",
    "allPage": 1,
    "products": [
        ...
    ]
}

Example - GET resource: GET /api/products?page=1&category=boots&PriceLessThan=79000
```json
{
    "status": "success",
    "allRecords": 1,
    "page": "1",
    "allPage": 1,
    "products": [
        ...
    ]
}
