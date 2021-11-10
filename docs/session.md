# Session API

[Back to the navigation](README.md)

Allows interacting with the Session API.

### Get a list of sessions

```php
$response = $client->sessions()->all();
```

### Get a list of sessions with a specific parent id

```php
$response = $client->sessions()->withParentId('abcdefg-hijklmn-opqrs-tuvwxyz');
```

### Get a list of recorded sessions

```php
$response = $client->sessions()->recorded('abcdefg-hijklmn-opqrs-tuvwxyz');
```

### Get details for a session by its id

```php
$response = $client->session()->show(
    'abcdefg-hijklmn-opqrs-tuvwxyz'
);
```
