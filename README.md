# Car Listing & Filtering Application

A Laravel-based web application that allows users to register, log in, add cars, and filter cars by brand, model, gear type, and fuel type. The application includes dynamic AJAX-based filtering, an image slider, and authentication.

## Features
### Authentication

User registration

User login

User logout

Role selection during registration

### Car Management

Add a new car

Upload multiple images

Store brand, model, gear type, fuel type, mileage, year, color, and price

### Filtering System

Dynamic filters using AJAX:

Brand → Model

Model → Gear Type

Gear Type → Fuel Type

Search results page

### Image Slider

Home-page slider that automatically cycles through cars

Manual next/previous controls

### UI

Responsive, modern CSS

Clean navbar

Styled form components

## File Structure
````
Project/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── SessionController.php
│   │       ├── CarController.php
│   │       └── FilterController.php
├── public/
│   ├── css/
│   │   ├── navbar.css
│   │   └── form.css
│   ├── script/
│   │   └── filter.js
├── resources/
│   └── views/
│       ├── add-car.blade.php
│       ├── login.blade.php
│       ├── register.blade.php
│       ├── show-filter-car.blade.php
│       └── welcome.blade.php
├── routes/
│   └── web.php
├── package.json
└── README.md
````
## Installation
1️⃣ Clone the project
git clone <repository-url>
cd project

2️⃣ Install dependencies
composer install
npm install

3️⃣ Environment setup
cp .env.example .env
php artisan key:generate


Configure .env:

Database name

Storage link

App URL

4️⃣ Run database migrations
php artisan migrate

5️⃣ Build frontend assets
npm run dev

6️⃣ Start the Laravel server
php artisan serve

## Routes Overview
````
Authentication
### Authentication
Method	    Route	        Description
GET	        /register	    Show register page
POST	     /register	    Submit register form
GET	        /login	        Show login page
POST	    /login	        Submit login form
GET	        /logout	        Logout user
### Car Management
Method	    Route	        Description
GET	        /add-car	    Show add car form
POST	    /add-car    	Store new car
### Filtering (AJAX)
Method	    Route	                    Description
GET	        /get-models-by-brand  	    Get models for a brand
GET	        /get-gear-type-by-model	    Get gear types
GET	        /get-fuel-type-by-gear-type	Get fuel types
GET	        /filtered-cars	            Return filtered results
### Home
Method	    Route	    Description
GET	        /	        Display homepage & featured cars slider
````
## Technologies Used
````
Laravel 11

PHP 8+

MySQL

JavaScript / jQuery

Tailwind via Vite

HTML & CSS
````
## Screens Included
````
Pages:

Home

Login

Register

Add Car

Filter Results
````
## License

This project currently has no license.

