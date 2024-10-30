This project is a Laravel application that demonstrates the use of large-scale database seeding. The seeder generates 50,00,000 posts, each with associated comments, to simulate a high-volume dataset for testing purposes.

Requirements
------------

*   **PHP** >= 8.1
    
*   **Composer**
    
*   **Laravel** >= 8.x
    
*   **Database**: MySQL or any other database supported by Laravel
    

Installation
------------

Follow the steps below to set up and run this project locally.

### Step 1: Clone the Repository

Clone this repository to your local machine:

```
git clone https://github.com/CoderMdAkash/Large-Data-Import.git

```

### Step 2: Install Dependencies

Install all required dependencies with Composer:

```
composer install

```

### Step 3: Configure Environment

Create a copy of the .env file and update the database configuration:

```
cp .env.example .env

```

In the .env file, set up your database connection details:

```
DB_CONNECTION=mysql  DB_HOST=127.0.0.1  DB_PORT=3306  DB_DATABASE=your_database_name  DB_USERNAME=your_database_user  DB_PASSWORD=your_database_password

```

Generate an application key:

```
php artisan key:generate

```

### Step 4: Run Migrations

Create the necessary database tables by running the migrations:

```
php artisan migrate

```

### Step 5: Seed the Database

Run the seeder to generate 50,000 posts, each with a random number of comments:

```
php artisan db:seed --class=PostsWithCommentsSeeder

```

**Error:** Find Your Log file laravel.log in storage->logs folder

> **Note:** The seeding process may take some time depending on your system's performance.

Project Structure
-----------------

*   **Database Migrations**: posts and comments tables are created with a foreign key relationship.
    
*   **Seeder**: PostsWithCommentsSeeder generates posts with comments for testing large datasets.
    

Troubleshooting
---------------

*   **Memory Limits**: If the seeder exceeds memory limits, increase the memory\_limit in your php.ini file.
    
*   **Database Timeouts**: If you encounter database timeout issues, try running the seeder on a local database or reduce the dataset size temporarily for testing.