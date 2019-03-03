# My base

## SYSTEM REQUIREMENT

* DB: MySQL 5.6 
* Apache: 2.4 
* PHP: 7.0
* Laravel: 5.7 
* Composer: 1.4.1

## TEMPLATE

* Admin LTE 2.4.5

## VENDOR

* Bootstrap 3.3.7 
* Fontawesome 4.7
* Jquery 3
* Jasny bootstrap
* Bootstrap datepicker 1.6.4
* iCheck
* Google font

## SETUP

* Clone
```bash
git clone https://github.com/hoangpham2395/mybase.git
```

* Permission
```bash
chmod -R 777 public/images
chmod -R 777 public/media
chmod -R 777 public/tmp_uploads
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

## CONFIG URL

* C:\Windows\System32\drivers\etc\hosts
```bash 
127.0.0.1 dev.mybase.vn
```

* C:\xampp\apache\conf\extra\httpd-vhosts.conf
```bash 
<VirtualHost *:80>
    DocumentRoot "{LOCAL_HTDOCS}\mybase\public"
    ServerName dev.mybase.vn
</VirtualHost>
<VirtualHost *:443>
    DocumentRoot "{LOCAL_HTDOCS}\mybase\public"
    ServerName dev.mybase.vn
    SSLEngine on
    SSLCertificateFile "C:\xampp\apache\conf\ssl.crt\server.crt"
    SSLCertificateKeyFile "C:\xampp\apache\conf\ssl.key\server.key"
</VirtualHost>
```

## RUN IN BROWSER

```bash 
dev.mybase.vn
```