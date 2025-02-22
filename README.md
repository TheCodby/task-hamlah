## Setup Instructions

1. Clone the repository:

    ```sh
    git clone https://github.com/TheCodby/task-hamlah.git
    cd task-hamlah
    ```

2. Copy environment file and generate app key:

    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

3. Build and start Docker containers:

    ```sh
    docker-compose up -d --build
    ```

4. Run database migrations:

    ```sh
    docker-compose exec app php artisan migrate --seed
    ```

5. Access the application:

    - **App URL:** `http://localhost:8000`
    - **Database Host:** `db` (inside Docker)

6. Stop and remove Docker containers:
    ```sh
    docker-compose down
    ```

---
