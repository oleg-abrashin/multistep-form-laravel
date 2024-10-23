
# StreamPlus Onboarding Form - Laravel Setup

This project is a test task to create a multi-step user onboarding form for a subscription service (StreamPlus) using Laravel 11, Docker, and MySQL. The form dynamically adjusts steps based on user subscription types and allows navigation without losing progress.

## Requirements
- Docker
- Docker Compose

## Setup Instructions

### 1. Clone the repository
```bash
git clone git@github.com:oleg-abrashin/multistep-form-laravel.git
cd multistep-form-laravel
```

### 2. Set up the Sail Alias

Before running the project, you need to set up the Sail alias. The Makefile includes a step to handle this automatically, but first, ensure that the `setup-sail-alias.sh` script is executable. Run the following command:

```bash
chmod +x setup-sail-alias.sh
```

This will give the script the necessary permissions to execute.

### 3. Build and start the Docker containers

Once the alias setup is complete, start the application by running:

```bash
make start
```

This will perform the following tasks:
- **Set up** the Sail alias.
- **Copy** `.env.example` to `.env` (if `.env` doesn't already exist).
- **Build** and start Docker containers.
- **Install** all dependencies (Laravel, MySQL, Redis).
- **Run** database migrations.
- **Build** frontend assets.

Once completed, the application will be accessible at [http://0.0.0.0/](http://0.0.0.0/).

### 4. Access the Application

After the setup is complete, open the following URL in your browser:

```bash
http://0.0.0.0/
```

### 5. Running Tests

You can run the PHPUnit tests inside the Docker container using the following command:

```bash
make test
```

This will run all the test cases for the project using PHPUnit.

### 6. Building Frontend Assets

If you need to re-build the frontend assets (e.g., after making changes to JS/CSS), you can do so by running:

```bash
make build-assets
```

### 7. Stopping the Application

To stop the running Docker containers, use:

```bash
make down
```

This will gracefully shut down the containers.

### 8. Rebuild Containers Without Cache

If you need to rebuild the Docker containers without using cache (for example, after changing Docker configurations), run:

```bash
make rebuild
```

### 9. Access the Database

To access the MySQL database within the Sail environment, run:

```bash
make db
```

This will start a MySQL session using Sail.

### 10. Troubleshooting

If you encounter any issues during the setup process, try the following steps:
1. Ensure Docker is running.
2. Rebuild the containers using `make rebuild`.
3. Ensure the necessary environment variables are set up correctly in the `.env` file.
4. Verify your Docker logs for any potential issues by running `docker-compose logs`.

---

## Important Notes
1. **MySQL Database**: The project uses MySQL as the database. Ensure that the `.env` file has the correct database credentials to match those in the `docker-compose.yml` file.
2. **Redis**: The project also uses Redis for queue management.
3. **Xdebug**: Xdebug is pre-configured to work with Docker and is exposed on port `9003` for debugging purposes.

---

## Makefile Overview

| Command       | Description                                                   |
| ------------- | ------------------------------------------------------------- |
| `make start`  | Set up Sail alias, build containers, install dependencies, run migrations, and build assets |
| `make install`| Build and start containers, and install dependencies           |
| `make migrate`| Run the Laravel migrations                                     |
| `make test`   | Run the PHPUnit tests                                          |
| `make build-assets`| Build the frontend assets using NPM                       |
| `make down`   | Stop all Docker containers                                     |
| `make rebuild`| Rebuild the containers without cache                           |
| `make db`     | Access the MySQL database inside the Docker container          |

---

### Final Checks Before Submission

1. **Clone the project** to a new directory and follow the README steps to simulate the reviewer's experience.
2. **Verify everything** is working, including the containers, migrations, and application accessibility at [http://0.0.0.0/](http://0.0.0.0/).
3. **Run tests** using `make test` to ensure the application's core functionality works as expected.

---

Now you're ready to deploy and use the application! 🎉
