# 1. PHP イメージ
FROM php:8.2-cli

# 2. 必要なパッケージをインストール（git, unzip, pdo_mysql など）
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    libonig-dev \
    libxml2-dev \
    && docker-php-ext-install pdo_mysql zip

# 3. Composer をインストール
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 4. アプリケーションコードをコンテナにコピー
WORKDIR /var/www/html
COPY . .

# 5. Composer install（本番用）
RUN composer install --no-dev --optimize-autoloader

# 6. Laravel 用の簡易設定
RUN php artisan config:clear

# 7. ポート指定（Renderは $PORT を使う）
ENV PORT=8000

# 8. コンテナ起動時に実行するコマンド
CMD php artisan migrate --force && php artisan serve --host 0.0.0.0 --port $PORT
