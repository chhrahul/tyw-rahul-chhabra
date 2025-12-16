
# Mini Booking App

This is a simple mini booking application where users can view existing bookings and add new bookings.  
The app is built using **Laravel** for the backend and **Vue.js** for the frontend.

---

## Features

- Display a list of bookings
- Add a new booking via a form
- Backend validation for all fields
- Simple, responsive UI using Tailwind CSS
- Optional: Filter bookings by date or yacht name

---

## Prerequisites

Make sure you have the following installed:

- PHP >= 8.1 (you have 8.2.27)
- Composer (you have 2.8.5)
- Node.js >= 18 and npm or yarn (you have npm 10.9.3)
- Git (for version control)

---

## Setup Instructions

### 1. Clone the repository

```bash
git clone https://github.com/your-username/tyw-firstname-lastname.git
cd tyw-firstname-lastname/IMPLEMENTATION
````

---

### 2. Backend Setup (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate   # generate SQLite database
php artisan serve
```

The backend server will start at:

```
http://127.0.0.1:8000
```

---

### 3. Frontend Setup (Vue.js)

Open a new terminal, then run:

```bash
cd frontend
npm install
npm run dev
```

The frontend development server will start as shown in the terminal output.

---

## Notes

* Ensure both backend and frontend servers are running simultaneously.
* Update environment variables in `.env` if required.
* API endpoints are served from the Laravel backend.

