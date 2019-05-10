##  如何使用

- 要求本地装有`composer`

```php
git clone https://github.com/1604104se-hitwh/welcome.git
cd Welcome
composer install
```

之后需要打开`.env`配置本地的数据库环境

```php
DB_CONNECTION=mysql // 可能是别的数据库，具体见Laravel
DB_HOST=127.0.0.1 	// 数据库地址
DB_PORT=3306 		// 端口
DB_DATABASE=数据库名称
DB_USERNAME=数据库用户名
DB_PASSWORD=数据库密码
```

再执行：

```php
php artisan migrate
php artisan key:generate
php artisan db:seed --class=StudentTableSeeder
php artisan db:seed --class=AdminTableSeeder
php artisan db:seed --class=DatabaseSeeder
php artisan db:seed --class=DepartmentTableSeeder
php artisan db:seed --class=MajorTableSeeder
```

调试运行：

```php
php artisan serve
```

打开浏览器，地址栏输入：`localhost:8000`
登录数据可以在相应的数据库填充器中查看，比如管理员登录就可以在`database/seeds/AdminTableSeeder.php`中选取用户名密码登录

W.H.S.D.T.