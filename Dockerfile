# PHP 8.3 FPM イメージ
FROM php:8.3-fpm

# 作業ディレクトリ
WORKDIR /var/www/html

# 必要パッケージ＋Nodeをインストール（Node 20）
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libzip-dev zip curl \
    && docker-php-ext-install pdo pdo_mysql \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@latest

# composer コピー
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# アプリのソースをコピー
COPY . .

# PHP 依存パッケージインストール
RUN composer install --no-dev --optimize-autoloader

# Vite（フロント）のビルド
RUN npm install --legacy-peer-deps && npm run build

# キャッシュ系コマンドはビルド時にやらない
# Render の Post-Deploy Command で実行

# ポート公開
EXPOSE 10000

# 起動コマンド
CMD php artisan serve --host=0.0.0.0 --port=10000