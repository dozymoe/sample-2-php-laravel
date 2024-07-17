CREATE DATABASE sample3_laravel CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE DATABASE sample3_laravel_test CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

CREATE USER 'demo'@'%' IDENTIFIED BY 'demo';

GRANT ALL PRIVILEGES ON sample3_laravel.* TO 'demo'@'%';
GRANT ALL PRIVILEGES ON sample3_laravel_test.* TO 'demo'@'%';
