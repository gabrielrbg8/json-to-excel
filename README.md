# Json to Excel With Laravel 7
## _A simple API with exportation models to csv file._

[![Build Status](https://travis-ci.org/joemccann/dillinger.svg?branch=master)](https://travis-ci.org/joemccann/dillinger)

This boilerplate will be useful for anyone who wants to create a REST API in Laravel with a Docker environment.
To create it, we use:

- :elephant: Laravel 7 :elephant:
- :dolphin: MySQL :dolphin:
- :whale: Docker :whale:
- :chart: TDD :chart:

## Get Started

- Make a git clone of the project
- Up the containers in Docker with:
   ```sh
        docker-compose up -d --build
   ```
- Rename .env.example file to .env, then make the changes:
   ```sh
        DB_HOST=YOUR_MYSQL_CONTAINER_IP //ex:172.0.0.2 
            - To get container ip, run the follow command in cmd: docker inspect -f '{{range.NetworkSettings.Networks}}{{.IPAddress}}{{end}}' container_name_or_id
        QUEUE_CONNECTION=database //to queue stay listening the jobs
   ```
- Run the following commands from a terminal:
    ```sh
         docker-compose restart
         docker-compose exec app composer install
         docker-compose exec app php artisan migrate:fresh --seed
         docker-compose exec app php artisan apidoc:generate
    ```
                     A new php development server will be started in: localhost:8000
                     
                    To make testing easier, the seeders created User records, which is 
                    an "exportable" model, so to test the export, just run the following command:
   ```sh
        docker-compose exec app php artisan exportable:export \\App\\Models\\User
   ```
                    If we have Users that not have exported, it generates a CSV file with User's data 
                    in the follow path: storage/app/public/laravel-excel.
                    
                    To view API documentation, access: localhost:8000/doc


## External packages and services

This project is currently extended with the following packages and services.
Instructions on how to use them in your own app are linked below.

| Plugin | Doc |
| ------ | ------ |
| Laravel Excel | https://docs.laravel-excel.com/3.1/getting-started/ |
| Laravel API Doc Generator | https://beyondco.de/docs/laravel-apidoc-generator/getting-started/installation |
| EloquentFilter | https://github.com/Tucker-Eric/EloquentFilter |
| Laravel Fractal | https://fractal.thephpleague.com/ |

## Development

#### Want to contribute? Great!

This project can grow even more with your contribution! 
Suggestions are always welcome!


## License

MIT

**Free Software, Hell Yeah!**
