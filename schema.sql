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

-- Table for general application settings
CREATE TABLE settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    site_theme VARCHAR(255)
);

INSERT INTO settings (id, site_theme) VALUES (1, '0C8t2cUp9wzh2tWfUWiDhRzHlRjKBeyWA7rG');

-- Theme definitions
CREATE TABLE themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme_name VARCHAR(255),
    theme_dirname VARCHAR(255) UNIQUE,
    theme_extras TEXT,
    newpage TEXT,
    last_modified DATETIME
);

INSERT INTO themes (theme_name, theme_dirname, theme_extras, newpage, last_modified) VALUES
('Default Theme', '0C8t2cUp9wzh2tWfUWiDhRzHlRjKBeyWA7rG', '{"stylesheets": ["bootstrap.css", "style.css"]}', '', '0000-00-00 00:00:00');

-- Miscellaneous options used by the panel
CREATE TABLE General_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    currency_format INT DEFAULT 0
);

INSERT INTO General_options (id, currency_format) VALUES (1, 0);

-- Basic panel information
CREATE TABLE panel_info (
    panel_id INT AUTO_INCREMENT PRIMARY KEY,
    panel_type VARCHAR(255),
    panel_name VARCHAR(255)
);

INSERT INTO panel_info (panel_id, panel_type, panel_name) VALUES (1, 'Main', 'SMM Panel');

-- Currency list for exchange rates
CREATE TABLE currency (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(10),
    symbol VARCHAR(10),
    value DECIMAL(20,8),
    dolar_charge DECIMAL(20,8) DEFAULT 1
);

INSERT INTO currency (id, code, symbol, value, dolar_charge) VALUES (1, 'USD', '$', 1.0, 1.0);

-- Supported interface languages
CREATE TABLE languages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    language_name VARCHAR(255),
    language_code VARCHAR(50) UNIQUE,
    language_type TINYINT DEFAULT 2,
    default_language TINYINT DEFAULT 0
);

INSERT INTO languages (language_name, language_code, language_type, default_language) VALUES
('English', 'en', 2, 1),
('Deutsch', 'de', 2, 0),
('Portuguese Brazil', 'pt-BR', 2, 0),
('Türkçe', 'tr', 2, 0);
