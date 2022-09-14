# List of Products By Symfony

Show products details

Requirements
------------

  * PHP 8.0.2 or higher;

Ensure you create directory in your directory.

`git clone https://github.com/aminshokripwa/List_of_Products.git`

How to use
------------

- Run __composer install__
- Run __symfony server:start__

API to use
------------
#symfony.postman_collection.json

Example - GET resource: GET /api/v1/products?page=1&category=boots
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

Example - GET resource: GET /api/v1/products?page=1&PriceLessThan=79000
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

Example - GET resource: GET /api/v1/products?page=1&category=boots&PriceLessThan=79000
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
