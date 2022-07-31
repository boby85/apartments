## About

### Laravel Test assessment task
#### API basic documentation


## Usage

- Clone repository
- Run the migrations
- Execute desired request

### Examples:

####GET
Get request for fetching all categories available. No parameters required.

    "name": "get categories",
    "request": {
        "method": "GET",
        "header": [],
        "url": "/api/categories"
####DELETE
Remove category from database. Required parameter is the id of the category which is being removed. URL must contain id of the given category.

    "name": "delete category",
    "request": {
        "method": "DELETE",
        "header": [],
        "url": "/api/category/{id}"

####POST
Stores new apartment into database.

    "name": "store apartment",
    "request": {
        "method": "PUT",
        "header": [],
        "body": {
            "mode": "urlencoded",
            "urlencoded": [
                {
                    "key": "name",
                    "value": "apartment_name",
                },
                {
                    "key": "price",
                    "value": "price_value",
                },
                {
                    "key": "currency",
                    "value": "currency_name",
                },
                {
                    "key": "description",
                    "value": "description (optional)",
                },
                {
                    "key": "properties",
                    "value": "properites_json (optional)",
                },
                {
                    "key": "category_id",
                    "value": "category_id",
                },
                {
                    "key": "rating",
                    "value": "rating (0-5)",
                }
            ]
            "url": "/api/apartment"
        }
    }

### Dummy data:

#### - artisan db:seed --class=CategorySeeder

#### - artisan db:seed --class=ApartmentSeeder
