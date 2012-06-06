translatable-find-all-example
=============================

Example trying to reproduce a problem on Translatable Entities Repositories 

Symfony2 ML thread: http://bit.ly/LdvblN

Symfony-es ML thread: http://bit.ly/JGnRKt

Install
-------

Download this project with 

git clone git://github.com/tolbier/translatable-find-all-example.git

Assign user permissions & configure web server as tell in 
http://symfony.com/doc/current/book/installation.html#configuration-and-setup


bin/vendors install


Create Database, with right permissions for user/pass

configure app/config/parameters.ini , with this values

app/console doctrine:schema:create

app/console doctrine:fixtures:load

URL for Testing
---------------
http://localhost/app_dev.php/


