## Electric Grid Demonstration Application

This repository serves as a demonstration of [ElectricGrid](https://github.com/tomshaw/electricgrid) showcasing how it can be used to generate datatables. It comes with a comprehensive set of database migrations, factories, and seeders that set up a demo online store. This includes a variety of data such as products, customers, orders, and more, providing a realistic and robust dataset for testing and development purposes.

### Setup Instructions

Before running the database seeder make sure to update your `.env` file with the following settings. 

> Note: Refer to the `UserTableSeeder` to understand how these values are used.

```env
DB_SEED_NAME="Full Stack Developer"
DB_SEED_EMAIL="placeholder@email.com"
DB_SEED_PASSWORD=""
```

After running the migrations, you can use the provided factories and seeders to populate the database with demo data.

```bash
php artisan db:seed
```

This will seed the database with a rich set of data, giving you a ready-to-use environment for testing.

### Contributing

Run the following command before running composer install if you wish to make pull requests.

```bash
git clone git@github.com:tomshaw/electricgrid.git packages/electricgrid
```
