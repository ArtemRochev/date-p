Install
```
cp docker/env-example docker/.env
cd docker && docker-compose up -d
docker exec php bash -c "composer install"
docker exec php bash -c "php bin/console doctrine:schema:update --force"
```

Parse:
```
POST http://localhost/date/parse
{
    "date": "21.07.1920"
}
```
```
{
    "parsed": "20th 1920 July 21 Wednesday"
}
```
List:
```
GET http://localhost/date
```
```
[
    {
        "id": 4,
        "raw": "21.07.1920",
        "parsed": "20th 1920 July 21 Wednesday",
        "parsed_count": 6
    }
]
```
