# REST API in Slim 3 to create and authenticate a user using Stormpath as security service

This is fork of Akrabats [Slim 3 Skeleton App](https://github.com/akrabat/slim3-skeleton) with Doctrine 2.

```
1) Create a developer account on Stormpath
```

```
2) Rename file file app/settings_sample.php to settings.php and replace it with your DB and stormpath settings
```

#Application end points
You can use postman to test the endpoints

```
- Create account:

http://YOUR_DEV_IP/api/v1/users?XDEBUG_SESSION_START=phpstorm-xdebug&email=test@email.com&username=username&password=Password123&surname=Jonh&given_name=Doe
```

```
- Authenticate account:

http://YOUR_DEV_IP/api/v1/authenticate?XDEBUG_SESSION_START=phpstorm-xdebug&username=username8&password=Password123
```
