## Description
### Web-interface database of registered users of the site
A Symfony project

## Create db
+ Create db sibers and use my dump from zip archive: sibers.sql
+ Configuration db connection in file sibers/app/config/parameters.yml

## Deploy from .zip
+ extract project

```cd tz/sibers```

```php bin/console server:run```

[http://localhost:5000/](http://localhost:5000/)

## Deploy from github

```git clone https://github.com/pirateunix/sibers.git```

```cd sibers```

```composer install```

```php bin/console server:run```

[http://localhost:8000/](http://localhost:8000/)




