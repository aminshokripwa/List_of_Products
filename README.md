# List_of_Products

Show products details

Requirements
------------

  * PHP 8.0.2 or higher;
  
How to use
------------

- Run __composer install__
- Run __symfony server:start__

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
``` 

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
``` 

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
