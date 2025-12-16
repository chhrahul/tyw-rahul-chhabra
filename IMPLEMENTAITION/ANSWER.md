# ANSWERS.md

## 1. How would you deploy this kind of app?

For deployment, I would separate the backend and frontend.  
The Laravel backend could be deployed on a VPS or cloud service like AWS, DigitalOcean, or Laravel Forge, using Nginx and PHP-FPM.  
The Vue.js frontend would be built and served as static files, either from the same server or a service like Netlify or Vercel.  
For a simple project, Docker would help keep the setup consistent across environments and make deployment easier.

---

## 2. How would you handle caching of frequent API responses?

For frequently requested data (like the bookings list), I would use Laravel’s built-in caching system.  
Responses could be cached using Redis or file-based cache with a short TTL.  
The cache would be cleared or updated whenever a new booking is created or an existing one is modified, so users always see up-to-date data.

---

## 3. If you had more time, what strategies would you think about when building an API?

I would focus on making the API more scalable and maintainable.  
This includes better request validation, consistent API response formats, pagination for large datasets, and proper error handling.  
I would also think about authentication, versioning the API, adding tests, and documenting endpoints clearly so the API is easy to use and extend in the future.
