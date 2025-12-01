# Dr. Dupont – Dental Clinic Web Application (PHP MVC)

This project is a PHP-based web application built using an MVC (Model–View–Controller) architecture. It provides an online appointment-booking system for patients of Dr. Dupont, as well as an admin dashboard for the dentist and clinic staff to manage daily operations.

## Patient Side

Online appointment booking

Service catalogue with descriptions

Clinic news & updates

Opening hours overview

## Admin Dashboard

Accessible only to the dentist and authorized staff.
Key features include:

### Patient Management

View, add, edit, and delete patient records

Access patient contact info and basic profile details

### Appointment Management

View all appointments in a calendar or list format

Add/edit/manage patient bookings

Control available time slots

### News Management

Create and publish clinic updates

Edit or remove news posts

### Services Management

Add or modify dental services (e.g., cleanings, implants, whitening)

Manage descriptions, durations, and prices

### Opening Hours Management

Configure weekly schedules

Define exceptional closures or special openings

## Project Structure (MVC)

The application follows a classic MVC architecture:

- /controllers
- /models
- /views
- /assets
- index.php
- dupont.sql
- script.js
- style.css


Models → manage the data logic and database interactions

Views → display the interface to users (HTML/PHP templates)

Controllers → handle requests, process data, and load appropriate views

## Technologies Used

PHP 8+

MySQL

HTML5 / CSS3 / JavaScript

## Installation & Setup

Clone the repository

```git clone https://github.com/Simon0506/Dr_Dupont.git```

Import the SQL schema into your MySQL database

Ensure the directory is accessible by your web server

Access the site via your browser

Login to the admin area using the credentials you set

### Deployment

This project is hosted in Alwaysdata. To go to the website, use the following URL :

``https://dentiste-dupont.alwaysdata.net``

## Authentication

The admin area is protected by a secure login system.
Only authenticated staff can access appointment management and administrative features.

## Goals of the Project

Provide a simple and efficient way for patients to book appointments

Simplify administrative tasks for the dentist’s team

Maintain a clean, modular, and scalable codebase thanks to MVC separation