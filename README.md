# Shortener PHP assessment
You are supposed to create a simple URL shortener (think: bit.ly )

#### Splitting given task into stories and putting estimations before coding
| Task description  | Given estimate | Real estimate |
| ------------- | ------------- | ------------- |
| Investigation existing shortener solutions (shorting functions)  | Content Cell  | Content Cell  |
| Create DB schema  | Content Cell  | Content Cell  |
| Describe class relation  | Content Cell  | Content Cell  |
| Create Dockerfile (Symfony 4) and tools | Content Cell  | Content Cell  |
| Create Contoller  | Content Cell  | Content Cell  |
| Create Entities  | Content Cell  | Content Cell  |
| Create Form  | Content Cell  | Content Cell  |
| Create Shortener Service  | Content Cell  | Content Cell  |
| Integrate and test app  | Content Cell  | Content Cell  |

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