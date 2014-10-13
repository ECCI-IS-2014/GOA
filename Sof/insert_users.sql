
-- Script para poblar la tabla users con datos de prueba.
-- Asegurarse de vaciar las tabla users antes de ejecutarlo.

-- admin password: admin1
-- users mich, pao, david, caro, password: 123456

ALTER TABLE users AUTO_INCREMENT = 1;

INSERT INTO users (username, password, role, email, gender)
                       VALUES
                       ('admin', 'admin1','1', 'admin@gmail.com');
					   
INSERT INTO users (username, password, name, last_name, phone, address, email, gender, birth_date)
                       VALUES
                       ('pao', '123456', 'Paolo', 'Rimolo','82728929','Heredia, San Rafael, Rio grande','pao@gmail.com', 'F', '1997-10-13');

INSERT INTO users (username, password, name, last_name, phone, address, email, gender, birth_date)
                       VALUES
                       ('mich', '123456', 'Michelle', 'Cersosimo','89282727','Coronado 600 mtr este Residencial Like a Boss','mich@gmail.com', 'M', '1995-10-13');


INSERT INTO users (username, password, name, last_name, phone, address, email, gender, birth_date)
                       VALUES
                       ('dav', '123456', 'David', 'Perez','81582727','Alajuela, San Isidro','davo@gmail.com', 'M', '1991-10-13');

INSERT INTO users (username, password, name, last_name, phone, address, email, gender, birth_date)
                       VALUES
                       ('caro', '123456', 'Carolina', 'Azofeifa','87171717','Puntarenas, Grecia', 'caro@gmail.com', 'F', '1992-10-13');
