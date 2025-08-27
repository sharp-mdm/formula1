include .env

PROJECT_DIR := $(notdir $(CURDIR))
SAIL := ./vendor/bin/sail

help:
	@echo ""
	@echo "Commands:"
	@echo ""
	@echo "  make install       - Set up the project after cloning or copying the Git repository"
	@echo "  make up            - Run project docker containers"
	@echo "  make stop          - Stop project docker containers"
	@echo ""

install:
	cp .env.example .env
	composer install
	php artisan sail:install
	$(SAIL) up -d
	make wait-db --no-print-directory

	$(SAIL) php artisan migrate

	@make print-link --no-print-directory

up:
	$(SAIL) up -d

	@make print-link --no-print-directory

stop:
	$(SAIL) stop

test:
	$(SAIL) php artisan test tests/Feature/ApiResponseTest.php
	$(SAIL) php artisan test tests/Unit/LapRelationTest.php

wait-db:
	@while ! (docker ps | grep -q -E '$(PROJECT_DIR)-mysql-[0-9]+' && \
			  docker volume ls | grep -q -E '$(PROJECT_DIR)_sail-mysql'); do \
		echo "Wait for the MySQL container and volume to be ready."; \
		sleep 2; \
	done

	@until $(SAIL) exec mysql mysqladmin ping -h127.0.0.1 -u"$(DB_USERNAME)" -p"$(DB_PASSWORD)" --silent > /dev/null 2>&1; do \
		echo "Wait MySQL up"; \
		sleep 2; \
	done

print-link:
	@echo ""
	@echo "Site link: http://localhost"
	@echo ""
