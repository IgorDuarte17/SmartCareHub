## Smart Care Hub

> Projeto para gerenciamento de Pacientes

#### Backend
- PHP 8.2^
- Laravel Framework
- Pest Framework
- Bibliotecas
  - laravel/sanctum
  - prettus/l5-repository
  - darkaonline/l5-swagger
  - predis/predis

#### Database
- MySQL 8.0^

#### Ambiente
- docker-compose
    - php-fpm 8.2
    - nginx
    - MySQL 8
    - Redis
      
#### Link: http://localhost:8000/
---

### Installation

#### Backend
```bash
$ docker-compose build
$ docker-compose up -d
$ docker-compose run php-fpm composer install
$ cp .env.example .env
$ docker-compose exec php-fpm php artisan key:generate
$ docker-compose exec php-fpm php artisan migrate --seed
$ docker-compose exec php-fpm php artisan storage:link
```

#### User
```
email: igor@smart.com.br
password: 1234
```

---

### Documentação
Documentação através do Swagger, para cada nova rota criada, adicionar ela no arquivo de config do 
swagger e informar as configurações.
- https://swagger.io/docs/

Gerar documentação
```bash
$ php artisan l5-swagger:generate
```

Link: http://localhost:8000/api/documentation

---