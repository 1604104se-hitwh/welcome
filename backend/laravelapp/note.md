后代路由部分/admin/public/login
```php
Route::group(['prefix' => 'admin'], function() {
    Route::get('public/login', 'Admin\PublicController@login');
})
```
创建控制器文件：
php artisan make:controller Admin\PublicController
创建需要的login方法
```php
public function login() {
    return view('admin.public.login');
}
```
创建需要的视图文件，如：login.blade.php
将css,js等静态文件放入根目录下的public目录中，可以新建文件夹，但是这样做视图文件中的路径也需要调整

AuthController
```php
if (Auth::attempt(['email' => $email, 'password' => $password])) {
    return redirect() -> intended('dashboard');
}
```
