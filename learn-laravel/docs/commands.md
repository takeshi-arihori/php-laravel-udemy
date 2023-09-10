# よく使うコマンド

## マイグレーション時によく使うコマンド
- マイグレーション実施
```
php artisan migrate
```

- 状態表示
```
php artisan migrate:status
```

- 1つ戻す
```
php artisan migrate:rollback
```

- 2つ戻す
```
php artisan migrate:rollback --step=2
```

- ロールバックして再実行
```
php artisan migrate:refresh
```

- テーブル削除して再実行
```
php artisan migrate:fresh
```
