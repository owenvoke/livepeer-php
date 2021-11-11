# Ingest API

[Back to the navigation](README.md)

Allows interacting with the Ingest API.

### Get a list of ingest data centers

```php
$response = $client->ingest()->all();
```

### Get details for the closest ingest data center

```php
$response = $client->ingest()->closest();
```
