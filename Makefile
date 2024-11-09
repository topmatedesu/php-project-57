start:
	php artisan serve --host=0.0.0.0 --port=$(PORT)

install:
	composer install

validate:
	composer validate

lint:
	composer exec --verbose phpcs -- --standard=PSR12 routes