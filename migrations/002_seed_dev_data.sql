-- Local development seed data. Do not run against production.
-- The app compares passwords in plain text (login.php), so they are stored that way here.

USE cpuenterprise;

INSERT INTO users (name, email, schoolID, role, password, mobile_number, datecreated, status) VALUES
  ('Admin',   'admin@cpu.local',   'ADMIN-001',  'admin',   'admin123',   '09000000000', CURDATE(), 'Active'),
  ('Student', 'student@cpu.local', '2024-00001', 'student', 'student123', '09000000001', CURDATE(), 'Active');

INSERT INTO category (category_name, category_code, description) VALUES
  ('Electronics', 'ELEC', 'Electronic equipment'),
  ('Office',      'OFF',  'Office supplies');

INSERT INTO inventory (product_name, category, sku, minimum_quantity, on_stock, description, image, price, status, date) VALUES
  ('Projector', 'Electronics', 'SKU-0001', 2, 10, 'HD projector',  'assets/img/product/noimage.png', 0, 'Open', CURDATE()),
  ('Stapler',   'Office',      'SKU-0002', 5, 40, 'Heavy stapler', 'assets/img/product/noimage.png', 0, 'Open', CURDATE());
