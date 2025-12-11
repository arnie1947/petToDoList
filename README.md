<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<p align="center">
  <img src="./lav12_todolist.jpg" alt="Project Screenshot" width="500"/>
</p>

## Pet Project: "To Do List"

This is a pet project: to do list application based on Laravel 12 (Breeze with blade templates).

### Features

- Users can add arbitrary text descriptions of tasks.

- Users can maintain a list with unlimited items.

- Users can edit previously added tasks.

- Users can delete tasks.

- Users can mark tasks as completed without removing them from the list.

- The application provides registration and authorization functionality, and each user only sees tasks from their own list.

- An unregistered and unauthorized user is able to add items to their list; 

- Upon revisiting the application, the unregistered  user sees the previously entered information and continue working with it (provided they have not cleared cookies/cache or changed their browser, i.e., the application is technically able to recognize them).

- Upon user registration guest tasks are added to the user account. The same occurs upon user login.

## How To Install

- clone this repository

- Setup Environment:
```bash
cp .env.example .env
```
Open .env and configure database connection (use MySQL database). Please note that this project setup expects that the application URL is localhost.

- Istall the project:
```bash
composer install
```

- Install Frontend Dependencies:
```bash
npm install
```

- Create Database tables:
```bash
php artisan migrate
```

- Generate CSS:
```bash
npm run dev
```

- Enjoy!

#### Environment Requirements

- Node.js (v.20.19+) & NPM installed
- PHP ≥ 8.2
