-- Script para poblar las tablas con datos de prueba
-- Asegurarse de vaciar las tablas antes de ejecutarlo

-- Pasword de admin es admin1
-- Pasword de usuario es 123456





ALTER TABLE categories AUTO_INCREMENT = 1;

INSERT INTO categories ( name )
                       VALUES
                       ('ropa' );

INSERT INTO categories ( name )
                       VALUES
                       ('higiene personal' );

INSERT INTO categories ( name )
                       VALUES
                       ('alimentos' );

INSERT INTO categories ( name )
                       VALUES
                       ('electrodomesticos' );

INSERT INTO categories ( name )
                       VALUES
                       ('muebles' );

INSERT INTO categories ( name )
                       VALUES
                       ('hogar' );

INSERT INTO categories ( name, father_category_id )
                       VALUES
                       ('sombreros', 1 );

INSERT INTO categories ( name, father_category_id )
                       VALUES
                       ('calzado', 1 );

INSERT INTO categories ( name )
                       VALUES
                       ('limpieza' );

INSERT INTO categories ( name )
                       VALUES
                       ('miscelaneo' );





ALTER TABLE products AUTO_INCREMENT = 1;

INSERT INTO products ( category_id, name, price, quantity, image, enable_product )
                       VALUES
                       ( 8, 'sandalias', 2500.00, 14, 'sandalias.jpg', 0 );

INSERT INTO ratings ( product_id ) VALUES ( 1 );

INSERT INTO products ( category_id, name, price, quantity , image)
                       VALUES
                       ( 8, 'botas', 2500.00, 8, 'botas.jpg' );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 2, 0 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 8, 'burros', 2500.00, 11, 'burros.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 3 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 7, 'fedora', 8200.00, 7, '1413218846-1.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 4 );

INSERT INTO products ( category_id, name, price, quantity, image, enable_product )
                       VALUES
                       ( 7, 'chonete', 5000.00, 6, 'chonete.jpg', 0 );

INSERT INTO ratings ( product_id ) VALUES ( 5 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 10, 'sombrilla', 3100.00, 19, '1413218987-3.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 6 );

INSERT INTO products ( category_id, name, price, quantity, image, enable_product )
                       VALUES
                       ( 3, 'cereal kellogs', 2950.00, 32,'kellogs.jpg', 0 );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 7, 0 );

INSERT INTO products ( category_id, name, price, quantity , image)
                       VALUES
                       ( 3, 'cereal nestle', 3400.00, 22, 'nestle.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 8 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 5, 'mesa', 36000.00, 3, '1413219529-1.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 9 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 5, 'silla', 17800.00, 12 , 'silla.png');

INSERT INTO ratings ( product_id ) VALUES ( 10 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 10, 'candela', 100.00, 341, 'candela.jpg' );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 11, 0 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 6, 'cortina', 12000.00, 26, 'cortina.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 12 );

INSERT INTO products ( category_id, name, price, quantity , image)
                       VALUES
                       ( 6, 'cobija', 9400.00, 8, 'cobija.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 13 );

INSERT INTO products ( category_id, name, price, quantity, image, enable_product )
                       VALUES
                       ( 6, 'almohada', 6200.00, 14, 'pillow.jpg',0 );

INSERT INTO ratings ( product_id ) VALUES ( 14 );

INSERT INTO products ( category_id, name, price, quantity , image)
                       VALUES
                       ( 6, 'espejo', 14300.00, 15 , 'espejo.jpg' );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 15, 0 );

INSERT INTO products ( category_id, name, price, quantity, image,  description )
                       VALUES
                       ( 9, 'detergente', 4300.00, 32, 'detergente.jpg', 'El limpio mas limpio!' );

INSERT INTO ratings ( product_id ) VALUES ( 16 );

INSERT INTO products ( category_id, name, price, quantity, image, description )
                       VALUES
                       ( 9, 'suavitel', 3900.00, 28, 'suavitel.jpg' , 'Igual de suave que mama' );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 17, 0 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 2, 'cepillo de dientes', 1600.00, 27, 'cepillo_dientes.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 18 );

INSERT INTO products ( category_id, name, price, quantity, image, description, enable_product )
                       VALUES
                       ( 2, 'pasta de dientes', 1930.00, 45, 'colgate.jpg', 'Oral B 360', 0 );

INSERT INTO ratings ( product_id ) VALUES ( 19 );

INSERT INTO products ( category_id, name, price, quantity, image, description )
                       VALUES
                       ( 2, 'jabon', 800.00, 38, 'jabon.jpg','Huela como nalgas de bebe!' );

INSERT INTO ratings ( product_id ) VALUES ( 20 );

INSERT INTO products ( category_id, name, price, quantity, image, description )
                       VALUES
                       ( 9, 'prensa de ropa', 25.00, 1058, 'prensa.jpg','Super comodas! no generan callos en sus dedos.' );

INSERT INTO ratings ( product_id ) VALUES ( 21 );

INSERT INTO products ( category_id, name, price, quantity, image, description )
                       VALUES
                       ( 4, 'lavadora', 182000.00, 5, 'lavadora.jpg', '220v 1.5t de capacidad.' );

INSERT INTO ratings ( product_id ) VALUES ( 22 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 4, 'horno microondas', 37300.00, 19, 'microondas.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 23 );

INSERT INTO products ( category_id, name, price, quantity, image, description, enable_product )
                       VALUES
                       ( 4, 'refrigerador', 232000.00, 7,'refrigerador.jpg', 'Atlas 3000', 0 );

INSERT INTO ratings ( product_id ) VALUES ( 24 );

INSERT INTO products ( category_id, name, price, quantity, image,  description )
                       VALUES
                       ( 4, 'televisor', 430000.00, 12, 'televisor.jpg','Sony Bravia 42' );

INSERT INTO ratings ( product_id ) VALUES ( 25 );





ALTER TABLE users AUTO_INCREMENT = 1;

INSERT INTO users ( `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`, `phone`, `address`, `email`, `gender`, `birth_date` )
                       VALUES
                       ( 'admin', '$2a$10$QsNPaOWnlwAxAbYyJRpFp.ZeQeE4lelnJsaSpE1MojOqS0EgaIW0m', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', '0000-00-00' );

INSERT INTO users ( `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`, `phone`, `address`, `email`, `gender`, `birth_date` )
                       VALUES
                       ( 'usuario', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-15 02:33:56', '2014-10-15 02:33:56', 'Usuario', 'Usuario', 88888888, '200mts Norte del Palo de Mango', 'us@gmail.com', 'F', '1994-10-15' );