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

INSERT INTO products ( category_id, name, price, quantity, image, enable_product, weight )
                       VALUES
                       ( 8, 'Sandals', 30.00, 14, 'sandalias.jpg', 0, 0.25 );

INSERT INTO ratings ( product_id ) VALUES ( 1 );

INSERT INTO products ( category_id, name, price, quantity , image, weight )
                       VALUES
                       ( 8, 'Boots', 70.00, 8, 'botas.jpg', 0.70 );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 2, 0 );

INSERT INTO products ( category_id, name, price, quantity, image, rating, weight )
                       VALUES
                       ( 8, 'Work Shoes', 100.00, 11, 'burros.jpg', 5, 1.00 );

INSERT INTO ratings ( product_id, rating5 ) VALUES ( 3, 1 );

INSERT INTO products ( category_id, name, price, quantity, image, weight )
                       VALUES
                       ( 7, 'Fedora', 20.00, 7, '1413218846-1.jpg', 0.10 );

INSERT INTO ratings ( product_id ) VALUES ( 4 );

INSERT INTO products ( category_id, name, price, quantity, image, weight )
                       VALUES
                       ( 7, 'Chonete', 15.00, 6, 'chonete.jpg', 0.10 );

INSERT INTO ratings ( product_id ) VALUES ( 5 );

INSERT INTO products ( category_id, name, price, quantity, image, rating, weight )
                       VALUES
                       ( 12, 'Umbrella', 10.00, 19, '1413218987-3.jpg', 2, 0.90 );

INSERT INTO ratings ( product_id, rating2 ) VALUES ( 6, 1 );

INSERT INTO products ( category_id, name, price, quantity, image, enable_product, volume, weight )
                       VALUES
                       ( 3, 'Kellogs Cereal', 5.50, 32,'kellogs.jpg', 0, 2050.00, 0.70 );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 7, 0 );

INSERT INTO products ( category_id, name, price, quantity , image, rating, volume, weight )
                       VALUES
                       ( 3, 'Nestle Cereal', 5.00, 22, 'nestle.jpg', 4, 2050.00, 0.70 );

INSERT INTO ratings ( product_id, rating4 ) VALUES ( 8, 1 );

INSERT INTO products ( category_id, name, price, quantity, image, weight )
                       VALUES
                       ( 6, 'Table', 72.00, 3, '1413219529-1.jpg', 9.50 );

INSERT INTO ratings ( product_id ) VALUES ( 9 );

INSERT INTO products ( category_id, name, price, quantity, image, weight )
                       VALUES
                       ( 6, 'Chair', 38.00, 12 , 'silla.png', 5.50);

INSERT INTO ratings ( product_id ) VALUES ( 10 );

INSERT INTO products ( category_id, name, price, quantity, image, weight )
                       VALUES
                       ( 12, 'Candle', 0.25, 341, 'candela.jpg', 0.05 );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 11, 0 );

INSERT INTO products ( category_id, name, price, quantity, image, rating, weight )
                       VALUES
                       ( 4, 'Curtain', 24.00, 26, 'cortina.jpg', 3, 2.50 );

INSERT INTO ratings ( product_id, rating3 ) VALUES ( 12, 1 );

INSERT INTO products ( category_id, name, price, quantity , image, weight )
                       VALUES
                       ( 4, 'Blanket', 28.00, 8, 'cobija.jpg', 1.50 );

INSERT INTO ratings ( product_id ) VALUES ( 13 );

INSERT INTO products ( category_id, name, price, quantity, image, enable_product, weight )
                       VALUES
                       ( 4, 'Pillow', 13.00, 14, 'pillow.jpg', 0, 0.50 );

INSERT INTO ratings ( product_id ) VALUES ( 14 );

INSERT INTO products ( category_id, name, price, quantity , image, weight )
                       VALUES
                       ( 4, 'Mirror', 45.00, 15 , 'espejo.jpg', 3.0 );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 15, 0 );

INSERT INTO products ( category_id, name, price, quantity, image,  description, rating, volume, weight )
                       VALUES
                       ( 9, 'Detergent', 8.00, 32, 'detergente.jpg', 'The cleanest clean!', 5, 7700.00, 5.0 );

INSERT INTO ratings ( product_id, rating5 ) VALUES ( 16, 2 );

INSERT INTO products ( category_id, name, price, quantity, image, volume, weight )
                       VALUES
                       ( 9, 'Suavitel', 8.50, 28, 'suavitel.jpg', 5000.00, 5.0 );

INSERT INTO ratings ( product_id, enable_rating ) VALUES ( 17, 0 );

INSERT INTO products ( category_id, name, price, quantity, image, rating, weight )
                       VALUES
                       ( 2, 'Toothbrush', 3.50, 27, 'cepillo_dientes.jpg', 4, 0.10 );

INSERT INTO ratings ( product_id, rating4 ) VALUES ( 18, 3 );

INSERT INTO products ( category_id, name, price, quantity, image, description, enable_product, weight )
                       VALUES
                       ( 2, 'Toothpaste', 4.25, 45, 'colgate.jpg', 'Oral B 360', 0, 0.10 );

INSERT INTO ratings ( product_id ) VALUES ( 19 );

INSERT INTO products ( category_id, name, price, quantity, image, description, volume, weight )
                       VALUES
                       ( 2, 'Soap', 2.00, 38, 'jabon.jpg','Smells like a babys bottom!', 120.00, 0.10 );

INSERT INTO ratings ( product_id ) VALUES ( 20 );

INSERT INTO products ( category_id, name, price, quantity, image, description, rating, weight )
                       VALUES
                       ( 1, 'Shirt', 30.00, 1058, '1413474144-1.jpg','Color: Blue. Size: Small.', 3, 0.15 );

INSERT INTO ratings ( product_id, rating2, rating4 ) VALUES ( 21, 1, 1 );

INSERT INTO products ( category_id, name, price, quantity, image, description, volume, weight )
                       VALUES
                       ( 5, 'Washing Machine', 364.00, 5, 'lavadora.jpg', '220v. Capacity: 1.5t', 1000000.00, 60.00 );

INSERT INTO ratings ( product_id ) VALUES ( 22 );

INSERT INTO products ( category_id, name, price, quantity, image, rating, volume, weight )
                       VALUES
                       ( 5, 'Microwave Oven', 154.50, 19, 'microondas.jpg', 2, 45000.00, 15.00 );

INSERT INTO ratings ( product_id, rating2 ) VALUES ( 23, 2 );

INSERT INTO products ( category_id, name, price, quantity, image, description, enable_product, volume, weight )
                       VALUES
                       ( 5, 'Fridge', 475.00, 7,'refrigerador.jpg', 'Atlas 3000', 0, 1500000, 85.00 );

INSERT INTO ratings ( product_id ) VALUES ( 24 );

INSERT INTO products ( category_id, name, price, quantity, image,  description, rating, weight )
                       VALUES
                       ( 11, 'Television', 780.00, 12, 'televisor.jpg','Sony Bravia 42', 5, 15.00 );

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






INSERT INTO `cards` (`id`, `expiration_date`, `card_holder`, `balance`, `card_brand`) VALUES
('2897309872176284', '2016-11-18', 'Paolo', '20000.50', 'Visa'),
('6752986723647829', '2015-03-27', 'David', '34920.22', 'Master Card'),
('7829367022378349', '2014-12-24', 'Eduardo', '2345600.30', 'American Express'),
('8926738498762934', '2010-12-01', 'Michelle', '3400.90', 'American Express'),
('8937829034672819', '2019-03-23', 'Caro', '23984.71', 'Master Card');





ALTER TABLE credit_cards AUTO_INCREMENT = 1;

INSERT INTO credit_cards ( `user_id`, `brand`, `card_number`, `card_name`, `expiration_date`, `verification_number` )
                  VALUES ( '2', 'visa', '1111000022220000', 'Charles Chaplin', '2022-6-14', '000' );

INSERT INTO credit_cards ( `user_id`, `brand`, `card_number`, `card_name`, `expiration_date`, `verification_number` )
                  VALUES ( '2', 'mastercard', '3333000044440000', 'Charles Chaplin', '2014-11-4', '000' );
