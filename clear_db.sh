#!/usr/bin/env bash

PHP="/d/wamp64_new/bin/php/php7.3.1/php.exe"
SCRIPT="/d/www/symfony/4/learning/bin/console"

${PHP} ${SCRIPT} doctrine:schema:drop -n -q --force --full-database && \
rm src/Migrations/*.php && \
${PHP} ${SCRIPT} make:migration && \
${PHP} ${SCRIPT} doctrine:migrations:migrate -n -q

