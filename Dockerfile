FROM php:8.3-fpm

# 作業ディレクトリ
WORKDIR /var/www/html

# 必要パッケージ＋Nodeをインストール（curl経由でNode 20）
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

# PHP依存パッケージインストール
RUN composer install --no-dev --optimize-autoloader

# Vite（フロント）のビルド
RUN npm install --legacy-peer-deps && npm run build

# Laravelのキー＆キャッシュまわり
# Renderでは .env（APP_KEY含む）は Secret Files から渡すので、
# ビルド時に key:generate は実行しない
# RUN php artisan key:generate --force

RUN php artisan config:clear
RUN php artisan route:cache || true
RUN php artisan config:cache || true
RUN php artisan view:cache || true

# ポート公開
EXPOSE 10000

# 起動コマンド
CMD php artisan serve --host=0.0.0.0 --port=10000
