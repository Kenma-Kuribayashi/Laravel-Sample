# Laravel-Sample

## Documents

- 開発環境にDockerを使用

```
1. laravel 5.8
2. php 7.3
3. node 10.16.0
```

#### ローカルに開発環境を構築する

以下の手順で各々の環境に不足しているものを構築してください。

1. リポジトリの Clone
2. `docker-compose` コマンドからビルド+起動
3. データベースのテーブル作成
4. データベースの初期データ登録
5. JavaScriptの設定
6. `docker-compose` コマンドから停止

#### 1. リポジトリの Clone

仮に `~/src` にソースコードを clone する前提とします。

```bash
$ cd ~/src
$ git clone https://github.com/Kenma-Kuribayashi/Laravel-Sample.git
```


#### 2. `docker-compose` コマンドからビルド+起動

```bash
$ cd Laravel-Sample
$ docker-compose build
$ docker-compose up -d
```

以下のように`docker-compose ps`コマンドを実行すると、各 Container の起動状態が確認できます。

```bash
$ docker-compose ps
       Name                     Command               State            Ports         
-------------------------------------------------------------------------------------
laravel-sample-app   docker-php-entrypoint php-fpm    Up      9000/tcp               
laravel-sample-db    docker-entrypoint.sh mysqld      Up      0.0.0.0:13306->3306/tcp
laravel-sample-web   /docker-entrypoint.sh ngin ...   Up      0.0.0.0:80->80/tcp     
```

初回の(2回目以降は必要に応じて) Composer を通して PHP ライブラリのインストール、 .env ファイルのコピーを行う必要があります。
以下のコマンドを実行してください。

 ```bash
$ docker-compose exec app composer install
$ cp -p env/local.env .env
```

#### 3. データベースのテーブル作成

以下のコマンドを実行してください。

 ```bash
$ docker-compose exec app php artisan migrate
```

#### 4. データベースの初期データ登録

以下のコマンドを実行してください。

 ```bash
$ docker-compose exec app php artisan db:seed
```

#### 5. JavaScriptの設定

既にnodeがインストールされていることが前提です。

以下のコマンドを実行してください。

 ```bash
$ npm install
$ npm run dev
```

#### 6. `docker-compose` コマンドから停止

以下のコマンドを実行してください。

 ```bash
$ docker-compose stop
$ docker-compose ps
       Name                     Command               State    Ports
--------------------------------------------------------------------
laravel-sample-app   docker-php-entrypoint php-fpm    Exit 0        
laravel-sample-db    docker-entrypoint.sh mysqld      Exit 0        
laravel-sample-web   /docker-entrypoint.sh ngin ...   Exit 0 
```
