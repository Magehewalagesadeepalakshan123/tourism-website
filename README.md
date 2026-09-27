# 🌴 Travel Lanka - Tourism Management System

Travel Lanka is a web-based tourism management system developed to help users explore popular travel destinations in Sri Lanka and manage their travel bookings through a simple and user-friendly platform.

The system provides user registration and authentication, destination browsing, booking management, booking cancellation, booking status tracking, demo payment processing, and an administrator dashboard for managing users, bookings, and payments.

> **Academic / Portfolio Project**

---

# ✨ Features

## 👤 User Features

- User registration and login
- Secure user authentication
- Browse tourist destinations
- View detailed information about destinations
- Create travel bookings
- View personal bookings
- Cancel pending bookings
- Track booking status
- Proceed with payment after admin approval
- View completed payments
- Secure logout

---

## 🌍 Destination Features

Users can explore popular Sri Lankan destinations including:

- Ella
- Sigiriya
- Kandy
- Nuwara Eliya
- Galle
- Mirissa

Each destination contains detailed travel information and booking options.

---

## 📅 Booking Features

The booking system allows users to:

- Select a destination
- Enter traveller information
- Select a travel date
- Select the number of travellers
- Add special requests
- Submit bookings
- View booking status

### Booking Status Flow

```text
Pending
   ↓
Approved
   ↓
Payment
   ↓
Completed


Other possible booking states:
Pending → Cancelled
Pending → Declined

💳 Payment Features
- Demo payment processing
- Multiple demonstration payment methods
- Payment amount automatically calculated
- Payment details stored in the database
- Completed payments update booking status
- Prevention of duplicate completed payments
- Payment history available to administrators
The payment module is for demonstration purposes only and does not process real financial transactions.

🛠️ Administrator Features
Administrators can:
- Access a protected admin dashboard
- View registered users
- View all bookings
- Approve bookings
- Decline bookings
- Monitor pending bookings
- View completed bookings
- View cancelled bookings
- View customer payments
- Monitor total payment revenue
- Logout securely
📊 Admin Dashboard
The administrator dashboard displays:
- Registered Users
- Total Bookings
- Pending Bookings
- Approved Bookings
- Completed Bookings
- Declined Bookings
- Cancelled Bookings
- Total Revenue
💻 Technologies Used
Frontend
- HTML5
- CSS3
- JavaScript
- Responsive Web Design
Backend
- PHP
Database
- MySQL / MariaDB
Development Tools
- XAMPP
- Apache
- phpMyAdmin
- Visual Studio Code
- Git
- GitHub
📁 Project Structure
tourism-website/
│
├── css/
│   └── style.css
│
├── images/
│
├── js/
│
├── pages/
│   ├── home.php
│   ├── destinations.php
│   ├── destination-details.php
│   ├── booking.php
│   ├── my-bookings.php
│   ├── payment.php
│   ├── admin-dashboard.php
│   ├── admin-bookings.php
│   ├── admin-users.php
│   └── admin-payments.php
│
├── php/
│   ├── db.php
│   ├── auth_check.php
│   ├── admin_auth.php
│   ├── login_process.php
│   ├── logout.php
│   ├── register_process.php
│   ├── booking_process.php
│   ├── cancel_booking.php
│   ├── payment_process.php
│   └── update_booking_status.php
│
├── database/
│   └── travel_lanka.sql
│
├── screenshots/
│
├── index.php
└── README.md

📸 Project Screenshots
🔐 Login Page
 
🏠 Home Page
 
🌍 Destinations Page
 
📍 Destination Details
 
🧳 Travel Packages
 
📅 Booking Page
 
📋 My Bookings
 
💳 Payment Page
 
✅ Completed Payment
 
🛠️ Administrator Screenshots
📊 Admin Dashboard
 
📋 Manage Bookings
 
👥 Registered Users
 
💰 Payment Management
 
🗄️ Database
The system uses three main database tables:
Users
Stores user account information and administrator roles.
Bookings
Stores customer booking information, travel dates, destinations, traveller details and booking status.
Payments
Stores completed demo payment information.