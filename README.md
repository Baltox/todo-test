# Update Local

```shell
sh updateLocal.sh
```

# Docker

```shell
docker-compose up -d
```

# Dev

```shell
docker-compose exec php yarn dev-server
docker-compose exec php yarn relay --watch
```

# Regenerate graphql schema file

```shell
docker-compose exec php bin/console graphql:dump-schema --format graphql --file config/graphql/schema.graphql
```
