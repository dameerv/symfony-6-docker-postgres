## Start
```
git clone git@github.com:dameerv/symfony-6-docker-postgres.git project_path
```
```
cd project_path/ 
docker-compose up -d
docker-compose exec app bash
composer install
bin/console doctrine:database:create
bin/console doctrine:migrations:migrate
```
The application is now ready for use

## Examples
### /calculate-price

```
curl --location 'http://127.0.0.1:80/calculate-price' \
--header 'Content-Type: application/json' \
--data '{
"product": 1,
"taxNumber": "DE123456789",
"couponCode": "D15"
}'
```

### /purchase
```
curl --location 'http://127.0.0.1:80/purchase' \
--header 'Content-Type: application/json' \
--data '{
"product": 2,
"taxNumber": "IT12345678900",
"couponCode": "D15",    
"paymentProcessor": "paypal"
}'
```

