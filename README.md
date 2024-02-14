## Electric Grid Demo

This repository serves as a demonstration of ElectricGrid showcasing its capabilities and how it can be used to generate datatables.

## Setup Instructions

1. **Clone the repository**

   First, clone the repository to your local machine:

   ```bash
   git clone https://github.com/tomshaw/electricgrid-demo.git
   ```

2. **Install Dependencies**

   Navigate into the directory of the project which you just cloned, and install PHP and JavaScript dependencies:

   ```bash
   cd electricgrid-demo
   composer install
   npm install
   ```

3. **Environment File**

   Make a copy of `.env.example` file and rename it to `.env`:

   ```bash
   cp .env.example .env
   ```

   Update the `.env` file with your database information.

4. **Generate Application Key**

   Generate a key for your application:

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   Run the database migrations:

   ```bash
   php artisan migrate
   ```

6. **Seed the Database**

   Seed the database with some data:

   ```bash
   php artisan db:seed
   ```

7. **Compile Assets**

   Compile the assets using Laravel Mix:

   ```bash
   npm run dev
   ```

8. **Start the Server**

   Finally, start the Laravel server:

   ```bash
   php artisan serve
   ```

Your application should now be running and accessible at `http://localhost:8000`.

