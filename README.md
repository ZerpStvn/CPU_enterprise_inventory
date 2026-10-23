# CPU Enterprise Inventory

Inventory, reservation and request system for CPU Enterprise, built with PHP and MySQL/MariaDB.

## Run locally

### Requirements

- [Docker Desktop](https://www.docker.com/products/docker-desktop/), started and running

### Install Docker (if you don't have it)

Check first by running this in a terminal:

```bash
docker --version
```

If it prints a version number, skip to [Steps](#steps). If it says the command is not found, install Docker Desktop:

**Windows**

1. Download Docker Desktop from https://www.docker.com/products/docker-desktop/ and run the installer.
2. Keep the **Use WSL 2** option checked when the installer asks.
3. Restart your computer when it finishes.
4. Open Docker Desktop from the Start menu and accept the terms. If it says WSL needs updating, open PowerShell as Administrator, run `wsl --update`, then reopen Docker Desktop.

**macOS**

1. Download Docker Desktop from https://www.docker.com/products/docker-desktop/. Pick **Apple Silicon** for M1/M2/M3/M4 Macs or **Intel** for older Macs.
2. Open the `.dmg` file and drag Docker into Applications.
3. Open Docker from Applications.

**Linux**

Follow the guide for your distribution at https://docs.docker.com/engine/install/. It includes the Docker Compose plugin.

When Docker is running, the whale icon shows in your taskbar or menu bar. Run `docker --version` again to confirm the install worked.

Docker Desktop must be open whenever you run the project. If you see `failed to connect to the docker API`, Docker Desktop isn't running, so start it and try again.

### Steps

1. Open a terminal in the project folder.
2. Build and start the containers:

   ```bash
   docker compose up -d --build
   ```

3. Open **http://localhost:8080** in your browser.

The first start creates the database. The files in [migrations/](migrations/) run in filename order:

- `001_create_schema.sql` creates the tables.
- `002_seed_dev_data.sql` adds the test accounts below and some sample products.

### Temporary login credentials (local only)

| Role    | Email               | Password     |
|---------|---------------------|--------------|
| Admin   | `admin@cpu.local`   | `admin123`   |
| Student | `student@cpu.local` | `student123` |

> These accounts come from `002_seed_dev_data.sql` and are for local development only. Do not load that file on a live server.

### Useful commands

| Task                                 | Command                    |
|--------------------------------------|----------------------------|
| Stop the containers                  | `docker compose stop`      |
| Start them again                     | `docker compose start`     |
| See the app logs                     | `docker compose logs -f app` |
| Reset the database (deletes all data and reruns the migrations) | `docker compose down -v` then `docker compose up -d` |

### Database access

The database is available from your machine for tools like HeidiSQL, DBeaver or MySQL Workbench:

- Host: `localhost`
- Port: `3307`
- User: `root`
- Password: `root`
- Database: `cpuenterprise`

### Configuration

[config.php](config.php) reads `DB_HOST`, `DB_USER`, `DB_PASSWORD` and `DB_NAME` from environment variables, which [docker-compose.yml](docker-compose.yml) sets. Without them it falls back to `localhost` / `root` / no password / `cpuenterprise`, which suits XAMPP.

## Database changes

Put each schema change in a new numbered SQL file in [migrations/](migrations/), for example `003_add_column.sql`. New files only run on a fresh database, so after adding one, reset the database with `docker compose down -v` and `docker compose up -d`.
