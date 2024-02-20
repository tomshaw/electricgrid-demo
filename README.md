## Electric Grid Demonstration Application

This repository serves as a demonstration of [ElectricGrid](https://github.com/tomshaw/electricgrid) showcasing how it can be used to generate datatables.

### Setup Instructions

This repository comes with a comprehensive set of database migrations, factories, and seeders that set up a demo online store. This includes a variety of data such as products, customers, orders, and more, providing a realistic and robust dataset for testing and development purposes.

To set up the demo database, you first need to run the migrations which create the necessary tables in your database. This can be done with the following command:

```bash
php artisan migrate
```

## Configuration for Testing

Before running the database seeder make sure to update your `.env` file with the following settings: These settings are added for convience only and meant to be used only once. 

> Please refer to the `UserTableSeeder` to understand how these values are used.

```env
DB_SEED_NAME="Full Stack Developer"
DB_SEED_EMAIL="placeholder@email.com"
DB_SEED_PASSWORD="9vGt4#RfZ!7Q"
```

After running the migrations, you can use the provided factories and seeders to populate the database with demo data. This can be done with the following command:

```bash
php artisan db:seed
```

This will seed the database with a rich set of data, giving you a ready-to-use environment for testing.
