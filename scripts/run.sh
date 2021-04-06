#!/bin/sh
set -e

# Execute your custom scripts
/wait
echo "before migrate"
#composer install
php artisan migrate
echo "Done."
#End with running the original command
tail -f /dev/null
exec "$@"