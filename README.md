# Contractor Check — сервис проверки контрагентов
 
Сервис для проверки контрагентов по ИНН: получение данных из DaData, асинхронная генерация PDF-отчёта с аналитикой от AI Gemini, загрузка в S3 и уведомление пользователя по завершении обработки. 
 
Проект построен на **Domain-Driven Design** с разделением на bounded contexts, взаимодействующими через доменные события.
 
## Возможности
 
- Проверка контрагента по ИНН с получением данных из DaData
- Асинхронная генерация PDF-отчёта с загрузкой в S3-совместимое хранилище
- AI-анализ контрагента с помощью Google Gemini при генерации отчёта
- Кэширование ответов внешнего API (Redis)
- Идемпотентные запросы на создание проверки
- Административная панель для управления пользователями и логами запросов
- REST API для интеграции с фронтендом
## Стек
 
| Категория | Технологии |
|---|---|
| Backend | PHP 8.2+, Laravel |
| БД | PostgreSQL |
| Кэш / очереди | Redis, Laravel Queue, Horizon |
| Хранилище файлов | S3 (MinIO в dev-окружении) |
| Внешний API | DaData |
| AI | Google Gemini (`gemini-3.8-flash`) |
| Админка | Filament |
| Инфраструктура | Docker, Docker Compose |
| Тесты | PHPUnit  |
 
## Архитектура
 
Проект разделён на независимые доменные контексты (bounded contexts):
 
Внутри каждого контекста — разделение слоёв:

## Используемые паттерны
 
- **Repository** — интерфейс в Domain, реализация на Eloquent в Infrastructure
- **Value Object** — `Inn` для валидации и защиты инварианта на уровне типа
- **DTO** — на границах слоёв и при разборе ответа DaData
- **Adapter** — интеграция с DaData через `CounterpartyProviderInterface`
- **Domain Events / Observer** — взаимодействие между bounded contexts

## AI-генерация отчёта

Для краткого аналитического описания контрагента используется Google Gemini через Laravel AI: модель `gemini-3.8-flash` обрабатывает сохранённые данные контрагента, а результат попадает в запись отчёта и PDF. Генерация запускается в очереди. Если Gemini недоступен или возвращает ошибку, она записывается в Laravel log, а формирование PDF продолжается с сообщением о недоступности AI-описания.

Для работы функции добавьте собственный `GEMINI_API_KEY` в `backend/.env`. Не коммитьте API-ключи в репозиторий.

## Запуск проекта

Для локального входа в Filament сидер создаёт пользователя `Admin`: `admin@example.com` / `password`. После первого входа смените пароль. Не используйте эти учетные данные в production.
 
```bash
git clone <repo>
cd contractor-check
cp backend/.env.example backend/.env
docker compose -f docker/docker-compose.yml up -d
docker compose -f docker/docker-compose.yml exec app php artisan key:generate
docker compose -f docker/docker-compose.yml exec app php artisan migrate --seed
```
 
После запуска доступны:
 
- API: `http://localhost:8000/api/v1`
- Админка: `http://localhost:8000/admin`
- Horizon (мониторинг очередей): `http://localhost:8000/horizon`
- MinIO (S3): `http://localhost:9001`
- pgAdmin4: `http://localhost:5050/`
- Redis: `http://localhost:8081`

## Тестирование
 
```bash
docker compose -f docker/docker-compose.yml exec app php artisan test
```
 
Доменная логика (Value Objects) покрыта unit-тестами без обращения к БД. API-эндпоинты покрыты feature-тестами.
