# Brik — Construction Website & Admin Panel

**Building dreams, one Brik at a time.**

A construction company website with an interactive 3D hero, a project portfolio, and a PHP/MySQL admin panel. This showcase follows both sides of the project: how visitors discover the company and how administrators maintain its content and customer enquiries.

[Features](#features) · [Website tour](#website-tour) · [Admin panel](#admin-panel) · [Tech stack](#tech-stack)

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/home.png" alt="Brik homepage with a construction hero, calls to action, and an interactive yellow hard-hat model" width="760">

## The project

Brik presents construction services and completed work in one website. Visitors can explore the company, browse services and projects, and send an enquiry. The administration interface provides screens for updating that content and reviewing incoming messages.

The design combines dark backgrounds, orange and yellow accents, construction photography, and clear calls to action. An interactive hard-hat model adds a 3D element to the homepage.

## Features

| Public website | Admin panel |
| --- | --- |
| Interactive 3D hero with camera controls | Login with password verification and PHP sessions |
| Company introduction, video, and testimonials | Dashboard presentation with summary cards and charts |
| Database-driven services with icons and display ordering | Create, edit, delete, order, and show or hide services |
| Project carousel with images, descriptions, and dates | Manage projects and upload project images |
| Contact form that saves customer enquiries | Review leads, mark them answered, and open Gmail compose |
| Mobile navigation, scroll animations, and back-to-top control | Sidebar navigation between management screens |

Service and project updates appear on the public website. Contact messages are saved to the database and displayed in Leads; replies are composed manually in Gmail.

## Website tour

All ten original screenshots appear in this README: the homepage above, four additional website sections below, and five admin screens.

### About the company and testimonials

The company introduction brings together an embedded video, key selling points, a project enquiry button, and client testimonial cards.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/about-and-testimonials.png" alt="Brik about section with a video, company information, and client testimonials" width="760">

### Construction services

Service cards use icons, titles, and descriptions to explain the company's offering. A quote request button leads visitors to the contact section.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/services.png" alt="Construction services including housing, maintenance, ceramics, and water installation" width="760">

### Completed projects

An image-led carousel presents residential, commercial, renovation, and roofing projects with their descriptions and completion dates.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/projects.png" alt="Completed projects carousel with photographs, project names, dates, and descriptions" width="760">

### Contact form and footer

Visitors can find the company's address, phone, and email, then submit an enquiry using their name, email address, subject, and message.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/contact.png" alt="Brik contact section with address, phone, email, enquiry form, and site footer" width="760">

## Admin panel

### Login

The login screen accepts an admin username and password. This screenshot shows the feedback displayed after an unsuccessful attempt.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/admin-login.png" alt="Admin login form displaying invalid-credentials feedback" width="760">

### Dashboard

Summary cards and Chart.js charts provide a dashboard overview. The displayed statistics are sample data used to demonstrate the interface.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/admin-dashboard.png" alt="Brik admin dashboard with summary cards, website views chart, and monthly leads chart" width="760">

### Customer leads

Submitted enquiries appear in a table with contact information, the message, submission date, and response status.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/admin-leads.png" alt="Admin Leads screen showing an enquiry and its answered status" width="760">

### Service management

Administrators can maintain service descriptions and icons, set display order, and choose which entries are visible on the website.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/admin-services.png" alt="Admin service management table with edit and delete controls and an add-service form" width="760">

### Project management

The project screen combines a list of existing work with controls for editing entries and adding new projects with images, descriptions, and dates.

<img src="https://raw.githubusercontent.com/Kledi-Rremi/Constructionwebsite/c2d213d0945740729a5e54085a4ae43d2e0013db/docs/screenshots/admin-projects.png" alt="Admin project management screen with thumbnails, descriptions, dates, and an add-project form" width="760">

## Tech stack

| Layer | Technologies |
| --- | --- |
| Front end | HTML, CSS, vanilla JavaScript |
| Back end | PHP, PDO, MySQL / MariaDB |
| Website interactions | Swiper, ScrollReveal, Google `<model-viewer>` |
| Admin interface | Material Dashboard styles, Bootstrap, Chart.js |
| Icons and fonts | Remix Icon, Google Material icons, Google Fonts |
| Development environment | XAMPP with Apache and MySQL |

## What the project demonstrates

- Building a responsive company portfolio with interactive visual elements.
- Rendering services and projects from database records.
- Connecting a customer contact form to an administrative enquiry workflow.
- Creating interfaces for managing content and uploading project images.
- Combining PHP back-end logic with JavaScript carousels, animation, and charts.

## Author

Created by [Kledi Rremi](https://github.com/Kledi-Rremi).
