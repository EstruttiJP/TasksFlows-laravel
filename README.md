### TasksFlow-laravel
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

TasksFlow is an application developed in Laravel with Tailwind CSS, utilizing Laravel Fortify for authentication. The application includes access policies that restrict actions for common users, managers, and administrators. It is a complete system for managing employees, departments, projects, and tasks, with automatic email notifications for assigned or updated tasks.

---

## Index
- [Overview](#overview)
- [Features](#features)
- [Installation](#installation)
- [Configuration](#configuration)
- [Email Configuration Tips](#email-configuration-tips)
- [Usage](#usage)
- [Access Policies](#access-policies)
- [Data Models](#data-models)
- [Contribution](#contribution)
- [License](#license)

---

## Overview
TasksFlow is a web application that facilitates the management of employees, departments, projects, and tasks. Using Laravel Fortify for authentication, the application ensures security and well-defined access policies for different types of users.

## Features
- **Authentication:** Implemented with Laravel Fortify.
- **Employee Management:** Full CRUD for employees/users.
- **Department Management:** Full CRUD for departments.
- **Project Management:** Full CRUD for projects.
- **Task Management:** Full CRUD for tasks.
- **Notifications:** Automatic email notifications to employees when a task is assigned or updated.

## Installation
To install the application, follow these steps:

1. Clone the repository:
   ```sh
   git clone https://github.com/EstruttiJP/TasksFlows-laravel.git
   ```

2. Navigate to the project directory:
   ```sh
   cd TasksFlow-laravel
   ```

3. Install dependencies:
   ```sh
   composer install
   npm install
   ```

4. Copy the `.env.example` file to `.env` and configure your environment variables:
   ```sh
   cp .env.example .env
   ```

5. Generate the application key:
   ```sh
   php artisan key:generate
   ```

## Configuration
Configure the environment variables in the `.env` file, including database and SMTP server settings for email sending.

## Email Configuration Tips
To ensure proper email sending using Gmail, it is recommended to create an application-specific password. Follow these steps:

1. **Access Google Account Settings:**
   - Go to https://myaccount.google.com/.
   - Log in to your Google account if you haven't already.

2. **Enable Two-Factor Authentication:**
   - Go to **Security** > **Two-Factor Authentication** and enable it.

3. **Create an Application-Specific Password:**
   - After enabling two-factor authentication, go to **Security** > **App Passwords**.
   - Select **Other (Custom name)** and enter a name like "Laravel SMTP".
   - Click **Generate** and copy the generated password.

4. **Update the `.env` file with the generated password:**
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD="your-application-specific-password"
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your-email@gmail.com
   MAIL_FROM_NAME="${APP_NAME}"
   ```

5. **Clear Configuration Cache:**
   ```sh
   php artisan config:cache
   ```

Following these steps, email sending should work correctly.

## Usage
Run the application locally:
```sh
php artisan serve
```

Access `http://localhost:8000` in your browser.

## Access Policies
- **COMMON_USER:** Cannot create or edit (`edit`) anything, nor delete (`destroy`) anything.
- **MANAGER:** Cannot delete (`destroy`) anything.
- **ADMIN:** Has full access and can perform all actions.

## Data Models
### Users (Employees)
Relationships:
- **Departments:** 1-N (one department can have many users)
- **Tasks:** N-N (one user can be associated with many tasks)
- **Roles:** N-N (one user can have many roles)

### Departments
Relationships:
- **Users:** 1-N (one department can have many users)
- **Projects:** 1-N (one department can have many projects)

### Projects
Relationships:
- **Departments:** N-1 (many projects belong to one department)
- **Tasks:** 1-N (one project can have many tasks)

### Tasks
Relationships:
- **Projects:** N-1 (many tasks belong to one project)
- **Users:** N-N (many tasks can be associated with many users)

## Contribution
Contributions are welcome! To contribute, follow these steps:
1. Fork the project.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Make your changes and commit them (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a pull request.
