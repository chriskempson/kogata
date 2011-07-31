# Kogata PHP 5 Gluing Framework
Huge monolithic frameworks are great but there are also loads of great standalone components out there. Perhaps you've even written your own? Rather than be forced to use whatever bespoke code your framework uses for task X, Y, Z why not use whatever you want to use? Just glue all your favourite components together, in effect creating your own custom framework that works exactly how you want it to!

This is the purpose of Kogata, it's what I'm calling a "Gluing Framework". A framework that does little more than act a facilitator for joining up your various favourite components and give you a little help accessing them via URLs. Great care has been taken to make Kogata as small and as simple as possible so you can fully grok its code in next to no time and really make it your own.

The word "kogata" means "small size" in Japanese. Kogata is around 350 SLOC and measures just 8 KB!

## Features Overview
* Amazingly Lightweight
* KISSed to death
* RESTful routing (GET, POST, PUT, DELETE)
* Support for H/MVC structure or whatever you prefer
* PHP5 Class auto-loading
* Easily share instantiated classes anywhere in your application
* Extremely simple templating system (or use your own e.g. Smarty)
* Easy to get to grips with and customise to your liking
* Extendable with your own or third-party classes and components
* Written for PHP 5.2+

## A Quick Example
Just to ever so slightly scratch the surface, here's a very simple example.

    require 'bootstrap.php';
    sc::route()->get('/example', array(nc::exampleController(), 'methodName'));
    sc::route()->get('/hello/$name', function($name) {
        echo 'Hello '.$name;
    });
    sc::dispatch();

**N**ew **C**lass `nc::className` instantiates a new class and returns its instance.
**S**tored **C**lass `sc::className` will instantiate a class, store it in the registry and return its instance or simply return a previous instantiated class.

## Directory Structure
The directory structure is more of a nod towards a way you might structure your application. However you can freely customise it however you like, just make sure to make a few changes to paths.php and you can create whatever structure you desire. If you're using Kogata for many projects it's preferable to have a single copy of the kogata directory sitting a level above your projects so that it can be shared between them. 

    .
    ├── app
    │   ├── controllers
    │   │   └── *Your controllers*
    │   ├── models
    │   │   └── *Your models*
    │   └── views
    │   │   └── *Your views*
    ├── bootstrap.php
    ├── config
    │   ├── paths.php
    │   └── routes.php
    ├── kogata
    │   ├── helpers
    │   │   └── *Kogata's helpers*
    │   ├── libraries
    │   │   └── *Kogata's libraries*
    │   ├── loader.php
    │   └── registry.php
    ├── public
    │   ├── css
    │   │   └── *Your CSS*
    │   ├── images
    │   │   └── *Your images*
    │   ├── javascript
    │   │   └── *Your JavaScript*
    │   └── index.php
    ├── tmp
    |   └── *Temporary files e.g. cache files*
    └── vendor
        └── *Third party classes*