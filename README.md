Blinkee project created for recruitment purposes

# after 'git clone <repo>' add "127.0.0.1  project.test" to etc/hosts file

# go to laradock folder
cd laradock/

# in order to run containers:    
sudo docker-compose up -d --build nginx mysql phpmyadmin php-worker workspace

# go to workspace container in order to gain access to artisan commands
docker exec -it laradock_workspace_1 bash

# go to project folder
cd project/

# create database (with custom ruby on rails like style command line) and run migration on it
php artisan db:create blinkee <br />
php artisan migrate

# faking some data and placing them in db
php artisan db:seed 

# set jwt secret in .env
php artisan jwt:secret




# to get to PHPMyAdmin:
http://project.test:8081/index.php <br />
Server: mysql <br />
Username: root <br />
Password: root