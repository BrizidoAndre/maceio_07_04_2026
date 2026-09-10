CREATE TABLE users (
                       user_id INT PRIMARY KEY AUTO_INCREMENT,
                       username VARCHAR(50) NOT NULL,
                       password_hash VARCHAR(100) NOT NULL,
                       email VARCHAR(100) NOT NULL UNIQUE,
                       phone_number VARCHAR(20),
                       token VARCHAR(100),
                       registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE restaurants (
                             restaurant_id INT PRIMARY KEY AUTO_INCREMENT,
                             name VARCHAR(100) NOT NULL,
                             description TEXT,
                             address VARCHAR(255) NOT NULL,
                             phone_number VARCHAR(20) NOT NULL,
                             category_id INT NOT NULL,
                             login VARCHAR(50) NOT NULL UNIQUE,
                             password_hash VARCHAR(100) NOT NULL,
                             photo VARCHAR(255) NOT NULL,
                             FOREIGN KEY (category_id) REFERENCES categories(category_id)
);

CREATE TABLE categories (
                            category_id INT PRIMARY KEY AUTO_INCREMENT,
                            name VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE products (
                          product_id INT PRIMARY KEY AUTO_INCREMENT,
                          restaurant_id INT NOT NULL,
                          name VARCHAR(100) NOT NULL,
                          description TEXT,
                          price DECIMAL(10,2) NOT NULL,
                          photo VARCHAR(255) NOT NULL,
                          FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id)
);

CREATE TABLE promocodes (
                            promocode_id INT PRIMARY KEY AUTO_INCREMENT,
                            restaurant_id INT NOT NULL,
                            code VARCHAR(50) NOT NULL,
                            discount DECIMAL(10,2) NOT NULL,
                            max_uses INT NOT NULL,
                            current_uses INT DEFAULT 0,
                            expires_at TIMESTAMP NOT NULL,
                            FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id)
);

CREATE TABLE orders (
                        order_id INT PRIMARY KEY AUTO_INCREMENT,
                        user_id INT NOT NULL,
                        restaurant_id INT NOT NULL,
                        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        total_amount DECIMAL(10,2) NOT NULL,
                        status ENUM('Pending', 'In Progress', 'Completed', 'Cancelled') NOT NULL DEFAULT 'Pending',
                        promocode_id INT,
                        FOREIGN KEY (user_id) REFERENCES users(user_id),
                        FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id),
                        FOREIGN KEY (promocode_id) REFERENCES promocodes(promocode_id)
);

CREATE TABLE order_items (
                             order_item_id INT PRIMARY KEY AUTO_INCREMENT,
                             order_id INT NOT NULL,
                             product_id INT NOT NULL,
                             quantity INT NOT NULL,
                             price DECIMAL(10,2) NOT NULL,
                             subtotal DECIMAL(10,2) NOT NULL,
                             FOREIGN KEY (order_id) REFERENCES orders(order_id),
                             FOREIGN KEY (product_id) REFERENCES products(product_id)
);

CREATE TABLE reviews (
                         review_id INT PRIMARY KEY AUTO_INCREMENT,
                         user_id INT NOT NULL,
                         restaurant_id INT NOT NULL,
                         rating INT NOT NULL,
                         comment TEXT,
                         date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                         FOREIGN KEY (user_id) REFERENCES users(user_id),
                         FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id)
);

CREATE TABLE promocode_usage (
                                 promocode_usage_id INT PRIMARY KEY AUTO_INCREMENT,
                                 promocode_id INT,
                                 user_id INT,
                                 used_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                                 FOREIGN KEY (promocode_id) REFERENCES promocodes(promocode_id),
                                 FOREIGN KEY (user_id) REFERENCES users(user_id)
);

ALTER TABLE restaurants
DROP FOREIGN KEY fk_category,
ADD CONSTRAINT fk_category FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE;

ALTER TABLE products
DROP FOREIGN KEY fk_restaurant,
ADD CONSTRAINT fk_restaurant FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id) ON DELETE CASCADE;

ALTER TABLE promocodes
DROP FOREIGN KEY fk_restaurant,
ADD CONSTRAINT fk_restaurant FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id) ON DELETE CASCADE;

ALTER TABLE orders
DROP FOREIGN KEY fk_user,
ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE;

ALTER TABLE orders
DROP FOREIGN KEY fk_restaurant,
ADD CONSTRAINT fk_restaurant FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id) ON DELETE CASCADE;

ALTER TABLE orders
DROP FOREIGN KEY fk_promocode,
ADD CONSTRAINT fk_promocode FOREIGN KEY (promocode_id) REFERENCES promocodes(promocode_id) ON DELETE CASCADE;

ALTER TABLE order_items
DROP FOREIGN KEY fk_order,
ADD CONSTRAINT fk_order FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE;

ALTER TABLE order_items
DROP FOREIGN KEY fk_product,
ADD CONSTRAINT fk_product FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE;

ALTER TABLE reviews
DROP FOREIGN KEY fk_user,
ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE;

ALTER TABLE reviews
DROP FOREIGN KEY fk_restaurant,
ADD CONSTRAINT fk_restaurant FOREIGN KEY (restaurant_id) REFERENCES restaurants(restaurant_id) ON DELETE CASCADE;

ALTER TABLE promocode_usage
DROP FOREIGN KEY fk_promocode,
ADD CONSTRAINT fk_promocode FOREIGN KEY (promocode_id) REFERENCES promocodes(promocode_id) ON DELETE CASCADE;

ALTER TABLE promocode_usage
DROP FOREIGN KEY fk_user,
ADD CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE;

INSERT INTO categories (name) VALUES
                                  ('Pizza'),
                                  ('Sushi'),
                                  ('Burgers'),
                                  ('Mexican'),
                                  ('Italian');

INSERT INTO restaurants (name, description, address, phone_number, category_id, login, password_hash, photo) VALUES
                                                                                                                 ('Pizza Palace', 'Best pizza in town!', '123 Main St, Cityville, CA', '+1 (555) 123-4567', 1, 'pizzapalace', 'hashed_password1', 'pizzapalace.png'),
                                                                                                                 ('Sushi Spot', 'Fresh sushi and sashimi.', '456 Elm St, Townburg, NY', '+1 (555) 987-6543', 2, 'sushispot', 'hashed_password2', 'sushispot.jpg'),
                                                                                                                 ('Burger Barn', 'Gourmet burgers and fries.', '789 Oak Ave, Villageton, TX', '+1 (555) 222-3333', 3, 'burgerbarn', 'hashed_password3', 'burgerbarn.jpg'),
                                                                                                                 ('Mexi Grill', 'Authentic Mexican cuisine.', '101 Pine St, Mexicoville, AZ', '+1 (555) 444-5555', 4, 'mexigrill', 'hashed_password4', 'mexigrill.png'),
                                                                                                                 ('Pasta Paradise', 'Delicious Italian pasta dishes.', '321 Cedar Blvd, Pastatown, FL', '+1 (555) 666-7777', 5, 'pastaparadise', 'hashed_password5', 'pastaparadise.jpg');

INSERT INTO products (restaurant_id, name, description, price, photo) VALUES
                                                                          (1, 'Margherita Pizza', 'Classic tomato, mozzarella, and basil.', 10.99, 'margherita.jpg'),
                                                                          (1, 'Pepperoni Pizza', 'Tomato sauce, mozzarella, and pepperoni.', 12.99, 'pepperoni.jpg'),
                                                                          (2, 'Sashimi Platter', 'Assorted slices of fresh fish.', 18.50, 'sashimi.jpg'),
                                                                          (2, 'California Roll', 'Avocado, crab meat, cucumber.', 8.99, 'california_roll.jpg'),
                                                                          (3, 'BBQ Bacon Burger', 'Beef patty, bacon, BBQ sauce.', 11.50, 'bbq_burger.jpeg'),
                                                                          (3, 'Vegetarian Burger', 'Grilled portobello, avocado, sprouts.', 9.99, 'vegetarian_burger.jpg'),
                                                                          (4, 'Tacos al Pastor', 'Marinated pork, pineapple, cilantro.', 7.99, 'tacos.jpg'),
                                                                          (4, 'Enchiladas Verdes', 'Chicken enchiladas with green sauce.', 9.50, 'enchiladas.jpg'),
                                                                          (5, 'Spaghetti Bolognese', 'Spaghetti with meat sauce.', 13.50, 'spaghetti.jpg'),
                                                                          (5, 'Ravioli alla Panna', 'Ravioli with cream sauce and mushrooms.', 15.99, 'ravioli.jpg');

INSERT INTO users (username, password_hash, email, phone_number) VALUES
                                                                     ('John doe', 'hashed_password', 'john.doe@example.com', '+1 (555) 111-2222'),
                                                                     ('Jane smith', 'hashed_password', 'jane.smith@example.com', '+1 (555) 333-4444'),
                                                                     ('Bob jones', 'hashed_password', 'bob.jones@example.com', '+1 (555) 555-6666'),
                                                                     ('Alice green', 'hashed_password', 'alice.green@example.com', '+1 (555) 777-8888'),
                                                                     ('Sam wilson', 'hashed_password', 'sam.wilson@example.com', '+1 (555) 999-0000');

INSERT INTO orders (user_id, restaurant_id, total_amount, status) VALUES
                                                                      (1, 1, 23.98, 'Completed'),
                                                                      (2, 2, 27.49, 'Completed'),
                                                                      (3, 3, 21.49, 'Pending'),
                                                                      (4, 4, 17.49, 'Completed'),
                                                                      (5, 5, 29.49, 'Pending');

INSERT INTO order_items (order_id, product_id, quantity, price, subtotal) VALUES
                                                                              (1, 1, 2, 10.99, 21.98),
                                                                              (1, 2, 1, 12.99, 12.99),
                                                                              (2, 3, 1, 18.50, 18.50),
                                                                              (2, 4, 1, 8.99, 8.99),
                                                                              (3, 5, 1, 11.50, 11.50),
                                                                              (4, 6, 1, 9.99, 9.99),
                                                                              (4, 7, 2, 7.99, 15.98),
                                                                              (5, 8, 1, 9.50, 9.50),
                                                                              (5, 9, 2, 15.99, 31.98);

INSERT INTO reviews (user_id, restaurant_id, rating, comment) VALUES
                                                                  (1, 1, 4, 'Great pizza, fast delivery.'),
                                                                  (2, 2, 5, 'Fresh sushi and great service!'),
                                                                  (3, 3, 3, 'Burgers were good, fries could be better.'),
                                                                  (4, 4, 4, 'Delicious tacos!'),
                                                                  (5, 5, 5, 'Amazing pasta dishes!');

INSERT INTO promocodes (restaurant_id, code, discount, max_uses, expires_at) VALUES
    (1, 'PIZZA5', 5.00, 100, '2024-12-31 23:59:59');

INSERT INTO orders (user_id, restaurant_id, total_amount, status, promocode_id) VALUES
    (1, 1, 18.98, 'Completed', 1);

INSERT INTO promocode_usage (promocode_id, user_id) VALUES
    (1, 1);
