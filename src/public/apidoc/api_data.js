define({ "api": [
  {
    "type": "get",
    "url": "/user/:id",
    "title": "Obtém os dados de um usuário",
    "name": "GetUser",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador do usuário.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Usuario",
            "optional": false,
            "field": "usuario",
            "description": "<p>Dados do usuário</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user",
    "title": "Obtém lista de usuários registrados",
    "name": "GetUsers",
    "group": "User",
    "version": "1.0.0",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Array",
            "optional": false,
            "field": "user",
            "description": "<p>Lista de usuários</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "post",
    "url": "/user",
    "title": "Armezana dados de um usuário",
    "name": "PostUser",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "name",
            "description": "<p>Nome do usuário.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email do usuário.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Senha do usuário.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Integer",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador do usuário.</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "HTTP/1.1 200 OK\n{\n  \"name\": \"John\",\n  \"email\": \"john@doe.com\"\n}",
          "type": "json"
        }
      ]
    },
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  },
  {
    "type": "get",
    "url": "/user/:id",
    "title": "Atualiza os dados de um usuário",
    "name": "UpdateUser",
    "group": "User",
    "version": "1.0.0",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador do usuário.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Number",
            "optional": false,
            "field": "id",
            "description": "<p>Identificador do usuário.</p>"
          }
        ]
      }
    },
    "filename": "app/Http/Controllers/UserController.php",
    "groupTitle": "User"
  }
] });
