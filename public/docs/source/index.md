---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---

# Info

Welcome to the generated API reference.

# Available routes
#general
## Display a listing of the resource.

> Example request:

```bash
curl "http://todo.app//api/tasks" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://todo.app//api/tasks",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
[
    {
        "id": 30,
        "user_id": "1",
        "body": "Second taskhhhh",
        "comple...
```

### HTTP Request
`GET /api/tasks`

`HEAD /api/tasks`


## Display the specified resource.

> Example request:

```bash
curl "http://todo.app//api/tasks/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://todo.app//api/tasks/{id}",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/tasks/{id}`

`HEAD /api/tasks/{id}`


## API Login, on success return JWT Auth token

> Example request:

```bash
curl "http://todo.app//api/authenticate" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://todo.app//api/authenticate",
    "method": "POST",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST /api/authenticate`


## Log out
Invalidate the token, so user cannot use it anymore
They have to relogin to get a new token

> Example request:

```bash
curl "http://todo.app//api/logout" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://todo.app//api/logout",
    "method": "POST",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST /api/logout`


## Refresh the token

> Example request:

```bash
curl "http://todo.app//api/token" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://todo.app//api/token",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/token`

`HEAD /api/token`


## Returns the authenticated user

> Example request:

```bash
curl "http://todo.app//api/authenticated_user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://todo.app//api/authenticated_user",
    "method": "GET",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/authenticated_user`

`HEAD /api/authenticated_user`


## Store a newly created resource in storage.

> Example request:

```bash
curl "http://todo.app//api/tasks" \
-H "Accept: application/json" \
    -d "body"="provident" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://todo.app//api/tasks",
    "method": "POST",
    "data": {
        "body": "provident"
},
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`POST /api/tasks`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    body | string |  required  | Maximum: `255`

## Remove the specified resource from storage.

> Example request:

```bash
curl "http://todo.app//api/tasks/{id}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://todo.app//api/tasks/{id}",
    "method": "DELETE",
        "headers": {
    "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
console.log(response);
});
```


### HTTP Request
`DELETE /api/tasks/{id}`


