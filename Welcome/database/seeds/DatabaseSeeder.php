<?php

    use Illuminate\Database\Seeder;

    require_once __DIR__ . '/../../app/include.php';

    use Jxlwqq\IdValidator\IdValidator;

    /**
     * 运行php artisan db:seed
     * 命令会启动在 DatabaseSeeder.php 文件中列出的所有类
     */
    class DatabaseSeeder extends Seeder
    {
        private $idValidator;

        /**
         * Run the database seeds.
         *
         * @return void
         */
        public function run()
        {
            $this->call([
                AdminTableSeeder::class,
                DepartmentTableSeeder::class,
                DormitoryTableSeeder::class,
                EnrollCfgTableSeeder::class,
                EnrollTableSeeder::class,
                MajorTableSeeder::class,
                StudentTableSeeder::class,
                PostTableSeeder::class,
                PermissionTableSeeder::class,
                SysInfoTableSeeder::class
            ]);
            // $this->call(UsersTableSeeder::class);
        }
    }
