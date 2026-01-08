# Laravel Multi-Auth Product System

## Overview

A Laravel application with scalable architecture demonstrating multi-authentication, real-time user presence using WebSocket ,
and large-volume CSV product import using queues.

## Tech Stack

- Laravel 12
- PHP 8.4
- MySQL
- Blade + Vanilla JS
- WebSockets
- Redis
- Laravel Queues
- Laravel Reverb
- Laravel Echo + pusher-js
- maatwebsite/excel
- Laravel Guards for Authentication
- Daisy UI with Tailwind CSS

## Features

- Admin & Customer authentication
- Product CRUD
- 100k CSV product import
- Real-time online/offline presence
- Queue-based background processing

## Authentication Architecture (Multi-Auth)

- Guard separation to avoid polymorphic auth complexity and ensures clear security boundaries

Guards used

- Admin users: admin
- Admin : admin
- Customer : customer

Each guard has:

- Its own model (Customer and Admin)
- Its own route group (customers and admins)
- Its own middlewares to check authenticated and guest routes

## Setup

1. **Clone repository & install dependencies**

    ```bash
        git clone <repo>
        cd project

        composer install
        npm install
    ```

2. Configure `.env`

    ```bash
        cp .env.example .env
    ```

3. Run `php artisan key:generate`

4. Run migrations & run seeders

    ```bash
        php artisan migrate

        php artisan db:seed
    ```

5. Run this project `php artisan serve`
6. Start queue worker `php artisan queue:work`
7. Start WebSocket server `php artisan reverb:start`
8. Run npm server `npm run dev`

## Testing

Test Coverage

- Feature test: Product creation
- Unit test: Import validation logic

Run tests by below command

```bash
php artisan test
```

## Conclusion

This project demonstrates:

- Clean Laravel architecture
- Scalable data handling with chunks and queues
- Realtime design using websockets
