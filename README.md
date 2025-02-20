<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Simple Ecommerce Order Management System

<p>A simple backend order management API developed in Laravel to handle products and order management, maintain data integrity, and ensure basic security. This project allows users to create product, retrieve product, list products, and implement product search filters among other functionalities.</p>

## Features
<ul>
<li>User Registration & Authentication: Users can register and authenticate to access endpoints.</li>
<li>CRUD Operation for products</li>
<li>Filters: Implement product search with filters</li>
<li>Pagination.</li>
<li>Unit & Feature Tests: Includes automated tests for key functionalities.</li>
</ul>

## Prerequisites
Ensure you have the following installed:
<ul>
<li>PHP (>= 8.0)</li>
<li>Composer</li>
<li>MySQL or SQLite (or any other supported database)</li>
<li>Laravel CLI (optional, but recommended)</li>
<li>Getting Started</li>
<li>Follow these steps to set up the project on your local machine.</li>
</ul>

1. Clone the Repository<br/>

git clone https://github.com/temitayo315/simple-order-management-assessment.git<br/>
cd simple-order-management-assessment

2. Install Dependencies
`composer install`

3. Set Up Environment Configuration
Copy the example environment file and configure it for your local setup:

cp .env.example .env<br/>
Open .env and update the following environment variables to match your database setup:
dotenv
<br/>
DB_CONNECTION=mysql<br/>
DB_HOST=127.0.0.1<br/>
DB_PORT=3306<br/>
DB_DATABASE=order-management<br/>
DB_USERNAME=your_username<br/>
DB_PASSWORD=your_password<br/>

4. Generate Application Key

`php artisan key:generate`

5. Run Migrations
This will create the necessary tables in the database.

`php artisan migrate`

6. Run Seeders
This will seed the demo created users and products in the database.

`php artisan db:seed`
## Running the Application
To start the development server:

`php artisan serve`
The application should now be running at http://127.0.0.1:8000.

API Endpoints
1. User Registration<br/>
Endpoint: POST /api/user/store<br/>
Description: Registers a new user.
Request Body:
json

Response: Returns the newly created user details.<br/>

2. User Login<br/>
Endpoint: POST /api/login<br/>
Description: Logs in the user and returns an access token.
Request Body:
json
Response:
json
{
  "token": "access_token_string"
}<br/>

3. Create a Product<br/>
Endpoint: POST /api/store<br/>
Description: Allows users to create a product.
Headers: Authorization: Bearer {access_token}
Request Body:
json


Response: Returns product details if successful.<br/>

4. Retrieve Product<br/>
Endpoint: GET /api/products<br/>
Description: Returns the user’s current balance.
Headers: Authorization: Bearer {access_token}
Response:
json


## Running Tests
This project includes feature tests to verify the functionality and correctness of the system.

1. Configure Test Database
Edit the .env.testing file to set up a test database (for SQLite, you can use an in-memory database):

dotenv
DB_CONNECTION=sqlite<br/>
DB_DATABASE=:memory:<br/>

2. Run Tests<br/>
Run the following command to execute all tests:

`php artisan test`
<b>Key Test Cases</b>
- User Registration: Verifies that users can register and log in.<br/>
- Authentication: Ensures only authenticated users can access transaction and balance endpoints.<br/>
- Transaction Processing: Tests both deposit and withdrawal functionality, ensuring correct balance updates.<br/>
- Balance Retrieval: Ensures that the correct balance is returned for each user.<br/>

## Scaling and Production Considerations
For a production setup and scalability improvements, consider the following:
<ol>
<li>Database Scaling: Use partitioning or sharding strategies as user count grows.</li>
<li>Queueing System: Implement job queues (e.g., with Redis) for handling high-frequency transactions asynchronously.</li>
<li>Caching: Cache balance data using Redis to reduce database load on high-read operations.</li>
<li>Load Balancing: Use load balancers to distribute requests across multiple instances of the application.</li>
<li>Containerization: Deploy the application in containers (e.g., Docker) for easier scaling and environment management.</li>
</ol>

## Troubleshooting
Common issues and fixes:

Database Connection Errors: Ensure your database configuration in .env is correct and that the database server is running.
Migration Errors: If you encounter migration issues, try running php artisan migrate:fresh to reset the database and apply migrations again.
Authentication Issues: Ensure that the access token is sent in the Authorization header when accessing protected endpoints.