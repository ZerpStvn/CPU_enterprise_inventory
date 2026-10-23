-- Schema for the cpuenterprise database.
-- Reconstructed from the queries in the PHP code; no original dump was in the repo.
-- Files in this folder run in filename order the first time the db container starts.

CREATE DATABASE IF NOT EXISTS cpuenterprise
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cpuenterprise;

CREATE TABLE IF NOT EXISTS users (
  id                 INT AUTO_INCREMENT PRIMARY KEY,
  name               VARCHAR(255) NOT NULL,
  email              VARCHAR(255) NOT NULL UNIQUE,
  schoolID           VARCHAR(50),
  role               VARCHAR(20)  NOT NULL DEFAULT 'student',
  password           VARCHAR(255) NOT NULL,
  profile_image      LONGBLOB NULL,
  mobile_number      VARCHAR(30),
  datecreated        DATE,
  status             VARCHAR(20)  NOT NULL DEFAULT 'Pending',
  verification_token VARCHAR(64)  NULL,
  INDEX idx_users_token (verification_token)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS category (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  category_name VARCHAR(255) NOT NULL,
  category_code VARCHAR(100),
  description   TEXT
) ENGINE=InnoDB;

-- inventory.category stores the category *name*, not an id (see addproduct.php)
CREATE TABLE IF NOT EXISTS inventory (
  id               INT AUTO_INCREMENT PRIMARY KEY,
  product_name     VARCHAR(255) NOT NULL,
  category         VARCHAR(255),
  sku              VARCHAR(100),
  minimum_quantity INT NOT NULL DEFAULT 0,
  on_stock         INT NOT NULL DEFAULT 0,
  description      TEXT,
  image            VARCHAR(255),
  price            DECIMAL(10,2) NOT NULL DEFAULT 0,
  status           VARCHAR(20) NOT NULL DEFAULT 'Open',
  date             DATE
) ENGINE=InnoDB;

-- request / reservations copy product columns from inventory at insert time
CREATE TABLE IF NOT EXISTS request (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  productid    INT NOT NULL,
  date         DATETIME,
  name         VARCHAR(255),
  category     VARCHAR(255),
  sku          VARCHAR(100),
  description  TEXT,
  image        VARCHAR(255),
  status       INT NOT NULL DEFAULT 0,
  userID       INT NOT NULL,
  userName     VARCHAR(255),
  schoolID     VARCHAR(50),
  product_name VARCHAR(255),
  INDEX idx_request_user_product (userID, productid)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS reservations (
  id           INT AUTO_INCREMENT PRIMARY KEY,
  productid    INT NOT NULL,
  date         DATETIME,
  name         VARCHAR(255),
  category     VARCHAR(255),
  sku          VARCHAR(100),
  description  TEXT,
  image        VARCHAR(255),
  status       INT NOT NULL DEFAULT 0,   -- 0 = pending, 1 = claimed
  userID       INT NOT NULL,
  userName     VARCHAR(255),
  schoolID     VARCHAR(50),
  product_name VARCHAR(255),
  qtny         INT NOT NULL DEFAULT 1,
  dateclaimed  DATETIME NULL,
  returned     TINYINT NULL,             -- NULL/0 = not returned, 1 = returned
  returndate   DATETIME NULL,
  INDEX idx_reservations_user_product (userID, productid)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS notification (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  user_id   INT NOT NULL,
  productid INT NOT NULL,
  status    VARCHAR(20) NOT NULL,        -- 'request' | 'reserve' | 'restock'
  datetime  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_notification_user (user_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS stockin (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  stockdate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  stockin   INT NOT NULL,
  stockuser VARCHAR(255),
  productid INT,
  userrole  VARCHAR(20),
  sku       VARCHAR(100)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS stockout (
  id        INT AUTO_INCREMENT PRIMARY KEY,
  stockdate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  stockout  INT NOT NULL,
  stockuser VARCHAR(255),
  prodid    INT,
  userrole  VARCHAR(20),
  sku       VARCHAR(100),
  reason    TEXT
) ENGINE=InnoDB;
