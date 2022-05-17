
console:
	docker-compose exec -u $$(id -u) laravel.test bash

dump:
	docker-compose exec -u $$(id -u) mysql mysqldump -h mysql -u root -ppassword laravel > dump.sql

mysql:
	docker-compose exec -u $$(id -u) laravel.test mysql --default-character-set=utf8mb4 -h mysql -u root -ppassword laravel
