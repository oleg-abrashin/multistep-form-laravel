# Start and build containers, install dependencies, run migrations, build assets, and open the browser
start:
	@echo "Starting the application..."
	@make setup-alias
	@make copy-env
	@make check-dependencies
	@make check-key
	@make migrate
	@make build-assets
	@make check-services
	@make open-browser
	@echo "Application started successfully."

# Check if composer and npm dependencies are installed
check-dependencies:
	@if [ ! -d "./vendor" ]; then \
		./vendor/bin/sail composer install; \
	else \
		echo "Composer dependencies are already installed."; \
	fi
	@if [ ! -d "./node_modules" ]; then \
		./vendor/bin/sail npm install; \
	else \
		echo "NPM dependencies are already installed."; \
	fi
	@./vendor/bin/sail up -d --build

# Copy .env.example to .env if it doesn't exist
copy-env:
	@if [ ! -f .env ]; then \
		echo "Copying .env.example to .env"; \
		cp .env.example .env; \
	fi

# Check if Laravel key exists, generate one if it doesn't
check-key:
	@if ! grep -q "APP_KEY=" .env; then \
		echo "Generating application key"; \
		./vendor/bin/sail artisan key:generate; \
	else \
		echo "Application key already exists."; \
	fi

# Run migrations
migrate:
	@./vendor/bin/sail artisan migrate

# Build frontend assets
build-assets:
	@./vendor/bin/sail npm run build --if-present

# Check if both Laravel and Vite (frontend) are running
check-services:
	@./vendor/bin/sail artisan up || (echo "Laravel failed to start" && exit 1)

# Automatically open the browser to the frontend URL
open-browser:
	@if which xdg-open > /dev/null; then \
		xdg-open http://0.0.0.0/register; \
	elif which open > /dev/null; then \
		open http://0.0.0.0/register; \
	else \
		echo "Could not detect the web browser to open"; \
	fi

# Run tests
test:
	@./vendor/bin/sail test

# Shut down containers
down:
	@./vendor/bin/sail down

# Rebuild containers without cache
rebuild:
	@./vendor/bin/sail build --no-cache

# Restart Sail containers
restart:
	@./vendor/bin/sail down && ./vendor/bin/sail up -d

# Access the MySQL database using Sail
db:
	@./vendor/bin/sail mysql

# Set up Sail alias based on OS
setup-alias:
	@bash ./setup-sail-alias.sh
	@echo "Sail alias created successfully."

# Remove the Sail alias
remove-alias:
	@bash ./remove-sail-alias.sh
	@echo "Sail alias removed successfully."
