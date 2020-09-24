Blinkee project created for recruitment purposes

# go to laradock folder
cd laradock/

# in order to run containers:    
sudo docker-compose up -d --build nginx mysql phpmyadmin php-worker workspace

# go to workspace container in order to gain access to artisan commands
docker exec -it laradock_workspace_1 bash

# go to project folder
cd project/

# create database (with custom ruby on rails like style command line) and run migration on it
php artisan db:create blinkee
php artisan migrate

# faking some data and placing them in db
php artisan db:seed 





# to get to PHPMyAdmin:
http://localhost:8081/index.php
Server: mysql
Username: root
Password: root