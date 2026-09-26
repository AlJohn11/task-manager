# Personal Task Manager

**Project Code:** WST21-PM-2026-SF  
**Student Name:** AL JOHN P. PRITOS   
**Course & Year:** BSIT - 2nd Year, Section IT 2-Sec05  
**Database Used:** Supabase (PostgreSQL)  

## Features
- Add Task
- View Tasks
- Edit Task
- Delete Task
- Update Status (Pending / Completed)

## Built With
This project was built using the Laravel 13 framework running on PHP 8.5. Data is stored in a PostgreSQL database hosted on Supabase, with Blade as the templating engine for the views. Styling is done with custom CSS, and icons are provided by the Lucide icon library.

## How to Run This Project
Follow the steps below to get the project running on your local machine:

- Clone this repository to your computer
- Install the required dependencies using `composer install`
- Duplicate `.env.example`, rename it to `.env`, and fill in your database connection details
- Generate the application key by running `php artisan key:generate`
- Set up the database tables by running `php artisan migrate`
- Start the local development server with `php artisan serve`

Once the server is running, open your browser and go to `http://localhost:8000` to view the app.
