-- Laboratory Exercise No. 5
-- CRUD Application with Authentication Using LavaLust

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    product_name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- The existing LavaLust project already contains a users migration.
-- If the users table is not yet created, use the project's migration system
-- or create it with the following structure:
--
-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(100) NOT NULL UNIQUE,
--     email VARCHAR(255) NOT NULL UNIQUE,
--     password VARCHAR(255) NOT NULL,
--     role ENUM('admin','moderator','user') NOT NULL DEFAULT 'user',
--     is_active TINYINT(1) NOT NULL DEFAULT 1,
--     created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
--     updated_at DATETIME NULL
-- );

-- Optional test account (password: admin123)
-- Run this only after the users table exists.
-- INSERT INTO users (username, email, password, role, is_active)
-- VALUES ('admin', 'admin@example.com', '$2y$12$SAYO0HJz6NOvLMCpcC62Ruw2AyAU1TEFOaF2zdsNXGr4EWIyy5DGq', 'admin', 1);
