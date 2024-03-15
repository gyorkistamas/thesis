cd /home/forge/example.com
git pull origin $FORGE_SITE_BRANCH

rsync -a thesisproject/ .

( flock -w 10 9 || exit 1
    echo 'Restarting FPM...'; sudo -S service $FORGE_PHP_FPM reload ) 9>/tmp/fpmlock

if [ -f artisan ]; then
    $FORGE_PHP artisan migrate --force
fi
