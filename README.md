symfony-hexagonal-cqrs
======================

Api Rest with Symfony 5 + Hexagonal Architecture & CQRS.


Installation
------------

1. Execute docker-compose:


    docker-compose up


2. Enter to the container:


    docker exec -it php-app bash


3. Create .env.local configurate emails (EMAIL_ADMIN and EMAIL_FROM) and add this:


    DATABASE_URL="mysql://user:123456@db:3306/magazine?serverVersion=5.7"


4. Execute composer install:


    composer install


5. Execute this command:


    php bin/console lexik:jwt:generate-keypair


6. Run migrations:


    php bin/console doctrine:migrations:migrate


7. Create a new user:


    php bin/console app:create-user user user@email.com 123456 true


7. Run consumer for rabbitmq:


    php bin/console messenger:consume -vv


8. In the browser execute http://localhost:8000
