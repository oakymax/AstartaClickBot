
## Клонировать репозиторий и опубликовать конфиги

```bash
git clone git@github.com:oakymax/boopbot.git
cd boopbot
cp docker-compose.dev.yml docker-compose.yml
cp docker/dev.Dockerfile docker/Dockerfile
cp .env.example .env
cp .docker.env.example .docker.env  
```

## Настроить конфиги

## Запустить контейнер

```bash
sail up -d
sail composer install
sail artisan migrate
sail artisan key:generate
```

## 
