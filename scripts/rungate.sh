#!/bin/sh
set -e

#composer install
echo "Done."
#End with running the original command
tail -f /dev/null
exec "$@"