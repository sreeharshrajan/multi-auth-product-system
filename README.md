# Laravel Multi-Auth Product System

## Overview

A Laravel application demonstrating multi-authentication, real-time WebSocket presence,
and high-volume CSV product import using queues.

## Tech Stack

- Laravel
- MySQL
- WebSockets
- Laravel Queues
- maatwebsite/excel

## Features

- Admin & Customer authentication
- Product CRUD
- 100k CSV product import
- Real-time online/offline presence
- Queue-based background processing

## Setup

1. Clone repository
2. Configure `.env`
3. Run `php artisan key:generate`
4. Run migrations
5. Start queue worker
6. Start WebSocket server

## Testing

```bash
php artisan test
