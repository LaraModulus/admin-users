LaraMod Admin Users 0.2 Alpha
----------------------------
LaraMod is a modular Laravel based CMS.
https://github.com/LaraModulus

Installation
---------------
```
composer require laramod\admin-users
```
 **config/app.php**
 
```php 
'providers' => [
    ...
    LaraMod\Admin\Users\AdminUsersServiceProvider::class,
]
```

In `config/admincore.php` you can edit admin menu

**DEMO:** http://laramod.novaspace.eu/admin
```
user: admin@admin.com
pass: admin