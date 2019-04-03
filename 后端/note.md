开发时，需要将config/database.php 配置文件中mysql 的 strict 的值改为false，strict是指严格模式，进行数据的严格校验，错误数据不能插入，报error错误。

在config/app.php中将'locale' => 'en'设为'zh_CN'，同时添上'faker_locale' => 'zh_CN'，以适应中文环境。

如果想要暂时屏蔽csrf错误，可以在app/Http/Kernel.php中将$middlewareGroups里的\App\Http\Middleware\VerifyCsrfToken::class注释掉。

在进行表单验证时，也就是app\Http\Requests下的类，需要将authorize()方法的返回值设为true。

PHP的生命周期分为5个阶段：模块初始化，请求初始化，执行该php脚本，请求处理完成，关闭模块。但是laravel只运行在第三个阶段，执行php的阶段就是指一次从客户端发起请求到服务器端返回响应，所以不要指望在类中用变量能够存储信息，它们就是临时变量而已，能存信息的就是session，文件，数据库。



