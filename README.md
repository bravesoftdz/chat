# Chat

implemented on the kernel: [MVC](https://github.com/dykyi-roman/mvc/blob/master/README.md)

![image](https://github.com/dykyi-roman/chat/blob/master/images/screen.png)

## Installation
+ run the script ```"db.sql"``` in the folder migration
+ run the script ```"table.sql"``` in the folder migration
+ run command ``` composer install --optimize-autoloader```
  
## Usage package
+ phpdotenv
+ pusher-php-server
+ predis
+ monolog
+ whoops
  
## Implemented
+ login & sign up
+ users list
+ friends list
+ friends request notification
+ request dialog
+ monitor last activity

## Future
+ monitor status change (pusher)
+ use redis for send message
+ cache for message history

## Author
[Dykyi Roman](https://www.linkedin.com/in/roman-dykyi-43428543/), e-mail: [mr.dukuy@gmail.com](mailto:mr.dukuy@gmail.com)
