## About Project.

This project has a [Kernel](./app/Kernel/Kernel.php) which handles the whole cycle of the Application, also [Router system](./app/Kernel/Route) and [HTTP Request](./app/Kernel/Request) are important in handling a request.  

## About Services.

The main [service (url shortener service)](./app/Services/UrlShortener) implemeted to encode and dedcode a URL,
it has a simple algorithm to encode and short URLs.


## How to run.

Please make sure that your database and [.env](./.env) file before running the Application.

 ```angular2html
php -S 127.0.0.1:8001

# then the application is accessible with below link:

127.0.0.1:8081/link-shortener
```

## Database.
I put some dumps below so you can use them to easily setup your database.
```angular2html
create database if not exists application;

create table links
(
    id bigint auto_increment primary key,
    link mediumtext not null,
    encoded_link varchar(255) not null,
    created_at timestamp default now(),
    updated_at timestamp default now()
);

create table users
(
    id bigint auto_increment primary key,
    email varchar(255) unique not null
);
```
