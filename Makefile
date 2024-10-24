# Start and build containers, install dependencies, run migrations, build assets, fix permissions, and open the browser
start:
	@echo "Starting the application..."
	@make setup-alias
	@make copy-env
	@make check-dependencies
	@make ensure-sail-running
	@make check-key  # Ensure the key is generated before proceeding
	@make fix-permissions
	@make create-missing-directories
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

# Attempt to ensure Sail is running
ensure-sail-running:
	@if ! docker ps | grep -q 'laravel.test'; then \
		echo "Sail is not running. Attempting to start Sail..."; \
		./vendor/bin/sail up -d || (echo "Failed to start Sail. Please try './vendor/bin/sail up' manually." && exit 1); \
	else \
		echo "Sail is running."; \
	fi

# Copy .env.example to .env if it doesn't exist
copy-env:
	@if [ ! -f .env ]; then \
		echo "Copying .env.example to .env"; \
		cp .env.example .env; \
	fi

# Check if Laravel key exists, generate one if it's missing or empty
check-key:
	@if ! grep -q "APP_KEY=" .env || grep -q "APP_KEY=$$" .env; then \
		echo "Generating application key"; \
		./vendor/bin/sail artisan key:generate; \
	else \
		echo "Application key already exists."; \
	fi

# Fix permissions for storage and cache directories
fix-permissions:
	@echo "Fixing storage and cache directory permissions..."
	@./vendor/bin/sail exec laravel.test chmod -R 777 storage bootstrap/cache

# Create missing directories for storage and cache
create-missing-directories:
	@echo "Creating missing storage and cache directories..."
	@./vendor/bin/sail exec laravel.test mkdir -p storage/framework/cache/data
	@./vendor/bin/sail exec laravel.test mkdir -p storage/framework/sessions
	@./vendor/bin/sail exec laravel.test mkdir -p storage/framework/views
	@./vendor/bin/sail exec laravel.test mkdir -p bootstrap/cache

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
