#!/bin/bash

docker-compose exec php composer update

docker-compose exec php bin/console graphql:dump-schema --format graphql --file config/graphql/schema.graphql