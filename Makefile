# Start and build containers, install dependencies, run migrations, and build assets
start:
	@echo "Starting the application..."
	@make setup-alias
	@make copy-env
	@make install
	@make generate-key
	@make migrate
	@make build-assets
	@echo "Application started successfully. Visit http://0.0.0.0/"

# Install dependencies using Sail
install:
	@./vendor/bin/sail up -d --build
	@./vendor/bin/sail composer install
	@./vendor/bin/sail npm install

# Copy .env.example to .env if it doesn't exist
copy-env:
	@if [ ! -f .env ]; then \
		echo "Copying .env.example to .env"; \
		cp .env.example .env; \
	fi

# Generate Laravel application key
generate-key:
	@./vendor/bin/sail artisan key:generate

# Run migrations
migrate:
	@./vendor/bin/sail artisan migrate

# Build frontend assets
build-assets:
	@./vendor/bin/sail npm run build

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
