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


# Test task

Please add optimistic record locking feature to existing simple Yii2 TODO app

Concurrent editing should be prevented using optimistic locking by version field. It is important to use version field, not just comparing old vs new data. If user A opens edit page for an item, then another user B modifies item and saves it, and then user A clicks save, then following message should appear "Conflict, item was changed by another user, your changes will be lost. [Edit again] [Cancel]". ([Edit again] and [Cancel] are buttons, [Edit again] should reload form with current data from the database, and [Cancel] should return user to the homepage)

## API access to the DONE field

A single API endpoint is exposed to mark items as done/not done by ID. Please see README.md for API call example. 

Optimistic locking should not be applied to this API endpoint: if user A opens item for editing, then API call is made to mark this item as done, then user A clicks save (done checkbox is off on the form), no error message should appear, item should be saved, item's done status should be reset to false. 