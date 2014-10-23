-- Script para poblar las tablas con datos de prueba
-- Asegurarse de vaciar las tablas antes de ejecutarlo

-- Pasword de admin es admin1
-- Pasword de usuario y usuario 2 es 123456





ALTER TABLE categories AUTO_INCREMENT = 1;

INSERT INTO categories ( name )
                       VALUES
                       ( 'Clothing' );

INSERT INTO categories ( name )
                       VALUES
                       ( 'Personal Care' );

INSERT INTO categories ( name )
                       VALUES
                       ( 'Food' );

INSERT INTO categories ( name )
                       VALUES
                       ( 'Home' );

INSERT INTO categories ( name, father_category_id )
                       VALUES
                       ( 'Appliances', 4 );

INSERT INTO categories ( name, father_category_id )
                       VALUES
                       ( 'Furniture', 4 );

INSERT INTO categories ( name, father_category_id )
                       VALUES
                       ( 'Hats', 1 );

INSERT INTO categories ( name, father_category_id )
                       VALUES
                       ( 'Shoes', 1 );

INSERT INTO categories ( name )
                       VALUES
                       ( 'Cleaning' );

INSERT INTO categories ( name, father_category_id )
                       VALUES
                       ( 'High Heels', 8 );

INSERT INTO categories ( name, father_category_id )
                       VALUES
                       ( 'Televisions', 5 );

INSERT INTO categories ( name )
                       VALUES
                       ( 'Miscellaneous' );



ALTER TABLE products AUTO_INCREMENT = 1;

INSERT INTO products ( category_id, name, price, quantity, image, enable_product )
                       VALUES
                       ( 8, 'Sandals', 2500.00, 14, 'sandalias.jpg', 0 );

INSERT INTO ratings ( product_id ) VALUES ( 1 );

INSERT INTO products ( category_id, name, price, quantity , image )
                       VALUES
                       ( 8, 'Boots', 2500.00, 8, 'botas.jpg' );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 2, 0 );

INSERT INTO products ( category_id, name, price, quantity, image, rating )
                       VALUES
                       ( 8, 'Work Shoes', 2500.00, 11, 'burros.jpg', 5 );

INSERT INTO ratings ( product_id, rating5 ) VALUES ( 3, 1 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 7, 'Fedora', 8200.00, 7, '1413218846-1.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 4 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 7, 'Chonete', 5000.00, 6, 'chonete.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 5 );

INSERT INTO products ( category_id, name, price, quantity, image, rating )
                       VALUES
                       ( 12, 'Umbrella', 3100.00, 19, '1413218987-3.jpg', 2 );

INSERT INTO ratings ( product_id, rating2 ) VALUES ( 6, 1 );

INSERT INTO products ( category_id, name, price, quantity, image, enable_product )
                       VALUES
                       ( 3, 'Kellogs Cereal', 2950.00, 32,'kellogs.jpg', 0 );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 7, 0 );

INSERT INTO products ( category_id, name, price, quantity , image, rating )
                       VALUES
                       ( 3, 'Nestle Cereal', 3400.00, 22, 'nestle.jpg', 4 );

INSERT INTO ratings ( product_id, rating4 ) VALUES ( 8, 1 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 6, 'Table', 36000.00, 3, '1413219529-1.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 9 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 6, 'Chair', 17800.00, 12 , 'silla.png');

INSERT INTO ratings ( product_id ) VALUES ( 10 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 12, 'Candle', 100.00, 341, 'candela.jpg' );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 11, 0 );

INSERT INTO products ( category_id, name, price, quantity, image, rating )
                       VALUES
                       ( 4, 'Curtain', 12000.00, 26, 'cortina.jpg', 3 );

INSERT INTO ratings ( product_id, rating3 ) VALUES ( 12, 1 );

INSERT INTO products ( category_id, name, price, quantity , image)
                       VALUES
                       ( 4, 'Blanket', 9400.00, 8, 'cobija.jpg' );

INSERT INTO ratings ( product_id ) VALUES ( 13 );

INSERT INTO products ( category_id, name, price, quantity, image, enable_product )
                       VALUES
                       ( 4, 'Pillow', 6200.00, 14, 'pillow.jpg',0 );

INSERT INTO ratings ( product_id ) VALUES ( 14 );

INSERT INTO products ( category_id, name, price, quantity , image)
                       VALUES
                       ( 4, 'Mirror', 14300.00, 15 , 'espejo.jpg' );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 15, 0 );

INSERT INTO products ( category_id, name, price, quantity, image,  description, rating )
                       VALUES
                       ( 9, 'Detergent', 4300.00, 32, 'detergente.jpg', 'The cleanest clean!', 5 );

INSERT INTO ratings ( product_id, rating5 ) VALUES ( 16, 2 );

INSERT INTO products ( category_id, name, price, quantity, image )
                       VALUES
                       ( 9, 'Suavitel', 3900.00, 28, 'suavitel.jpg' );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 17, 0 );

INSERT INTO products ( category_id, name, price, quantity, image, rating )
                       VALUES
                       ( 2, 'Toothbrush', 1600.00, 27, 'cepillo_dientes.jpg', 4 );

INSERT INTO ratings ( product_id, rating4 ) VALUES ( 18, 3 );

INSERT INTO products ( category_id, name, price, quantity, image, description, enable_product )
                       VALUES
                       ( 2, 'Toothpaste', 1930.00, 45, 'colgate.jpg', 'Oral B 360', 0 );

INSERT INTO ratings ( product_id ) VALUES ( 19 );

INSERT INTO products ( category_id, name, price, quantity, image, description )
                       VALUES
                       ( 2, 'Soap', 800.00, 38, 'jabon.jpg','Smells like a babys bottom!' );

INSERT INTO ratings ( product_id ) VALUES ( 20 );

INSERT INTO products ( category_id, name, price, quantity, image, description, rating )
                       VALUES
                       ( 1, 'Shirt', 25.00, 1058, '1413474144-1.jpg','Color: Blue. Size: Small.', 3 );

INSERT INTO ratings ( product_id, rating2, rating4 ) VALUES ( 21, 1, 1 );

INSERT INTO products ( category_id, name, price, quantity, image, description )
                       VALUES
                       ( 5, 'Washing Washing', 182000.00, 5, 'lavadora.jpg', '220v. Capacity: 1.5t' );

INSERT INTO ratings ( product_id ) VALUES ( 22 );

INSERT INTO products ( category_id, name, price, quantity, image, rating )
                       VALUES
                       ( 5, 'Microwave Oven', 37300.00, 19, 'microondas.jpg', 2 );

INSERT INTO ratings ( product_id, rating2 ) VALUES ( 23, 2 );

INSERT INTO products ( category_id, name, price, quantity, image, description, enable_product )
                       VALUES
                       ( 5, 'Fridge', 232000.00, 7,'refrigerador.jpg', 'Atlas 3000', 0 );

INSERT INTO ratings ( product_id ) VALUES ( 24 );

INSERT INTO products ( category_id, name, price, quantity, image,  description, rating )
                       VALUES
                       ( 11, 'Television', 430000.00, 12, 'televisor.jpg','Sony Bravia 42', 5 );

INSERT INTO ratings ( product_id, rating5 ) VALUES ( 25, 2 );





ALTER TABLE users AUTO_INCREMENT = 1;

INSERT INTO users ( `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`, `phone`, `address`, `email`, `gender`, `birth_date` )
                       VALUES
                       ( 'admin', '$2a$10$QsNPaOWnlwAxAbYyJRpFp.ZeQeE4lelnJsaSpE1MojOqS0EgaIW0m', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', '0000-00-00' );

INSERT INTO users ( `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`, `phone`, `address`, `email`, `gender`, `birth_date` )
                       VALUES
                       ( 'usuario', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-15 02:33:56', '2014-10-15 02:33:56', 'Usuario', 'Usuario', 88888888, '200mts Norte del Palo de Mango', 'us@gmail.com', 'F', '1994-10-15' );

INSERT INTO users ( `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`, `phone`, `address`, `email`, `gender`, `birth_date` )
                       VALUES
			( 'usuario2', '$2a$10$VkbhvEwoxVQVpAMhiO7G1e8CbzgwkkQQ0xZMuj9sHMOIsfPsE/GSi', 0, '2014-10-22 17:51:55', '2014-10-22 17:51:55', 'Nombre', 'Apellido', 89898989, '100mts Sur de la Pulpe', 'us2@gmail.com', 'M', '1941-10-22');