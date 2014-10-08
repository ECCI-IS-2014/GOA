

CREATE TABLE facturas
(
  idFactura int NOT NULL PRIMARY KEY,
  idCliente int NOT NULL,
  tipoVenta varchar(30) NOT NULL,
  fecha datetime NOT NULL,
  tipoEnvioFactura varchar(30) NOT NULL, -- impresa o digital
  CONSTRAINT FK_idCliente FOREIGN KEY (idCliente) REFERENCES clientes (idCliente);
  
);

CREATE TABLE detalleFacturas
(
  idDetalleFactura int NOT NULL PRIMARY KEY,
  idFactura int NOT NULL,
  idProducto int NOT NULL,
  cantidad varchar(50) NOT NULL,
  precio decimal(9,2) NOT NULL default 0.00,
  CONSTRAINT FK_idFactura FOREIGN KEY (idFactura) REFERENCES Factura (idFactura);
  CONSTRAINT FK_idProducto FOREIGN KEY (idProducto) REFERENCES Producto (idProducto);
);

CREATE TABLE carts 
(
  idCarts int NOT NULL PRIMARY KEY,
  idCliente int NOT NULL,
  idProducto int NOT NULL,
  cantidad int NOT NULL default 1,
  CONSTRAINT FK_idProducto FOREIGN KEY (idProducto) REFERENCES Producto (idProducto);
  CONSTRAINT FK_idCliente FOREIGN KEY (idCliente) REFERENCES clientes (idCliente);
);
-- total de todos los precios de los items, -> calcularlo en la interfaz.. sum..

CREATE TABLE wishes 
(
  idWish int NOT NULL,
  idCliente int NOT NULL,
  idProducto int NOT NULL,
  cantidad int NOT NULL default 1,
  -- para mostrar todos todos los productos de x wish de x cliente...
  CONSTRAINT PK_wish_cliente PRIMARY KEY (idWish, idCliente),  
  CONSTRAINT FK_idProducto FOREIGN KEY (idProducto) REFERENCES Producto (idProducto);
  CONSTRAINT FK_idCliente FOREIGN KEY (idCliente) REFERENCES clientes (idCliente);
);
-- total de todos los precios de los items, -> calcularlo en la interfaz.. sum..

CREATE TABLE ordenes 
(
  idOrden int NOT NULL PRIMARY KEY,
  idCliente int NOT NULL,
  idProducto int NOT NULL,
  idFactura int NOT NULL,
  fecha datetime NOT NULL,
  medioPago varchar(50) NOT NULL,  -- efectivo, tarjeta, paypal
  direccionEnvio varchar(100) NOT NULL, -- correos de cr, a la casa, etc
  estado varchar(60) NOT NULL, -- en tramite, enviado, tiempo q dura en cada etapas, 
  -- etapas: empaque, de x lugar a tal lugar. ???
  CONSTRAINT FK_idProducto FOREIGN KEY (idProducto) REFERENCES Producto (idProducto);
  CONSTRAINT FK_idCliente FOREIGN KEY (idCliente) REFERENCES clientes (idCliente);
);

Los administradores del sitio podrán construir un catálogo de productos organizado
jerárquicamente con todas las categorías que deseen. El administrador también podrá
definir "combos" u ofertas especiales de artículos individuales. Será necesario que el
administrador registre datos sobre los costos, impuestos o descuentos relativos a los
artículos, combos u ofertas especiales

CREATE TABLE catalogoProductos 
(
  numCatalogo int NOT NULL PRIMARY KEY,
  idProducto int NOT NULL,
  estadoProducto varchar(30) NOT NULL, -- en oferta, no en oferta
  idCombo int NOT NULL,   
  -- segun precio del producto aplicar descuento
  -- si esta en un combo, ver los articulos asociados al combo y aplicarle descuento a todos
  descuento decimal(9,2) NOT NULL default 0.00, 
  fecha datetime NOT NULL,
  CONSTRAINT FK_idProducto FOREIGN KEY (idProducto) REFERENCES Producto (idProducto);
);

CREATE TABLE ofertaCombos 
(
  -- id combo 0, sera predeterminado a que solo esté el articulo solo
  idCombo int NOT NULL PRIMARY KEY,
  idProducto int NOT NULL,
  -- segun precio de cada producto del combo, aplicar oferta 
  CONSTRAINT FK_idProducto FOREIGN KEY (idProducto) REFERENCES Producto (idProducto);
);


Sobre esto: Sería interesante incluir la
opción de evaluaciones de los clientes sobre los artículos.
Podría hacerse en la interfaz mediante la evaluación de 5 estrellas, siempre visible 
debajo de cada producto. 

Sobre:  El administrador también resolverá problemas que se presenten a los clientes con
sus cuentas.
En footer, poner un link q lleve a un formulario, q envie correo (como en el tuto q vimos)
al admin, y adjunto explica el problema. 

