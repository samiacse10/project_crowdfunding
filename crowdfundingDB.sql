CREATE DATABASE crowdfundingDB;
USE crowdfundingDB;

-- =========================
-- USERS TABLE
-- =========================
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    phone VARCHAR(20),
    role ENUM('admin','organizer','donor') DEFAULT 'donor',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- CAMPAIGNS TABLE
-- =========================
CREATE TABLE campaigns (
    id INT AUTO_INCREMENT PRIMARY KEY,
    organizer_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT NOT NULL,
    target_amount DECIMAL(12,2) NOT NULL,
    raised_amount DECIMAL(12,2) DEFAULT 0,
    image VARCHAR(255),
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (organizer_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =========================
-- DONATIONS TABLE (UPDATED)
-- =========================
CREATE TABLE donations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    campaign_id INT NOT NULL,
    donor_id INT NOT NULL,
    amount DECIMAL(12,2) NOT NULL,
    
    -- IMPORTANT FIX
    transaction_id VARCHAR(100) NOT NULL UNIQUE,
    
    payment_status ENUM('pending','success','failed') DEFAULT 'pending',
    payment_method VARCHAR(50) DEFAULT 'SSLCommerz',
    donated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX(transaction_id),

    FOREIGN KEY (campaign_id) REFERENCES campaigns(id) ON DELETE CASCADE,
    FOREIGN KEY (donor_id) REFERENCES users(id) ON DELETE CASCADE
);

-- =========================
-- SSLCOMMERZ TRANSACTIONS TABLE (UPDATED)
-- =========================
CREATE TABLE sslcommerz_transactions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
    donation_id INT,
    
    -- IMPORTANT FIX
    tran_id VARCHAR(100) NOT NULL UNIQUE,
    
    val_id VARCHAR(100),
    amount DECIMAL(12,2),
    currency VARCHAR(10),
    bank_tran_id VARCHAR(100),
    status VARCHAR(50),
    store_amount DECIMAL(12,2),
    verify_sign VARCHAR(255),
    verify_key VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    INDEX(tran_id),

    FOREIGN KEY (donation_id) REFERENCES donations(id) ON DELETE SET NULL
);

-- =========================
-- ADMIN LOGS TABLE
-- =========================
CREATE TABLE admin_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT NOT NULL,
    action TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (admin_id) REFERENCES users(id) ON DELETE CASCADE
);

