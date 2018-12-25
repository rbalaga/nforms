## Welcome!
Nforms is designed for assignment for navya recruitment.
It can generate forms dynamically with customized fields in form.
We can `add` `edit` `update` the questios into a form.
We can publish the response link to access particular form.

## Links

Once you had copied the source code into server,  you can access this application from 
http://localhost/rbalaga/
* List of created forms will be shown here. 
* Click on New form -> creates a new form.
* Click on `edit form` which is at each form. here you can now `add multiple questions` and `edit questions or options` and `edit form title`.
* Click on form to open the form as a candidate and where you can 	submit the form details.
* you can check the responses in database in `fm_responseentry` and `fm_responses` tables.
* you can check the forms configuration  tables as well in database.

Here is a hosted application you can have demo of this application.
https://rbalaga.000webhostapp.com/rbalaga/

## Checklist
* Make sure source code root folder name is `rbalaga`
* Import `nforms.sql` file into mysql database. which creates supporting tables in mysql database.
* configure database server details in `application -> config -> database.php` file.
```php
$db['default'] =  array(
		'dsn'  =>  '',
		'hostname'  =>  'localhost', //update mysql host
		'username'  =>  'root', //update database user name
		'password'  =>  '', //update user password
		'database'  =>  'nforms',  //update database where we had imported nforms.sql file.
```
* update the server base url in `application -> config -> config.php`
```php
$config['base_url'] =  'http://localhost/rbalaga';//'https://rbalaga.000webhostapp.com/rbalaga';
```
* update `rbalaga->.htaccess` file in root folder.
```php
	RewriteEngine On
    RewriteBase /rbalaga      //replace rbalaga with the root folder name you set for this source code
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php/$1 [L] 
```