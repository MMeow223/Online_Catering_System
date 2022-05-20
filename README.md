# Online_Catering_System
>Snapshot of the customer home page
>
![image](https://user-images.githubusercontent.com/40930751/169589546-1fae966b-1c28-467e-8105-14fb8cc3f45e.png)
<br><br>

Online Catering System is the topic that we(Elvis, Tonny, Tony, Vendy) have decided to develop for **SWE20001 - Managing Software Project**. This project is a online platform which provide catering service for institutions. There is an admin site is also developed for managing the customer site. 
<br><br>
We have also host this application at <a href="https://pinocone-catering.herokuapp.com/login">https://pinocone-catering.herokuapp.com/login</a>. Feel free to visit the website and test out the feature. The website will no be maintained in the future as it is develop for the education purpose. For more detail, please refer to the <a href="https://github.com/MMeow223/Online_Catering_System/edit/main/README.md#disclaimer">disclaimer</a>.


# Setup The Project 

### 1. Install Composer and Node.js
To install laravel in your local local device, using composer is a great approach. You can download the composer installer it from <a href="https://getcomposer.org/download/">here</a>. You also need Node.js to access the npm command in terminal. The download link is <a href="https://nodejs.org/en/">here</a>.

>Composer installer image
>
![Composer installer image](http://5balloons.info/wp-content/uploads/2018/09/Composer-Setup-Window.png)

>Node.js image
>
![Node.js](https://user-images.githubusercontent.com/40930751/169581950-a541f7d5-a178-46da-a4f9-2c1e56fcde90.png)


### 2. Download this repository
The second step, you need to install this repository <a href="https://github.com/MMeow223/Online_Catering_System/archive/refs/heads/main.zip">here</a> and extract the zip file.

>Repository link location
>
![Repository link location](https://user-images.githubusercontent.com/40930751/169580269-08856170-13da-4e6e-ac5d-222b598758b4.png)


### 3. Start Apache and MYSQL on XAMPP
You need to start the Apaceh and MYSQL on your XAMPP. If you do not have XAMPP installed on your device, you can refer to  <a href="https://www.apachefriends.org/index.html">this link</a>

>Apache and MYSQL in XAMPP
>
![Apache and MYSQL in XAMPP](https://user-images.githubusercontent.com/40930751/169580115-90e44812-1165-407c-8cab-3d73a7bd2366.png)

### 4. Configure project file
Before you start to configure anything, open your command prompt and direct to the location where you install this project repository. After that, you need to run few commands in your command prompt:

```
// This command will install the required packages based on the composer.json
composer install
```
>Result after executing ```composer install```
>
![image](https://user-images.githubusercontent.com/40930751/169582641-5dd14b0d-33ac-411a-9d45-203c0ce1e417.png)

```
// This command will install the required js node package based on the package.json
npm install
```

> Result after run ```npm install```
> 
![image](https://user-images.githubusercontent.com/40930751/169582717-1a5ce033-77a4-4938-ac60-44cb74e676a5.png)


Then create a file named  ```.env``` and paste the code below inside.

```
APP_NAME='Online Catering System'
APP_ENV=local
APP_KEY=base64:K7Ujqhd4bod5O0jdZLND5jQHQkgJt9tLjb2hP9J7ZCM=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=online_catering_system
DB_USERNAME=
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=<replace_with_your_own_mailtrap_information>
MAIL_USERNAME=<replace_with_your_own_mailtrap_information>
MAIL_PASSWORD=<replace_with_your_own_mailtrap_information>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=<replace_with_your_own_mailtrap_information>
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"

```
Then you need to edit some of the content inside this file. You will also need to register a mailtrap account to test the mail notification function.
```
DB_USERNAME=<replace_with_your_db_username>
DB_PASSWORD=<replace_with_your_db_password>

...

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=<replace_with_your_own_mailtrap_information>
MAIL_USERNAME=<replace_with_your_own_mailtrap_information>
MAIL_PASSWORD=<replace_with_your_own_mailtrap_information>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=<replace_with_your_own_mailtrap_information>
MAIL_FROM_NAME="${APP_NAME}"
```

## 5. Setup Database
Open your phpMyAdmin by type <a href="http://localhost/phpmyadmin/">http://localhost/phpmyadmin/</a> in your browser. Then create a database named ```online_catering_system```. Then you need will need to creat the table inside the database. To preform that, you will need to type ```php artisan migrate --seed``` in your command prompt of where the project repo located, then the table will automatically created, along with the dummy data. If something went wrong during the process, you can use ```php artisan migrate:rollback``` to revert the previous command.

>Result after executing ```php artisan migrate --seed```
>
![Creating table and insert the data](https://user-images.githubusercontent.com/40930751/169584942-f748689b-86e5-4bb8-8488-c2c171117f22.png)

>Result after executing ```php artisan migrate:rollback```
>
![Undo create table and insert data](https://user-images.githubusercontent.com/40930751/169585016-b47ea3be-438a-4c54-8007-7648a15e2fc3.png)


## 6. Run the web server
Finally, the project is setup completely. The last time you need to do is to run ```php artisan serve``` to start the development web server. Then you can access the development web server by typing  <a href="http://127.0.0.1:8000">http://127.0.0.1:8000</a> in your web browser. 

>Result of executing ```php artisan serve```
>
![image](https://user-images.githubusercontent.com/40930751/169587453-94126b6f-6cf3-44ae-9f7d-98688ad28bcf.png)


The email and password for admin and user are provided below:
>Admin
```
email: admin@gmail.com
pass : admin
```

>User
```
email: user@gmail.com
pass : user
```

# Disclaimer
>This website is created mainly for educational and non-commercial use only. It is a partial fulfilment for completion of unit SWE20001 - Managing Software Project offered in Swinburne University of Technology, Sarawak Campus for Semester 1, 2022. The web-master and author(s) do not represent the business entity. The content of the pages of this website might be out-dated or inaccurate, thus, the author(s) and web-master does not take any responsibility for incorrect information disseminate or cited from this website. If you believe that information of any kind on this website is an infringement of copyright in material in which you either own copyright or are authorized to exercise the rights of a copyright owner, kindly contact the web-master (elviswong2002@hotmail.com) for removal.

# Contributors
