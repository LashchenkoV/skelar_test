# Hello world

Hello dear reviewer.
Here is the solution of your test task for the job interview.
I would like to start by discussing the main framework and technologies used for this project.
* Laravel 10
* PHP 8.*
* Laravel Breeze Starter Pack
* Laravel Sanctum
* Inerthia
* Vuetify
* Vue3

NOTE: when you open the backend, you will see that the file structure is different compared to a standard Laravel app.
Porto (a software architectural pattern) was employed. For more information, visit https://github.com/Mahmoudz/Porto#porto-software-architectural-pattern.
I would use this approach in my work, as it has proven to be the most effective solution for project management.
To quickly begin implementation of business logic, I have replicated the core pattern implementation from the demo application created by the Porto-Apiato developer team.
While it is not my preferred choice, this approach is highly effective for these types of tasks.
## Install

To install the project, you will need Docker. Please install it using the instructions found at https://docs.docker.com/desktop/.Next, please do following instruction:
* Once completed, copy this repository to your local machine by using the command ` git clone https://github.com/LashchenkoViktor/skelar_test.git`
* Enter to root directory of the project and run
  `cp .env.example .env`
* Run docker containers `docker-compose up -d`
* Install dependencies `docker-compose exec laravel.test composer install`
* Stop docker containers `docker-compose stop`
* Run `vendor/laravel/sail/bin/sail up`
* `vendor/laravel/sail/bin/sail php artisan key:generate`
* `vendor/laravel/sail/bin/sail php artisan migrate`
* `vendor/laravel/sail/bin/sail npm i`
* ` vendor/laravel/sail/bin/sail npm run dev`
* Go to http://localhost

If you have any questions, please contact me.
