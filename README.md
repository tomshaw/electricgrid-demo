## Electric Grid Demonstration Application

This repository serves as a demonstration of [ElectricGrid](https://github.com/tomshaw/electricgrid) showcasing how it can be used to generate datatables.

### Setup Instructions

This repository comes with a comprehensive set of database migrations, factories, and seeders that set up a demo online store. This includes a variety of data such as products, customers, orders, and more, providing a realistic and robust dataset for testing and development purposes.

To set up the demo database, you first need to run the migrations which create the necessary tables in your database. This can be done with the following command:

```bash
php artisan migrate
```

After running the migrations, you can use the provided factories and seeders to populate the database with demo data. This can be done with the following command:

```bash
php artisan db:seed
```

This will seed the database with a rich set of data, giving you a ready-to-use environment for testing.
