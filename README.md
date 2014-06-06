Free Bet
========

[![Build Status](https://travis-ci.org/jbouzekri/free-bet.svg?branch=master)](https://travis-ci.org/jbouzekri/free-bet)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jbouzekri/free-bet/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jbouzekri/free-bet/?branch=master)

A simple PHP application to provide a betting system for sports events.
You can easily install it in your company to have fun and see who is the best forecaster.
For now, it focus on the 2014 World Cup

Prerequisites
-------------

A clean LAMP installation.

**Warning : Here, M stands for MongoDB.** You must have it installed with the php module.

For my environment development, I followed the MongoDB installation documentation : [Read the doc](http://docs.mongodb.org/manual/installation/).


For Mongo, run as root :

-   Import the public key used by the package management system.

```
apt-key adv --keyserver keyserver.ubuntu.com --recv 7F0CEB10
```

-   Create a /etc/apt/sources.list.d/mongodb.list file for MongoDB.

```
echo 'deb http://downloads-distro.mongodb.org/repo/debian-sysvinit dist 10gen' | sudo tee /etc/apt/sources.list.d/mongodb.list
```

-   Reload local package database.

```
apt-get update
```

-   Install the MongoDB packages.

```
apt-get install mongodb-org
```


For PHP Mongo client on Debian, run as root :

    echo "deb http://ftp.de.debian.org/debian wheezy-backports main" >> /etc/apt/sources.list
    apt-get update
    apt-get install php5-mongo


For PHP Mongo client on Ubuntu, run as root :

    apt-get install php5-mongo

The VirtualHost for apache is a standard one for symfony2

Installation
------------

The following vhost is for apache 2.4. Adapt the Require section for old apache version.

Install and configure your symfony2 app

    cd /var/www
    git clone https://github.com/jbouzekri/free-bet.git --recursive
    cd free-bet
    php composer.phar install
    php app/console assetic:dump
    chown www-data:www-data app/{cache,logs} -R
    chmod ug+rwx app/{cache,logs} -R
    php app/console doctrine:mongodb:schema:create --db --index --collection
    php app/console doctrine:mongodb:fixtures:load

Add the virtual host

    vim /etc/apache2/site-available/free-bet.conf


    <VirtualHost *:80>
        ServerName <your hostname>

        DocumentRoot /var/www/free-bet/web
        <Directory /var/www/workspace/free-bet/web>
            # enable the .htaccess rewrites
            AllowOverride All
            Require all granted
        </Directory>

        ErrorLog /var/log/apache2/error-free-bet.log
        CustomLog /var/log/apache2/access-free-bet.log combined
    </VirtualHost>

Enable the virtual host

    /etc/apache2/sites-enabled
    ln -s /etc/apache2/sites-available/free-bet.conf
    service apache2 restart

Go to the hostname configured.
You can logged in as admin with the account admin/admin.

There is a cron task to configure. This task process all ended events and their gambles to determine which are winners.

    php app/console gamble:process

You can launch it every hour for example

Roadmap
-------

This is a work in progress so it is not finish. Coming soon :

- Simple Dashboard
- User grouping and bet sharing
- Football European League : season 2014 - 215
- Social network submission
- Complex Stats on events and competition : per person, and per group

Theoric release date : 05/2014