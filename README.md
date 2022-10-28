OauthServerApp
==============

A server application example, expose OAuth Service with Symphony 6.

> **WARNING : DO NEVER USE THIS PROJECT IN PRODUCTION**

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

# Create Keys

Pair keys:

```shell
openssl genrsa -out config/key/private.key 2048
openssl rsa -in config/key/private.key -pubout -out config/key/public.key
```

Encription key

```shell
php -r 'echo base64_encode(random_bytes(32)), PHP_EOL;'
```

Set This value int your `.env.local` configuration file.



Create the admin user :
```
$ symfony console user:add admin@admin.fr 
```
The password is asked after.

Add client :
```
$ symfony console client:add test https://127.0.0.1:8000/return_code
```

The Client ID and secret is displayed after add in database.

# Ask an CodeGrant Authentification

Login before try using `https://127.0.0.1:8000/login` url.

```
https://127.0.0.1:8000/authorize?client_id=akH0PxFLiHctKpRqsaMKQ&response_type=code&state=132&redirect_uri=https%3A%2F%2F127.0.0.1%3A8000%2Freturn_code&scope=
```

# Ask AccessToken

```
curl --request POST \
  --url https://127.0.0.1:8000/access_token \
  --header 'Content-Type: application/x-www-form-urlencoded' \
  --data code=def502007c1f0591230e6a898f6c906573fd3ae8b759130c1442f1ebdad255d2c58bf4d7df980598265b4b199340d8bd2f7527486e0fd76b884af62f57bfa4d6b92c50313b1639b8cf05778fa502192d233aca35acc566f2a597df81acc668a46836e27f59083fc7fc136283fd466251a12a02ee12782407fa08b5c62b5ec06786f5ba347670923e17a80f3fe64fd9ae1eb69bc5a228358844d4c99bd23f0b2307866108c8dc6590343af1161a06fefe4f00b21693c2b45614a9dd2956da0b79d4a470f832a247a61f8542c738bbafe939d975e2c18d2697716a84ef93fda65f546a6f64330af8ad70b8ffe6923462f7191a0b04ea7bc5cf0237ba6050ad0e60e6cc2050d1085204d3ac50a1a79e60b92f3fe7a7d9e1a0267cd96e04e015fe16b74ab518d8f60c4d4b3d6519fb570a2228b6f1735321f496acd6b97fbb30a2a28b3efdca5b1473987401407a84ce37fa69c5b2ee6d32e7e6926ebb46a536dd2ab98e08256356bbdddfa09fccd7bd0223e86c25aa62439aa556188d2b5fb89ebd3977bdcc96 \
  --data redirect_uri=https://127.0.0.1:8000/return_code \
  --data client_secret=aiafOTU5Pu9DRmWG6Gg0QUmbh3zEe3UHrXCPqgusq6Y \
  --data client_id=akH0PxFLiHctKpRqsaMKQ \
  --data grant_type=authorization_code
```

Response:

```
{
	"token_type": "Bearer",
	"expires_in": 3600,
	"access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiJha0gwUHhGTGlIY3RLcFJxc2FNS1EiLCJqdGkiOiI5MTQ3ZDVjNGEyYTQ5OTE3YTU2YWRhZWUwMzJlMjE1MzUzODIzMDIyYjJlMzQzNjg5Nzc4MmMwMTgzM2MxZGMxMzRmODVkYzYzYmEzZjM4MiIsImlhdCI6MTY2Njk3NDcwNi45MjA1OCwibmJmIjoxNjY2OTc0NzA2LjkyMDU4NiwiZXhwIjoxNjY2OTc4MzA2LjkwNDE5OSwic3ViIjoiYWRtaW5AYWRtaW4uZnIiLCJzY29wZXMiOltdfQ.oc4WwA-cE_jtSqmiqoLAiYzZ61Y0AfuOu7Y5bF91MvFrqJUndkBGwiIlfGbDYHz1Dg_QgZNnbOwC31JYqJ0qY2zzBaLOoOFG59PCcUDA0ExtBcd99YNFMMBAQgwYGNnyOkU13oyokJDMnP1rk9l-D3haQNo9OhOL7Sai5KXcbVLylMF0pfgxXzcOu_8jqk7H7mPlVkBPJDKhrkb3JxtD4oH1X8U19BGkns3PLsn_bYaUqn23QE6ZMEakdcp19ZU0KGC4_rwUl-aofNIKMHZciKEAFMIjgiugcV6_LpIe3Bjo-bmw-1tMbTNEd54DUnPwETc7NDes-iZrtYC-A6q6Vg",
	"refresh_token": "def50200c96c81f655d0752161b4b00ca47a9dea333cd7131aaf10e504726e90dc9ab0397c7130610d9419859c163c993eb60450de59f715bbc80777203674346f5522c132d164912c86489126098201c88d8c62f45fdd90d4e24bc01f67100bcfe9de10435f6b865cff6dde8b7897bfede35416a3e6835e7bb56752eb73f0a1783fbfcf91f39ab31a7b184132e82b81c7a0bfb6c3c5038144bda9e8b5def97de80cf070fc34caba799d6589a2e0aaf4d9c8a655e1b399bb69b48a338c9b89783b8a329b74c211d474fa0ee9fffccbe462accf4199f9417fee19f7f98925b504e319cfd90dbbb33c660193e843f32ea0610342857c006fe898faa126fad4ee5ee11493327c2d1c5c842f21742bb0cd76970f61784776d0614a2fef2865dd8ea4728218044889e22316e66277c031077357e721766fd96131add7a91e374da946438f993ab4432e1a3e6673b289bde33b4f5818bb39cf6c34e913e5c8317920125cc4a64a721a1fe06a755f729b545ddffeecf4ed3abf36a950d71c276e5b024137d5bbeb"
}
```

# Tests

Work for this test :
http://blog.tankist.de/blog/2013/07/18/oauth2-explained-part-3-using-oauth2-with-your-bare-hands/

Work with Symfony 2.3.23 !


You want test without change your configuration or install more software in your computer ? Consider use [docker](https://www.docker.com)

# Other Database storage

This project use MySQL or other Doctrine 2 ORM driver (postgresql, sqlite, MS SQL Server...). If you want use this POC with another database storage server, fork my repos and change code for use your database server.


# Links

http://blog.tankist.de/blog/2013/07/16/oauth2-explained-part-1-principles-and-terminology/


# Contribute

Fork my repo and code !
