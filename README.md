# Weather-Application

Instructions on running the application

1. Clone the repository
2. Go to backend folder -> run "composer install" and "php artisan key:generate", finally run "php artisan serve"
3. On separate terminal, go to frontend folder -> run "npm install", then "npm run dev"
4. Enjoy the application

<!-- UI and UX implementation -->
Regarding my UI and UX implementation, it is fully responsive to all devices. It maximizes the functionality of tailwind css and it is user friendly.
It uses Vue.js for the frontend with the addition of Pinia store for data management and hydration

<!-- Code Implementation  -->
The Backend uses the service pattern to organize and encapsulate business logic into separate classes.
This pattern helps in keeping controllers thin and focused on handling HTTP requests, improving the maintainability, testability, and readability of your codebase.
It also uses Laravel resource to make the response data easier to use and modify
