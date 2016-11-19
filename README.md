Spotware test task
============================

REQUIREMENTS
------------

### PHP 5.5
### MySQL
### Apache
### Composer

INSTALLATION
------------

### Clone repo

You can clone the repo from Github(https://github.com) using the following command:

~~~
git clone https://dimichspb.github.com/books
~~~

### Install framework

To install framework please use Composer(https://getcomposer.org) with the following command:

~~~
php composer.phar install
~~~


CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```

**NOTES:**
- Yii won't create the database for you, this has to be done manually before you can access it.

### DB Dump files

Please download source DB files by the following link:

~~~~
http://www2.informatik.uni-freiburg.de/~cziegler/BX/
~~~~

Then unzip it to the root folder of the project.

### Migrations

Run DB migrations using the following command:

~~~
php yii migrate
~~~

**NOTES:**
- Please be patient and do not interrupt the process. Dumps contain a lot of data - migrations could take few minutes.

### Apache

Configure your Apache web-server to access to /web folder by default

For example, `vhosts.conf`:

```
<VirtualHost books.dev:80>
    DocumentRoot "C:/Projects/PHP/books/web"
    ServerName books.dev
    <Directory "C:/Projects/PHP/books/web">
        Options -Indexes +FollowSymLinks
        AllowOverride All
        Require all Granted
    </Directory>
</VirtualHost>
```


WORK
----

Now you are able to use the project!
Just open http://books.dev in your favorite browser and have fun!

## Default user details.
~~~
admin/admin
~~~

**NOTES:**
- Current version supports only actions: view list of the books, view particular book with ratings, view list of the readers, view particular reader with ratings


RESTful API reference
---------------------

### Books

1. Get list of all books:

~~~
GET /api/books
GET /api/book/index
~~~

2. View book:

~~~
GET /api/book/:ISDN
~~~

3. Update book:

~~~
PUT /api/book/update/:ISDN
~~~

4. Create book:

~~~
POST /api/book/create
~~~

5. Delete book:

~~~
DELETE /api/book/delete/:ISDN
~~~

### Users (Readers)

1. Get list of all users:

~~~
GET /api/readers
GET /api/reader/index
~~~

2. View reader:

~~~
GET /api/reader/:User_ID
~~~

3. Update reader:

~~~
PUT /api/reader/update/:User_ID
~~~

4. Create reader:

~~~
POST /api/reader/create
~~~

5. Delete reader:

~~~
DELETE /api/reader/delete/:User_ID
~~~


### Ratings

1. Get list of all ratings:

~~~
GET /api/ratings
GET /api/rating/index
~~~

2. View book's ratings:

~~~
GET /api/ratings?ISBN=:ISBN
GET /api/ratings?Country_Name=:Country_Name
~~~

3. Update rating:

~~~
PUT /api/rating/update?ISBN=:ISBN&User_ID=:User_ID
~~~

4. Create rating:

~~~
POST /api/rating/create
~~~

5. Delete rating:

~~~
DELETE /api/rating/delete?ISBN=:ISBN&User_ID=:User_ID
~~~


**NOTES:**
- Please use ?page= parameter for pagination
- Please don't forget to use ?access-token= parameter for authentication