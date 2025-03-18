.PHONY: app-composer-check app-composer-fix app-cs-check app-cs-fix app-install app-security-check app-static-analysis \
        app-test app-test-with-code-coverage

default: help

help:
	@grep -E '^[a-zA-Z_-]+:.*?##.*$$' $(MAKEFILE_LIST) | sort | awk '{split($$0, a, ":"); printf "\033[36m%-30s\033[0m %-30s %s\n", a[1], a[2], a[3]}'

infra-up:
	cd docker && docker-compose up -d

app-shell:
	docker exec -ti docker-php-1 bash

app-composer-check: ## to validate Composer config
	composer validate

app-cs-check: ## to launch php-cs-fixer in dry mode
	vendor/bin/php-cs-fixer fix --allow-risky yes --dry-run --diff --verbose

app-cs-fix: ## to launch php-cs-fixer
	vendor/bin/php-cs-fixer fix --allow-risky yes --verbose

app-install: ## to install dependencies
	composer install --prefer-dist

app-security-check: ## to check if any security issues in the PHP dependencies
	composer audit

app-static-analysis: ## to run static analysis
	vendor/bin/phpstan analyze --memory-limit=-1

app-test: ## to launch phpunit to test app
	vendor/bin/phpunit --fail-on-warning

app-test-with-code-coverage: ## to run unit tests with code-coverage
	vendor/bin/phpunit --fail-on-warning --coverage-filter --colors=never