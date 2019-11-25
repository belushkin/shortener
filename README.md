# Shortener PHP assessment
You are supposed to create a simple URL shortener (think: bit.ly )

#### Splitting given task into stories and putting estimations before coding
| Task description  | Given estimate | Real estimate |
| ------------- | ------------- | ------------- |
| Investigation existing shortener solutions (shorting functions)  | Content Cell  | Content Cell  |
| Create DB schema  | 30m  | 1h  |
| Describe class relation  | 25m  | 25m  |
| Create Dockerfile (Symfony 4) and tools | 15m  | 15m  |
| Create Contollers  | 1h  | 2h  |
| Create Entities  | 30m  | 1h  |
| Create Form  | 30m  | 1h  |
| Create Shortener Service  | 1h  | 1h  |
| Integrate and test app  | 3h  | 3h  |
| **Total**  | **7h**  | **9h**  |

## Resources I found and I would follow:
- https://en.wikipedia.org/wiki/Bijection
- https://www.geeksforgeeks.org/how-to-design-a-tiny-url-or-url-shortener/
- https://stackoverflow.com/questions/742013/how-do-i-create-a-url-shortener




docker-compose exec web php bin/console make:entity
docker-compose exec web php bin/console make:migration
docker-compose exec web php bin/console doctrine:migrations:migrate

docker-compose exec web php bin/console doctrine:database:create
docker-compose exec web php bin/console doctrine:schema:create

docker-compose exec web php bin/console doctrine:migrations:latest
docker-compose exec web php bin/console doctrine:migrations:execute 20191122084001


INSERT INTO url (link, code, created) VALUES ("https:\/\/www.di.fm\/", null, "2019-11-21 17:03:02")