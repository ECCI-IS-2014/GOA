
-- Script para poblar la tabla categorias con datos de prueba
-- Asegurarse de vaciar la tabla categorias antes de ejecutarlo

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