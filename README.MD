# Search aplication proxy-startrack
Welcome to  this aplication, the propose for this aplication is to apply an employee on Startrack Guatemala.
This API was created by Pedro Pablo Taniel  on PHP and use MySQL Database, bellow you can find the requirements, installation method and others importants things.


## how to install on local machine

### Requirements

 - Apache 2.4 or later
 -  MariaDB 10.x.x or Later
 -  A endpoint Tool to test like postman

### Linux Enviroment

 1. Install LAMP server :
sudo apt-get update
sudo apt-get install -y tasksel
sudo tasksel install lamp-server
 2. Download the code on directory var/www
 3. Configure de the password for mysql, you can find and example here: https://phoenixnap.com/kb/how-to-reset-mysql-root-password-windows-linux
 4. Run the file content /migration/v1.sql on mysql
 5. Make shure the password and user are the same on file database.php

### Windows Enviroment

 1. Download Apache tool for windows, for example, you can download XAMPP server  here: https://www.apachefriends.org/es/index.html
 2. Install XAMPP on windows and run the services, example here: https://www.ionos.es/digitalguide/servidores/herramientas/instala-tu-servidor-local-xampp-en-unos-pocos-pasos/
 3.  Configure de the password for mysql, you can find and example here: https://kinsta.com/knowledgebase/xampp-mysql-password/#:~:text=To%20get%20started%2C%20launch%20your,to%20change%20your%20root%20password.&text=The%20shell%20will%20prompt%20you,to%20confirm%20the%20new%20password.
 4. Download the code on directory C:\xampp\htdocs
 5.  Run the file content /migration/v1.sql on mysql
 6. Make shure the password and user are the same on file database.php


## Controllers 

### Search:
 You can make a request and you must be send the params page, size and query.  
**Example request:**
curl("http://localhost/startrack/search?page=1&size=20&query=java")
**Example Response:**

{

"1": {

"title": "Is there a way to add JavaFX 20 to my existing Maven Java 20 Project in NetBeans IDE?",

"answer_count": 1,

"username": "Abraham Agbota",

"profile_image": "https://lh3.googleusercontent.com/a/AAcHTtdV2GTc5V_zR4Sv7zewNB80g3akgt--fW6yNWeRRGjQ=k-s256"

}]

### Statistics:
**combinations**: You can send a combination for page, size and query to recive a average of responses or no send params to recive all averages. 
Example request: 
curl("http://localhost/startrack/statistics/combinations?page=1&size=20&query=java")

**list**: You can send the init and finsh time to rrecive all searchs on this time.
Example request: 
curl("http://localhost/startrack/statistics/list"

## File directory

 Here is the structure of this app
 

 - cache: Folder to the save cache files on MD5 enctryption.
 - controllers: Controllers for this api, there are 3, search for searching proxy, statistics for results of searches and default 
 - migration: sql files to migrate app
 - models: owner orm to use database
 - config.php: general configurations.
 - database.php: Database configuration
 - index.php: entry point
 - router.php: router off app
