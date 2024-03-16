cd /home/forge/szakdolgozat.ddns.net

git reset --hard

git pull origin $FORGE_SITE_BRANCH

rsync -a thesisproject/ .

composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev

# Restart FPM
# ( flock -w 10 9 || exit 1
#     echo 'Restarting FPM...'; sudo -S service $PHP_FPM reload ) 9>/tmp/fpmlock

if [ ! -f .env ]; then
    cp .env.example .env
fi

$FORGE_PHP artisan migrate --force --seed

$FORGE_PHP artisan cache:clear

$FORGE_PHP artisan auth:clear-resets

$FORGE_PHP artisan route:cache

$FORGE_PHP artisan config:cache

$FORGE_PHP artisan storage:link

$FORGE_PHP artisan queue:restart

npm ci

npm run build