# Student Helpdesk - DBMS Course Project

A PHP and MySQL web application for managing campus support requests. Students can create and track support tickets, while administrators can review tickets and update their status.

## Features

- Role-based authentication with hashed passwords
- Create support tickets with category, priority, and description
- View submitted tickets in a dashboard
- Admin-only ticket status updates
- Normalized relational database using primary and foreign keys
- Persistent ticket and status data using MySQL

## Tech Stack

- PHP
- MySQL / MariaDB
- HTML
- CSS
- PDO
- XAMPP

## Run Locally

1. Install and start Apache and MySQL through XAMPP.
2. Copy this folder to:
   `C:\xampp\htdocs\student-helpdesk-dbms`
3. Open `http://localhost/phpmyadmin`
4. Create a database named `student_helpdesk`.
5. Import `database.sql` into the database.
6. Copy `config.example.php` to `config.php` and update the database credentials if required.
7. Open:
   `http://localhost/student-helpdesk-dbms`
8. Log in using an existing administrator account.

> `config.php` contains local database configuration and is excluded from version control through `.gitignore`.

## Database Design

- `users` 1-to-many `tickets`
- `categories` 1-to-many `tickets`

The `tickets` table uses foreign keys to maintain relationships between users, categories, and support requests.

## Project Overview

Built a role-based student support-ticket system using PHP and MySQL. Designed a normalized relational schema for users, categories, and tickets; implemented secure password hashing, authentication, ticket creation, and admin-controlled status tracking.