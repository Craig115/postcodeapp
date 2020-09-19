# postcodeapp

Loads a CSV containing postcode data into a database, used by this symfony application

### How to use

###### Install

```
### This app assumes you have PHP 7.x installed along with composer

# Required PHP extensions
apt-get install php7.2-mbstring
apt-get install php7.2-xml
apt-get install php7.2-zip
apt-get install php7.2-mysql

# Ensure you have MariaDB installed
apt-get install mariadb-server mariadb-client

composer install
```

###### Configuration

```
# Set up the database

sudo mysql -u root -p < postcodeapp.sql

php bin/console doctrine:schema:create
```

###### Run the App

```
# To Download a CSV list of postcodes
php bin/console app:download-postcode

# To import the postcodes
php bin/console app:import-postcode

# To run the application locally
php bin/console server:run

```

###### Routes
```
# to search postcodes
/search/{string}

# to bring back postcodes based on a location
/location/{lat}/{lng}
```
