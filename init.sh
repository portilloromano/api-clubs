echo "--------------------------"
echo "CREATE API"
echo "--------------------------"
# Execute composer
echo "Install Composer"
docker exec -ti api sh -c "COMPOSER_MEMORY_LIMIT=-1 composer install"
# Copy .env.example as .env
echo "Create .env"
docker exec -ti api sh -c "cp .env.example .env"
#Create encryption key.
echo "Create Encryption Key"
docker exec -ti api sh -c "php artisan key:generate"
#Create migration.
echo "Create Migration"
docker exec -ti api sh -c "php artisan migrate:fresh"
#Execute Seeder.
echo "Execute Seeder"
docker exec -ti api sh -c "php artisan db:seed"
#Generate Swagger
docker exec -ti api sh -c "php artisan l5-swagger:generate"
