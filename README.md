# Realtime Chat Application

This is a real-time chat application built with Laravel, Vue.js, and Firebase. It allows users to communicate in real-time using text messages.

## Installation

Follow these steps to install and set up the application:

1. Clone the repository to your local machine:
    ```
    git clone <repository_url>
    ```

2. Install PHP dependencies using Composer:
    ```
    composer install
    ```

3. Copy the `.env.example` file and rename it to `.env`:
    ```
    cp .env.example .env
    ```

4. Update the database configuration in the `.env` file with your database credentials.

5. Install JavaScript dependencies using npm:
    ```
    npm install
    ```

6. Set up Firebase:
    - Create a Firebase project on the Firebase console (https://console.firebase.google.com/).
    - Go to your project settings and find your Firebase configuration.
    - Update the Firebase configuration in the appropriate files of your Laravel/Vue.js application.

## Usage

Once you have completed the installation steps:

1. Run the migrations to set up the database schema:
    ```
    php artisan migrate
    ```

2. Compile the Vue.js components:
    ```
    npm run dev
    ```

3. Serve the application:
    ```
    php artisan serve
    ```

4. Access the application in your web browser at `http://localhost:8000`.

## Features

- Real-time messaging: Users can send and receive messages in real-time.
- User authentication: Users can register, login, and logout securely.
- Firebase integration: Firebase is used for real-time database and authentication.
- inertia for handling routes between client and server sides 


