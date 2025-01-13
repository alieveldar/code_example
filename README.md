# Sample Yii2 TODO app

## Setup

Should be as straightforward as: 

```
docker-compose up -d
```

### Troubleshooting: 

To check PHP container logs: 
```
docker-compose logs -f php
```

`runtime` folder is internal, so not visible directly from host. In order to check logs: 
```
docker-compose exec php cat /app/runtime/logs/app.log
```
or 
```
docker-compose exec php tail -f -n +0 /app/runtime/logs/app.log
```
# Example API call

curl -X PUT 'http://localhost:8000/api/todo/1' -H 'Content-Type: application/json' --data-binary '{"done":1}'
