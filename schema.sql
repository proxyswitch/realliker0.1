-- Sample SQL schema for smmexchange

CREATE TABLE clients (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255),
    telephone VARCHAR(50),
    lang VARCHAR(10) DEFAULT 'en',
    register_date DATETIME,
    apikey VARCHAR(64) UNIQUE,
    ref_code VARCHAR(64),
    ref_by VARCHAR(64),
    email_type INT DEFAULT 2,
    balance DECIMAL(20,8) DEFAULT 0,
    spent DECIMAL(20,8) DEFAULT 0,
    client_type INT DEFAULT 1,
    login_date DATETIME,
    login_ip VARCHAR(64),
    passwordreset_token VARCHAR(255)
);

CREATE TABLE admins (
    admin_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    dream_id INT,
    access TEXT,
    login_date DATETIME,
    login_ip VARCHAR(64)
);

CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    service_id INT,
    link TEXT,
    quantity INT,
    status VARCHAR(50),
    created DATETIME,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

CREATE TABLE services (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    category_id INT,
    name VARCHAR(255),
    price DECIMAL(20,8),
    min INT,
    max INT,
    dripfeed TINYINT DEFAULT 0
);

CREATE TABLE categories (
    category_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    method_get VARCHAR(255) UNIQUE,
    method_extras TEXT
);

CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    payment_amount DECIMAL(20,8),
    payment_method VARCHAR(50),
    payment_privatecode VARCHAR(255),
    payment_delivery TINYINT DEFAULT 0,
    created DATETIME,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

CREATE TABLE tickets (
    ticket_id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT,
    subject VARCHAR(255),
    status VARCHAR(50),
    created DATETIME,
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

CREATE TABLE ticket_reply (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT,
    client_id INT,
    message TEXT,
    created DATETIME,
    FOREIGN KEY (ticket_id) REFERENCES tickets(ticket_id),
    FOREIGN KEY (client_id) REFERENCES clients(client_id)
);

-- Additional tables can be created similarly
