# Bitrix24DataSync

### Settings for local access

## Step 1 - Configure
First, make a copy of the example environment configuration file by running the following command:
```bash
cp .env.exemple .env
```

## Step 2 - Environment Setup
Use the following command to set up your environment:
```bash
./vendor/bin/sail up
```
This command will start the necessary Docker containers and set up your environment for the project.

## Step 3 - Access the Bash Shell in Docker
To access the Bash shell within the Docker container, run the following command:
```bash
docker-compose exec app bash
```
This command allows you to interact with the container for any specific tasks you might need to perform.

## Step 4 - Configuration and Dependencies
Ensure that your application is properly configured and has all the required dependencies. Execute the following commands one by one:
```bash
chmod -R 777 storage && php artisan key:generate && php artisan migrate --seed && rm -rf public/storage && php artisan storage:link && php artisan queue:work
```

## Step 5 - Access dashboard
URL
```bash
http://localhost/
```
Mail
```bash
test@example.com
```
Pass
```bash
123
```