INSERT INTO `themes` (`name`, `description`, `css_file`, `layout_file`) VALUES 
('minimal', 'A clean and simple theme', 'minimal.css', 'layouts.minimal.app'),
('business', 'A professional theme for businesses', 'business.css', 'layouts.business.app'),
('creative', 'A vibrant and colorful theme', 'creative.css', 'layouts.creative.app');

INSERT INTO `stores` (`name`, `store_url`, `email`, `whatsapp`, `theme_id`) VALUES 
('DepositoDeChelas', 'ddc.dev', 'contacto@ddc.dev', '5544332200', 1),
('My Store', 'store.dev', 'contacto@store.dev', '5544332211', 1);

INSERT INTO `currencies` (`code`, `exchange_rate`) VALUES
('MXN', '20'),
('USD', '1');

INSERT INTO `brands` (`name`, `slug`, `image`) VALUES
('Grupo Modelo', 'grupo_modelo', Null),
('Cuahutemoc Moctezuma', 'Cuahutemoc Moctezuma', Null);

INSERT INTO `categories` (`name`, `slug`) VALUES
('Cerveza Clara', 'cerveza-clara'),
('Cerveza Oscura', 'cerveza-oscura'),
('Cerveza Mega', 'cerveza-mega'),
('Cerveza Media', 'cerveza-media'),
('Cerveza Ampolleta', 'cerveza-ampolleta'),
('Cerveza Lata', 'cerveza-lata'),
('Cerveza Laton', 'cerveza-laton'),
('Cerveza Retornable', 'cerveza-retornable'),
('Cerveza Desechable', 'cerveza-desechable'),
('Cerveza Nacional', 'cerveza-nacional'),
('Cerveza Importada', 'cerveza-importada');

INSERT INTO `products` (`name`, `slug`, `price`, `brand_id`) VALUES
('Carton de Cerveza Corona con 24 Botellas de 355ml', 'carton-de-cerveza-corona-con-24-botellas-de-355ml', '299', '1'),
('cerveza victoria 355 ml', 'cerveza-victoria-355-ml', '299', '1'),
('cerveza pacifico 355 ml', 'cerveza-pacifico-355-ml', '349', '1');

INSERT INTO `images` (`product_id`, `name`) VALUES
('1', 'cerveza_corona_355_ml_1.webp'),
('1', 'cerveza_corona_355_ml_2.webp'),
('1', 'cerveza_corona_355_ml_3.webp');

INSERT INTO `descriptions` (`product_id`, `description`) VALUES
('1', 'Cerveza Corona es la cerveza de origen 100% mexicano más vendida en el mundo. Su origen data de 1925, y hoy en día está presente en más de 120 países, solo producida en México, y dedicada a promover lo mejor de nuestra cultura mexicana en el mundo. De estilo Mexican Lager, es una cerveza clara, color dorado, muy ligera y refrescante. Esta presentación de Corona Extra en botella 24 pack de 355ml es ideal para disfrutar junto con tus seres queridos en una fiesta o reunión y con cualquier platillo de mariscos y pescados. Contiene 4.5% de nivel de alcohol.<br><br>TODO CON MEDIDA<br>PROHIBIDA LA VENTA A MENORES DE 18 AÑOS'),
('2', 'Descripcion larga de productos cerveza victoria id 2'),
('3', 'Descripcion larga de productos cerveza pacifico id 3');

INSERT INTO `short_descriptions` (`product_id`, `description`) VALUES
('1', 'Caja de Cerveza Corona Extra con 24 Botellas de 355ml c/u Retornable'),
('2', 'Descripcion corta de productos cerveza victoria id 2'),
('3', 'Descripcion corta de productos cerveza pacifico id 3');

INSERT INTO `product_stores` (`store_id`, `product_id`, `image_id`, `description_id`, `short_description_id`, `status`, `price`, `currency_id`, `primary_category_store_id`) VALUES
('1', '1', '1', '1', '1', 'available', '10', '1', '1'),
('1', '2', '2', '2', '2', 'available', '20', '1', '2'),
('1', '3', '3', '3', '3', 'available', '30', '1', '3'),

('2', '1', '1', '1', '1', 'available', '299', '1', '1'),
('2', '2', '2', '2', '2', 'available', '299', '1', '2'),
('2', '3', '3', '3', '3', 'available', '349', '1', '3');

INSERT INTO `category_stores` (`store_id`, `category_id`, `parent_id`, `is_featured`) VALUES
('1', '1', Null, '1'),
('1', '2', Null, '1'),
('1', '3', Null, '1'),
('1', '4', Null, '0'),
('1', '5', Null, '0'),
('1', '6', Null, '0'),
('1', '7', Null, '0'),
('1', '8', Null, '0'),
('1', '9', Null, '0'),
('1', '10', Null, '0'),
('1', '11', Null, '0'),

('2', '1', Null, '1'),
('2', '2', Null, '1'),
('2', '3', Null, '1');

INSERT INTO `category_store_product_store` (`category_store_id`, `product_store_id`) VALUES
('1', '1'),
('2', '2'),
('3', '3'),

('12', '4'),
('13', '4'),
('13', '5'),
('14', '6');

INSERT INTO `features` (`name`, `parent_id`) VALUES
('Alcohol', Null),
('3.5%', '1'),
('4.5', '1'),

('Envase', Null),
('Retornable', '4'),

('Contiene', Null),
('1 pieza', '6'),
('6 piezas', '6'),
('20 piezas', '6'),
('24 piezas', '6'),

('Cada pieza contiene', Null),
('355 ml', '11'),
('940 ml', '11'),
('1200 ml', '11'),

('Tipo', Null),
('clara', '15'),

('País de origen', Null),
('México', '17'),

('Artesanal', Null),
('Si', '19'),
('No', '19');


INSERT INTO `feature_product` (`feature_id`, `product_id`) VALUES
('3', '1'),
('5', '1'),
('10', '1'),
('12', '1'),
('16', '1'),
('18', '1'),
('21', '1'),

('3', '2'),
('2', '3');
