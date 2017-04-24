LaraMod Admin Users 0.1 Alpha
----------------------------
LaraMod is a modular Laravel based CMS.
https://github.com/LaraModulus

Installation
---------------
```
composer require LaraMod\admin-users
```
 **config/app.php**
 
```php 
'providers' => [
    ...
    LaraMod\AdminUsers\AdminUsersServiceProvider::class,
]
```

In `config/admincore.php` you can edit admin menu

**DEMO:** http://laramod.novaspace.eu/admin
```
user: admin@admin.com
pass: admin