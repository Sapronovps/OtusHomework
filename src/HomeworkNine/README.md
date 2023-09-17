# Микросервисы (ссылка на диаграмму https://app.diagrams.net/index.html#G1aFTZEVtwj8E5spnifm_bLcmmNKdRAAz6):
1. Tanki.ru (Gateway) - входная точка взаимодействия с игроками. Выполняет маршрутизацию на все остальные микросервисы в зависимости от полученного запроса с браузера.
2. Auth (Авторизация) - микросервис для регистрации и выдачи токена. Возможные Endpoints: POST /reg, POST /login.
3. Fights (Танковые бои) - микросервис, который отвечает за информацию о текущих танковых боях. Возможно Endpoints: GET /fights{id}, GET /fights, POST /fights. PUT /fights{id}.