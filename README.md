Free Bet
========

https://travis-ci.org/jbouzekri/free-bet.svg?branch=master
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/jbouzekri/free-bet/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/jbouzekri/free-bet/?branch=master)

A simple PHP application to provide a betting system for sports events.
You can easily install it in your company to have fun and see who is the best forecaster.
For now, it focus on the 2014 World Cup

Prerequisites
-------------

A clean LAMP installation.
Warning : Here, M stands for MongoDB. You must have it installed with the php module
For my environment development, I followed the MongoDB installation documentation : [Read the doc](http://docs.mongodb.org/manual/installation/)

```
apt-get install php5-mongo
```

The VirtualHost for apache is a standard one for symfony2

Installation
------------

The following vhost is for apache 2.4. Adapt the Require section for old apache version.

```shell
cd /var/www
git clone https://github.com/jbouzekri/betting-sas.git
cd betting-sas
php composer.phar install
chown www-data:www-data app/{cache,logs} -R
chmod ug+rwx app/{cache,logs} -R
cat >/etc/apache2/site-available/betting-sas.conf <<EOL
<VirtualHost *:80>
    ServerName <your hostname>

    DocumentRoot /var/www/betting-sas/web
    <Directory /var/www/workspace/betting-sas/web>
        # enable the .htaccess rewrites
        AllowOverride All
	Require all granted
    </Directory>

    ErrorLog /var/log/apache2/error-betting.log
    CustomLog /var/log/apache2/access-betting.log combined
</VirtualHost>
EOL
a2ensite betting-sas
```

Roadmap
-------

This is a work in progress so it is not finish. Comming soon :
* Bet validation
* Stats on events and competition : per person, and per group
* And of course templating, style and navigation

Theoric release date : 05/2014