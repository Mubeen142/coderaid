# Code Raid Web Tool
This tool helps you code raid in Rust. Create a session, invite friends and start raiding. The codes are sorted from most used to least used.

# Requirements
- PHP 8.2 or above
- webserver
- Database such as MySQL
- curl, zip and unzip
- composer v2

# Installation

1. Upload the project to your server and cd into it
2. Follow the commands below

```
  # Create a .env file
  cp .env.example .env

  # Download neccessary dependencies using composer
  composer install --optimize-autoloader

  # Generate a new encryption key !! ONLY DO THIS FOR FIRST INSTALL !!
  php artisan key:generate --force
```

3. Now edit your .env file and setup the database connection, then migrate the database

```ssh
php artisan migrate --seed
```

The application is now installed and setup
