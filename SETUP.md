# Laravel Project Setup

This is a **Laravel project** using **Tailwind CSS**, **Laravel Breeze**, and other essential tools for a smooth development experience. Follow these steps to set it up and run it locally.

---

## Prerequisites

Before starting, make sure you have these installed:

1. **PHP** (8.1 or higher) – [Download PHP](https://www.php.net/downloads)  
2. **Composer** – [Download Composer](https://getcomposer.org/download/)  
3. **Node.js & npm** – [Download Node.js](https://nodejs.org/)  
4. **MySQL or MariaDB** – [Download MySQL](https://dev.mysql.com/downloads/)  
5. **Git** (optional) – [Download Git](https://git-scm.com/downloads)  

---

## Step-by-Step Setup

### 1. Clone the project
    git clone <your-repo-url>
    cd <your-project-folder>

### 2. Install PHP dependencies
    composer install

### 3. Install Node dependencies
    npm install

### 4. Compile frontend assets (Tailwind CSS, JS)
    npm run build

### 5. Run database migrations
    php artisan migrate

### 6. Seed the database (if you have seeders)
    php artisan db:seed --class=<SeederFileName>

## 7. Generate PHP key
    php artisan key:generate

## 8. Install packages
    composer install
    npm install
    npm run build

## 9. Run npm
    npm run dev

## 10. Start the web
    php artisan serve










