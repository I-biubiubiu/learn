# <p align="center">Laravel简书项目笔记</p>

## 常用的artisan命令

| 命令                                    |    说明                 |
| :-----:                                |  :------:               |
| php artisan serve                      |  启动服务                |
| php artisan help serve                 |  查看help serve的相关信息 |
| php artisan serve --port=8080          |  设置指定端口号           |
| php artisan migrate:install            |  生成数据迁移总表         |
| php artisan make:controller [filename] |  创建控制器              |
| php artisan make:migration [filename]  |  生成数据迁移文件         |
| php artisan migration                  |  执行数据迁移            |
| php artisan migrate:rollback           |  回滚数据迁移            |
| php artisan make:model [filename]      |  创建模型               |
| php artisan tinker                     |  进入tinker环境         |
| php artisan storage:link               |  创建软连接(映射)        |

### 一 、环境要求

1. php>=5.6.4
2. OpenSSL PHP Extension
3. PDO PHP Extension
4. Mbstring PHP Extension(默认开启)
5. Tokenizer PHP Extension(默认开启)
6. XML PHP Extension(默认开启)

### 二、Composer安装Laravel

#### 2-1 安装
1. [Composer下载地址](https://pkg.phpcomposer.com/)
2. 打开命令行并依次执行下列命令安装最新版本的 Composer：

	第一步: `php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');"`
	
	第二步: `php composer-setup.php`
	
	第三步: `php -r "unlink('composer-setup.php');"`

3. 放入全局安装:
    `sudo mv composer.phar /usr/local/bin/composer`
4. 配置中文镜像:
	`composer config -g repo.packagist composer https://packagist.phpcomposer.com`
5. 创建Laravel项目:
	`composer create-project laravel/laravel {文件名} {版本号}`
	例如:    `composer create-project laravel/laravel laravel54 "5.4.*"`

#### 2-2 启动
1. 项目的启动: `php artisan serve`
2. 默认开启8000端口,本地地址: `http://127.0.0.1:8000`
3. 设置指定的端口: `php artisan serve --port=8080`

#### 2-3 DB 配置
1. 配置目录: `config\databases` 通常直接配置根目录的环境变量 .env文件
2. 生成数据迁移总表: `php artisan migrate:install` 生成一个migrations表

### 三、 基本语法及配置

#### 路由配置
1. 目录: `resource\view`
2. 基本语法：`Route:get('/',回调)`
3. 控制器函数：`Route::get('[指向url]','[控制器]@[行为]')`
	 例如: `Route::get('/users', '\App\Http\Controllers\UserController@index')`
4. 绑定模型: 获取posts表模型,主键为id,`Route::get('/posts/{post}'，控@行)`
	例如:  `Route::get('/posts/{post}','\App\Http\Controllers\PostController@show');`


```php
public function show(Post $post) {
    return view('post/show',compact("post"));
}
```

#### 常用配置
1. 时区： 目录 `config/app.php`  `'timezone' => 'PRC',`
2. 语言配置: 目录 `config/app.php` `'locale' => 'zh'`

#### 模板配置
1. 目录: `resource\view`
2. 新建主模板目录:layout
3. 新建主模板文件:main.blade.php
	包含其他模板内容: `@yield("content")`
	引入文件: `include("layout.文件名")`
	被包含的其他模板文件继承模板主文件: `@extends("layout.main")`
	被包含的模板内容: `@section("cotent")  内容  @endsection`
4. 渲染变量: `compact()`
5. 打印数据: `dd(request())`
6. 循环: `@foreach($post as $value)`  `@endforeach`
7. laravel日期返回的类型都是 carbon [修改样式官方AP](https://carbon.nesbot.com/docs/)
8. 函数: 
	`str_limit("$content", 100, '...')` 截取指定长度字符串, 其余内容用第三个参数显示
	`toFormattedDateString()` 改变显示时间格式
9. 表单提交生成token `{{csrf_field()}}`

#### 数据迁移
1. 目录: `database\migrations`
2. 生成数据迁移文件: `php artisan make:migration create_posts_table`
3. 执行函数: `up()`  回滚函数: `down()`
	
```php
public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100)->default("");
            $table->text('content');
            $table->integer('user_id')->default(0);
            $table->timestamps();
        });
    }
```

4. 执行迁移: `php artisan migration`

#### 控制器
1. 目录: `app\Http\Controllers`
2. 创建控制器: `php artisan make:controller PostController`
3. 验证: `$this->validate($valid1, $valid2, $valid3)`

	$valid1  验证的对象 request()
	
	$valid2 验证规则
	
	$valid3 返回的错误信息
	
```php
 $this->validate(request(), [
     'title' => 'required|string|max:100|min:5',
     'content' => 'required|string|min:10'
 ]);
```

4. 改变返回的错误信息语言:
	目录: `resources/lang/zh/validation.php`
	将该目录文件内容替换成[该链接内容](https://gist.github.com/linkdesu/994b59c8dc6217dd299a)即可

#### 模型
1. 目录: `app`
2. 创建模板: `php artisan make:model Post`

```php
$posts = Post::create(request(['title', 'content']));
        return redirect("/posts");
```

3. 如果request()接收的是数组则需在模型里配置 `protected $guarded = [];`
	`protected $guarded // 不可以注入的字段`
	`protected $fillable // 可以注入的数据字段`
	一般设置为基类其他模型继承该类
	
#### 数据填充
1. 目录: `database\factories\ModelFactory.php`

```php
$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(6),
        'content' => $faker->paragraph(10),
    ];
});
```

2. 执行填充: 进入tinker环境 
	查看插入的数据: `factory(App\model:class,10)->make`
	执行插入的数据: `factory(App\model:class,10)->create`

#### 分页
1. 使用自带的的分页，只需调用 `paginate(7)` 方法即可 例如: `$posts = Post::orderby("created_at","desc")->paginate(6);` 页面渲染使用 `{{$posts->links()}}`

#### 文件上传
1. 配置文件目录: `config/filesystems.php`
	默认`'default' => 'local'` 文件指向`storage\app`
	修改 `'default' => 'public'` 文件指向 `public\storage`
	执行 `执行 php artisan storage:link` 创建软连接
	这时 `public \storage` 指向了 `storage\app\public`

```php
    public function imageUpload(Request $request) {
        $path = $request->file('wangEditorH5File')->storePublicly(md5(time()));
        return asset('storage/'. $path);
    }
```
