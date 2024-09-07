# 🚀 Warehouse CRM

![*Warehouse CRM](https://laravel.com/img/logomark.min.svg)

## ✨ Overview

Welcome to **Warehouse CRM**! This is a comprehensive web application built with Laravel 10 and Vue 3. The project features a REST API for backend operations and a modern Vue 3 frontend with TypeScript, Pinia, and Vue Router.

## 📦 Features

### Backend:

- **Laravel 10**: 
  - Utilizes DTO (Data Transfer Object) approach for clean data handling.
  - Employs strict declaration and filter builder approach for robust querying.
  - Includes Laravel Feature PHPUnit tests for comprehensive backend testing.

- **Swagger**: 
  - REST API documentation is available via Swagger UI. Access it at .

- **Postman**: 
  - A pre-configured Postman collection for testing the API endpoints. 

- **MySQL 8**: 
  - Primary database for storing application data.

- **RabbitMQ**: 
  - Manages queues for asynchronous processing.

- **Docker**: 
  - Runs the application using Docker containers for easier setup and deployment.

### Frontend:

- **Vue 3**: 
  - Modern UI framework leveraging hooks and concurrent features.

- **Pinia**: 
  - State management solution for Vue 3, providing an efficient way to handle state.

- **Vue Router**: 
  - Handles navigation between different pages of the application.

- **TypeScript**: 
  - Adds static typing to Vue components for better development experience and code quality.

- **Vuetify 3**: 
  - Provides a rich set of UI components for building a visually appealing interface.

### Technical debt:

- Add logging of all actions through the queue using Apache Kafka
- QA Testing 
- Check Laravel Feature Tests
- Add more typization on Frontend
- Add Redis cache
- Add Broadcast with WebSocket functionality for Support Service
- Add payment systems (use strategic pattern)
