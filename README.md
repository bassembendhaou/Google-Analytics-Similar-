# ANALYTICS

This is a tracking module for web pages similar to google analytics.

#####  Getting started	



 1- Clone the repository

```
 git clone https://github.com/bassembendhaou/Google-Analytics-Similar-.git
```
2- Switch to the repo folder

```
 cd Google-Analytics-Similar-
```
3- Install all the dependencies using composer

```
 composer install
```
4- Run the database migrations **(Set the database connection in .env before migrating)**

```
 php artisan migrate
```

5- Start the local development server

```
php artisan serve
```

6- Run the database seeder, and you're done

```
php artisan db:seed
```

#####  Extra installed packages 

1- stevebauman/location :   **https://github.com/stevebauman/location**
I used this package to detect country from IP @.
2- jenssegers/agent : **https://github.com/jenssegers/agent**
I used this package to detect DEVICE TYPE from IP @.
