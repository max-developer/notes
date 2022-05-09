
console:
	docker-compose exec -u $$(id -u) laravel.test bash

dump:
	docker-compose exec -u $$(id -u) mysql mysqldump -h mysql -u root -ppassword laravel > dump.sql
