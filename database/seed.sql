-- =========================================================
-- E-COMMERCE TEST DATA
-- =========================================================

USE ecommerce;


-- =========================================================
-- USERS
-- =========================================================

INSERT INTO users
(name, email, password, role)
VALUES
('Admin', 'admin@example.com', 'REPLACE_WITH_PASSWORD_HASH', 'Admin'),
('Ahmed Ali', 'ahmed@example.com', 'REPLACE_WITH_PASSWORD_HASH', 'Client'),
('Mohamed Hassan', 'mohamed@example.com', 'REPLACE_WITH_PASSWORD_HASH', 'Client'),
('Sara Mohamed', 'sara@example.com', 'REPLACE_WITH_PASSWORD_HASH', 'Client');


-- =========================================================
-- CLIENTS
-- =========================================================

INSERT INTO clients
(user_id, phone, address, city)
VALUES
(2, '01012345678', 'Nasr City', 'Cairo'),
(3, '01123456789', 'Dokki', 'Giza'),
(4, '01234567890', 'Heliopolis', 'Cairo');


-- =========================================================
-- CATEGORIES
-- =========================================================

INSERT INTO categories
(name, description, image)
VALUES
(
    'Phones',
    'Smartphones and mobile devices',
    'phones.jpg'
),
(
    'Laptops',
    'Laptops and computers',
    'laptops.jpg'
),
(
    'Accessories',
    'Electronic accessories',
    'accessories.jpg'
),
(
    'Headphones',
    'Wireless and wired headphones',
    'headphones.jpg'
);


-- =========================================================
-- BRANDS
-- =========================================================

INSERT INTO brands
(name, description, logo)
VALUES
(
    'Apple',
    'Apple electronic products',
    'apple.png'
),
(
    'Samsung',
    'Samsung electronic products',
    'samsung.png'
),
(
    'Lenovo',
    'Lenovo laptops and computers',
    'lenovo.png'
),
(
    'Sony',
    'Sony electronic products',
    'sony.png'
);


-- =========================================================
-- PRODUCTS
-- =========================================================

INSERT INTO products
(category_id, brand_id, name, description, price, stock, image)
VALUES
(
    1,
    1,
    'iPhone 15',
    'Apple iPhone 15 smartphone',
    35000.00,
    10,
    'iphone15.jpg'
),
(
    1,
    2,
    'Samsung Galaxy S24',
    'Samsung Galaxy S24 smartphone',
    30000.00,
    15,
    'galaxy-s24.jpg'
),
(
    2,
    1,
    'MacBook Air',
    'Apple MacBook Air laptop',
    55000.00,
    5,
    'macbook-air.jpg'
),
(
    2,
    3,
    'Lenovo IdeaPad',
    'Lenovo IdeaPad laptop',
    25000.00,
    8,
    'lenovo-ideapad.jpg'
),
(
    3,
    1,
    'AirPods',
    'Apple wireless earbuds',
    7500.00,
    20,
    'airpods.jpg'
),
(
    4,
    4,
    'Sony WH-1000XM5',
    'Sony wireless noise cancelling headphones',
    18000.00,
    12,
    'sony-wh1000xm5.jpg'
);


-- =========================================================
-- TEAM
-- =========================================================

INSERT INTO team
(name, position, description, image, facebook, instagram, linkedin)
VALUES
(
    'Ahmed Ali',
    'CEO',
    'Chief Executive Officer',
    'ahmed.jpg',
    'https://facebook.com/',
    'https://instagram.com/',
    'https://linkedin.com/'
),
(
    'Sara Mohamed',
    'Marketing Manager',
    'Responsible for marketing and campaigns',
    'sara.jpg',
    'https://facebook.com/',
    'https://instagram.com/',
    'https://linkedin.com/'
),
(
    'Mohamed Hassan',
    'Developer',
    'Responsible for website development',
    'mohamed.jpg',
    'https://facebook.com/',
    'https://instagram.com/',
    'https://linkedin.com/'
);


-- =========================================================
-- PARTNERS
-- =========================================================

INSERT INTO partners
(name, logo, website)
VALUES
(
    'Tech Partner',
    'partner1.png',
    'https://example.com/'
),
(
    'Digital Partner',
    'partner2.png',
    'https://example.com/'
),
(
    'Delivery Partner',
    'partner3.png',
    'https://example.com/'
);