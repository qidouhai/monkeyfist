# **Monkeyfist**

## What is Monkeyfist?
Monkeyfist is a lightweight, easy-extensible mini social network completely build with open source software. To setup your own Monkeyfist server requires no programming skills and can be achieved in only a couple of minutes.

#### **NOTE:**  Monkeyfist is still in development. A release will be published as soon as a first stable version is available. 

## Requirements
These are the software requirements necessary to set up your own Monkeyfist server.

#### 1. Apache XAMPP
Monkeyfist runs on a basic Apache HTTP Server and uses MySQL as a data storage. Apache Xampp is available for Windows, Linux, and Mac OS. You can download it [here](https://www.apachefriends.org/download.html)

#### 2. Composer
[Composer](https://getcomposer.org/download/) is required to automatically install and update the required PHP dependencies.

#### 3. Node.js
Monkeyfist uses [Node.js](https://nodejs.org/) Websockets for push notifications. We also use npm and Bower to manage JavaScript dependencies.

#### 4. Redis
Monkeyfist uses the [Redis](https://redis.io/download) message broker for its messenger. Redis for Windows is available [here](https://github.com/MSOpenTech/redis/releases).

## Installation Guide
This guide will provide the basic steps required to run Monkeyfist on an Apache Webserver.

#### 1. Clone Monkeyfist Repository
Use git to clone the repository into the web directory of your Apache server or simply download it from Github and extract the files manually.

#### 2. Download Software Dependencies
Open a cli and run the following commands:
1. Download PHP dependencies  
```sh
$ composer install
```
2. Download JavaScript server dependencies  
```sh
$ npm install
```
3. Download JavaScript client framework  
```sh
$ bower install
```

#### 3. Edit Server Configuration
Create your own ```.env``` file in the Monkeyfist root directory, following the example of the ```.env.example``` file. This is where your server settings (APP_KEY, DB credentials, etc.) will go.

#### 4. Create Virtual Host
The easiest way to make Monkeyfist run on XAMPP, is to create a Virtual Host file. This file has to be placed in the config directory of your Apache Server.  
* on Windows: ```[...]\xampp\apache\conf\extra\httpd-vhosts.conf```
* on Ubuntu: ```etc\apache\sites-enabled\monkeyfist.conf```

Restart your Apache server afterwards to apply your changes.

#### 5. Migrate SQL Tables
Finally, there is only one thing left to do. We have to migrate the required SQL tables to the database management system. Make sure the MySQL component of your XAMPP distribution is running. Open up a CLI, navigate to your Monkeyfist directory and type:
```sh
$ php artisan migrate
```
The tables will be created and the installation is complete.

## Run Monkeyfist

If you followed the Installation Guide, Monkeyfist will be available as soon as your XAMPP server is started. All that's left to do is to run the websocket script. Open a CLI, navigate to the Monkeyfist directory and run the ```socket.js``` script by typing:
```sh
$ node socket.js
```
Congratulations, your server is up and running. :thumbsup:
