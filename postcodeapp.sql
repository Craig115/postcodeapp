CREATE user onthemoney@localhost identified BY 'password1!';
CREATE DATABASE postcodeapp;
GRANT all privileges on postcodeapp.* TO 'onthemoney'@'localhost';