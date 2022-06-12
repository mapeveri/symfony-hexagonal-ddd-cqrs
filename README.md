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


        bin/console lexik:jwt:generate-keypair


6. Run migrations:


        bin/console doctrine:migrations:migrate


7. Create a new user:


         bin/console app:create-user user user@email.com 123456 true


8. In the browser execute http://localhost:8000


Rabbit configuration and consumers

1. Configure exchange and queues in rabbitmq:
    
        bin/console app:domain-events:rabbitmq:configure

2. Consume events of a queue, example:

        bin/console app:domain-events:rabbitmq:consume app.magazine.post.post_projection_on_post_was_created_event_handler 200

3. For production, generate supervisor consumer files configurations:

         bin/console app:domain-events:rabbitmq:generate-supervisor-files


To check elasticsearch data:


   http://localhost:9200/magazine/_search