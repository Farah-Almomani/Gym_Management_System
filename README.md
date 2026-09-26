  # Gym_Management_System
A complete web-based Gym Management System built with HTML, CSS, PHP, MySQL, and Bootstrap 5.

## Features
- Members Management: Add, edit, delete, and view members with profile images.
- Trainers Management: Manage trainers with specializations and experience.
- Subscriptions: Track active, expired, pending, and cancelled subscriptions.
- Payments: Record payments with multiple methods (Cash, Credit Card, Bank Transfer).
- Classes: Manage classes with capacity limits, gender-specific sessions, and enrollment.
- Reports: Statistical dashboard with members, trainers, plans, and revenue.
- Notifications: Smart alerts for expiring subscriptions, full classes, and pending payments.
- Authentication: Secure login system with password hashing.

## Technologies Used
- Backend: PHP
- Database: MySQL (MariaDB)
- Frontend: HTML, CSS, Bootstrap 5
- Server: WampServer 64 bit

## Database Schema
The system uses 9 interrelated tables:
- `members`, `trainers`, `classes`, `class_members`
- `membership_plans`, `membership_types`, `subscriptions`, `payments`, `users`

## How to Run
1. Install WampServer and run it as administrator.
2. In www folder create New folder named (Gym_Management_System)  and copy all project files in this folder and create uploads folder for images.
3. Import `mygymdb.sql` into phpMyAdmin.
4. after running click on WampServer icon in the system tray and select "Localhost".
5. in URL open localhost/Gym_Management_System/login.php.
6. Login with:
   - Username: `GymAdmin`
   - Password: `#Admin01`

> Note: Member and trainer images are not included in this repository  for privacy and copyright reasons. You can add your own images in the `uploads/` folder after importing the database.

## Author
Farah Almomani
- GitHub: [@Farah-Almomani](https://github.com/Farah-Almomani)
