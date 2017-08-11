## Task

A Symfony project created on August 10, 2017, 5:28 pm.

[documentation](doc/README.md)
[Testaufgabe PDF](doc/Testaufgabe.pdf)


## Project Steps

### Creating environment
[bitbucket repository](https://bitbucket.org/sapletta/dmwd/)


[install symfony](https://symfony.com/doc/current/setup.html)

    symfony new dmwd
    
[public server](https://symfony.com/doc/current/setup/built_in_web_server.html)
    
    sudo php bin/console server:start 0.0.0.0:81
    sudo php bin/console server:status 192.168.188.34:81
    sudo php bin/console server:stop


### Routing
https://symfony.com/doc/current/routing.html
    
    app/config/routing.yml

+ Create list by Date in XML
+ View
+ Controller
+ Library for XML parsing

### Serializer
https://symfony.com/doc/current/serializer.html

    composer require symfony/serializer

### Config

    app/config/config.yml

### Implementation of Task

+ creating the data model for xml
+ creating the Controller
+ creating the View

## Project Pages
[home](http://192.168.188.34:81/)
[list](http://192.168.188.34:81/list)
[video](http://192.168.188.34:81/video)

Current version is working direct from XML file,

## TODO

Mysql Implementation
AngularJS frontend
