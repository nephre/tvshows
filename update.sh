#!/bin/bash

ENV=${1}

php app/console cache:clear --env=${ENV} --no-debug
php app/console assets:install web
php app/console assetic:dump web
