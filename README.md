## Electric Grid Demonstration Application

This repository serves as a demonstration of [Electric Grid](https://github.com/tomshaw/electricgrid) showcasing how it can be used to generate datatables. It comes with a comprehensive set of database migrations, factories, and seeders that set up a demo online store.

### Setup Instructions

Before running the seeder make sure to update your `.env` file with the following settings. 

> Refer to the `UserTableSeeder` to understand how these values are used.

```env
DB_SEED_NAME="Full Stack Developer"
DB_SEED_EMAIL="placeholder@email.com"
DB_SEED_PASSWORD=""
```

Next you can use the provided factories and seeders to populate the database.

```bash
php artisan db:seed
```

This will give you a ready-to-use environment for testing.

### Contributing

Run the following command before running composer install if you wish to have a `local repository clone` to make pull requests.

> Note: Refer to the bottom of the composer file to understand how this works.

```bash
git clone git@github.com:tomshaw/electricgrid.git packages/electricgrid
```
