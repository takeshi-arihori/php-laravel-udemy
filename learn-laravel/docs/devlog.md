# 開発の流れ

## Laravelモデル・マイグレーション作成

- マイグレーションファイルは、作成時には単数

#### モデルの作成
```
sail artisan mkake:model Test
```

#### マイグレーション時
- マイグレーションファイルは実行時には複数
```
sail artisan make:migration create_tests_table
```

- テーブルを全て削除し再生成
```
sail artisan migrate:fresh
```

- ロールバックして再生成
```
sail artisan migrate:refresh
```

- ロールバックを行う
```
sail artisan migrate:rollback
```

## tinkerを使用してDB簡易接続
```
takeshi-arihori@TakeshinoMacBook-Pro learn-laravel % sail artisan tinker
Psy Shell v0.11.20 (PHP 8.2.10 — cli) by Justin Hileman
> $test = new App\Models\Test;
= App\Models\Test {#6289}

> $test->text = "aaa";
= "aaa"

> $test->save();
= true

> App\Models\Test::all();
= Illuminate\Database\Eloquent\Collection {#6988
    all: [
      App\Models\Test {#7245
        id: 1,
        text: "aaa",
        created_at: "2023-09-08 17:55:16",
        updated_at: "2023-09-08 17:55:16",
      },
    ],
  }

>
```

## Controllerの作成

```
sail artisan make:controller TestController
```

- web.php
```
use App\Http\Controllers\TestController;
use App\Models\Test;



Route::get('tests/test', [TestController::class, 'index']);
```

- TestController.php
```
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return view('tests.test');
    }
}
```
