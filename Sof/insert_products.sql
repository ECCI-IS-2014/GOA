
-- Script para poblar las tablas products y ratings con datos de prueba.
-- Asegurarse de vaciar las tablas products y ratings antes de ejecutarlo.

ALTER TABLE products AUTO_INCREMENT = 1;

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 8, 'sandalias', 2500.00, 14 );

INSERT INTO ratings ( product_id ) VALUES ( 1 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 8, 'botas', 2500.00, 8 );

INSERT INTO ratings ( product_id ) VALUES ( 2 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 8, 'burros', 2500.00, 11 );

INSERT INTO ratings ( product_id ) VALUES ( 3 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 7, 'fedora', 8200.00, 7, '1413218846-1.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 4 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 7, 'chonete', 5000.00, 6 );

INSERT INTO ratings ( product_id ) VALUES ( 5 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 10, 'sombrilla', 3100.00, 19, '1413218987-3.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 6 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 3, 'cereal kellogs', 2950.00, 32 );

INSERT INTO ratings ( product_id ) VALUES ( 7 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 3, 'cereal nestle', 3400.00, 22 );

INSERT INTO ratings ( product_id ) VALUES ( 8 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 5, 'mesa', 36000.00, 3, '1413219529-1.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 9 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 5, 'silla', 17800.00, 12 );

INSERT INTO ratings ( product_id ) VALUES ( 10 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 10, 'candela', 100.00, 341 );

INSERT INTO ratings ( product_id ) VALUES ( 11 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 6, 'cortina', 12000.00, 26 );

INSERT INTO ratings ( product_id ) VALUES ( 12 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 6, 'cobija', 9400.00, 8 );

INSERT INTO ratings ( product_id ) VALUES ( 13 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 6, 'almohada', 6200.00, 14 );

INSERT INTO ratings ( product_id ) VALUES ( 14 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 6, 'espejo', 14300.00, 15 );

INSERT INTO ratings ( product_id ) VALUES ( 15 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 9, 'detergente', 4300.00, 32 );

INSERT INTO ratings ( product_id ) VALUES ( 16 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 9, 'suavitel', 3900.00, 28 );

INSERT INTO ratings ( product_id ) VALUES ( 17 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 2, 'cepillo de dientes', 1600.00, 27 );

INSERT INTO ratings ( product_id ) VALUES ( 18 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 2, 'pasta de dientes', 1930.00, 45 );

INSERT INTO ratings ( product_id ) VALUES ( 19 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 2, 'jabon', 800.00, 38 );

INSERT INTO ratings ( product_id ) VALUES ( 20 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 9, 'prensa de ropa', 25.00, 1058 );

INSERT INTO ratings ( product_id ) VALUES ( 21 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 4, 'lavadora', 182000.00, 5 );

INSERT INTO ratings ( product_id ) VALUES ( 22 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 4, 'horno microondas', 37300.00, 19 );

INSERT INTO ratings ( product_id ) VALUES ( 23 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 4, 'refrigerador', 232000.00, 7 );

INSERT INTO ratings ( product_id ) VALUES ( 24 );

INSERT INTO products ( category_id, name, price, quantity )
                       VALUES
                       ( 4, 'televisor', 430000.00, 12 );

INSERT INTO ratings ( product_id ) VALUES ( 25 );
