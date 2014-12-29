OauthServerApp
==============

A server application expose OAuth Service with Symphony 2

# Install

clone this repository

Execute 
```
$ php composer install
```
Configure the database.

# Init Database

Create database
```
$ php app/console doctrine:database:create
```

Create schema
```
$ php app/console doctrine:schema:create
```

Create the admin user :
```
$ php app/console jbnahan:oauth-server:user:create --name=admin
```
The password is same as `name`. and email is 'username'@nahan.fr.

Add client :
```
$ php app/console jbnahan:oauth-server:client:create --redirect-uri="http://clinet.local/" --grant-type="authorization_code" --grant-type="password" --grant-type="refresh_token" --grant-type="token" --grant-type="client_credentials"
```

# Tests

Work for this test :
http://blog.tankist.de/blog/2013/07/18/oauth2-explained-part-3-using-oauth2-with-your-bare-hands/

Work with Symfony 2.3.23 !


You want test without change your configuration or install more software in your computer ? Consider use (docker)[https://www.docker.com]

# Other Database storage

This project use MySQL or other Doctrine 2 ORM driver (postgresql, sqlite, MS SQL Server...). If you want use this POC with another database storage server, fork my repos and change code for use your database server.


# Links

http://blog.tankist.de/blog/2013/07/16/oauth2-explained-part-1-principles-and-terminology/


# Contribute

Fork my repo and code !