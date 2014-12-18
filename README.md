OauthServerApp
==============

A server application expose OAuth Service with Symphony 2

# Install

clone this repository

Execute 
```
$ php composer install
```
Configure the database and create database with your administrator tools.

# Init Database

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
$ php jbnahan:oauth-server:client:create --redirect-uri="http://clinet.local/" --grant-type="authorization_code" --grant-type="password" --grant-type="refresh_token" --grant-type="token" --grant-type="client_credentials"
```

# Tests

Work for this test :
http://blog.tankist.de/blog/2013/07/18/oauth2-explained-part-3-using-oauth2-with-your-bare-hands/


# Links

http://blog.tankist.de/blog/2013/07/16/oauth2-explained-part-1-principles-and-terminology/
