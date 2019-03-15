# My project

## SYSTEM REQUIREMENT

* DB: MySQL 5.6 
* Apache: 2.4 
* PHP: 7.0
* Laravel: 5.7 
* Composer: 1.4.1

## TEMPLATE

* Admin LTE 2.4.5
* W3 School

## VENDOR

* Bootstrap 3.3.7 
* Fontawesome 4.7
* Jquery 3
* Jquery UI 1.12.1
* Jquery select2 4.0.6
* Jasny bootstrap 3.1.3
* Bootstrap datepicker 1.6.4
* Bootstrap datetimepicker (eonasdan)
* iCheck
* Google font

## SETUP

* Clone
```bash
git clone https://github.com/hoangpham2395/xedimotchieu.git
```

* Permission
```bash
chmod -R 777 public/images
chmod -R 777 public/media
chmod -R 777 public/tmp
```

* Run
```bash
composer install
cp .env.example .env (CMD: copy .env.example .env)
php artisan key:generate
```

* Open file .env and config database
```bash
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
```

* Run migration
```bash
php artisan migrate
```

* Run seeder
```bash
php artisan db:seed
```

* Delete cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

* Install Form collective 5.4.0
```bash
composer require "laravelcollective/html":"^5.4.0"
```

* Install L5-Repository (Prettus)
```bash
composer require prettus/l5-repository
```

* Install Doctrine dbal for migration
```bash
composer require doctrine/dbal
```

* Upload file
- Create folder tmp, media in public

## CONFIG URL

* C:\Windows\System32\drivers\etc\hosts
```bash 
127.0.0.1 dev.xdmc.vn
```

* C:\xampp\apache\conf\extra\httpd-vhosts.conf
```bash 
<VirtualHost *:80>
    DocumentRoot "{LOCAL_HTDOCS}\xedimotchieu\public"
    ServerName dev.xdmc.vn
</VirtualHost>
<VirtualHost *:443>
    DocumentRoot "{LOCAL_HTDOCS}\xedimotchieu\public"
    ServerName dev.xdmc.vn
    SSLEngine on
    SSLCertificateFile "C:\xampp\apache\conf\ssl.crt\server.crt"
    SSLCertificateKeyFile "C:\xampp\apache\conf\ssl.key\server.key"
</VirtualHost>
```

## RUN IN BROWSER

```bash 
dev.xdmc.vn
```