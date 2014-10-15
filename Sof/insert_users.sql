
-- Script para poblar la tabla users.
-- Asegurarse de vaciar la tablas users antes de ejecutarlo.
-- Pasword de admin es admin1
-- Pasword de usuario es 123456

ALTER TABLE users AUTO_INCREMENT = 1;

INSERT INTO users ( `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`, `phone`, `address`, `email`, `gender`, `birth_date` )
                       VALUES
                       ( 'admin', '$2a$10$QsNPaOWnlwAxAbYyJRpFp.ZeQeE4lelnJsaSpE1MojOqS0EgaIW0m', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 0, '', '', '', '0000-00-00' );

INSERT INTO users ( `username`, `password`, `role`, `created`, `modified`, `name`, `last_name`, `phone`, `address`, `email`, `gender`, `birth_date` )
                       VALUES
                       ( 'usuario', '$2a$10$qfQJOKQ89Ogh78OlbOe7f.CHWU.qJg5BOhsAxtv/bq/C0usvORZWa', 0, '2014-10-15 02:33:56', '2014-10-15 02:33:56', 'Usuario', 'Usuario', 88888888, '200mts Norte del Palo de Mango', 'us@gmail.com', 'F', '1994-10-15' );