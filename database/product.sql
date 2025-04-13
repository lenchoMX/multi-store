/* php artisan migrate:fresh --seed */

INSERT INTO `themes` (`name`, `description`, `css_file`, `layout_file`) VALUES 
('minimal', 'A clean and simple theme', 'minimal.css', 'layouts.minimal.app'),
('business', 'A professional theme for businesses', 'business.css', 'layouts.business.app'),
('creative', 'A vibrant and colorful theme', 'creative.css', 'layouts.creative.app');

INSERT INTO `currencies` (`code`, `name`, `exchange_rate`) VALUES
('MXN', 'Pesos Mexicanos', '20'),
('USD', 'Dolar','1');

INSERT INTO `stores` (`name`, `store_url`, `email`, `whatsapp`, `theme_id`, `currency_id`) VALUES 
('DepositoDeChelas', 'ddc.dev', 'contacto@ddc.dev', '5544332200', 1, 1),
('My Store', 'store.dev', 'contacto@store.dev', '5544332211', 1, 1);

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

INSERT INTO `images` (`product_id`, `url`) VALUES
('1', 'cerveza_corona_355_ml_1.webp'),
('1', 'cerveza_corona_355_ml_2.webp'),
('1', 'cerveza_corona_355_ml_3.webp'),
('2', 'cerveza_victoria_355_ml_1.webp'),
('3', 'cerveza_pacifico_355_ml_1.webp');

INSERT INTO `descriptions` (`product_id`, `content`) VALUES
('1', 'Cerveza Corona es la cerveza de origen 100% mexicano más vendida en el mundo. Su origen data de 1925, y hoy en día está presente en más de 120 países, solo producida en México, y dedicada a promover lo mejor de nuestra cultura mexicana en el mundo. De estilo Mexican Lager, es una cerveza clara, color dorado, muy ligera y refrescante. Esta presentación de Corona Extra en botella 24 pack de 355ml es ideal para disfrutar junto con tus seres queridos en una fiesta o reunión y con cualquier platillo de mariscos y pescados. Contiene 4.5% de nivel de alcohol.<br><br>TODO CON MEDIDA<br>PROHIBIDA LA VENTA A MENORES DE 18 AÑOS'),
('2', 'Descripcion larga de productos cerveza victoria id 2'),
('3', 'Descripcion larga de productos cerveza pacifico id 3');

INSERT INTO `short_descriptions` (`product_id`, `content`) VALUES
('1', 'Caja de Cerveza Corona Extra con 24 Botellas de 355ml c/u Retornable'),
('2', 'Descripcion corta de productos cerveza victoria id 2'),
('3', 'Descripcion corta de productos cerveza pacifico id 3');


INSERT INTO `store_products` (`store_id`, `product_id`, `image_id`, `description_id`, `short_description_id`, `is_active`, `price`, `currency_id`, `stock`) VALUES
('1', '1', '1', '1', '1', '1', '10', '1', '99'),
('1', '2', '4', '2', '2', '1', '20', '1', '99'),
('1', '3', '5', '3', '3', '1', '30', '1', '99'),

('2', '1', '1', '1', '1', '1', '299', '1', '99'),
('2', '2', '4', '2', '2', '1', '299', '1', '99'),
('2', '3', '5', '3', '3', '1', '349', '1', '99');

INSERT INTO `category_stores` (`store_id`, `category_id`, `parent_id`) VALUES
('1', '1', Null),
('1', '2', Null),
('1', '3', Null),
('1', '4', Null),
('1', '5', Null),
('1', '6', Null),
('1', '7', Null),
('1', '8', Null),
('1', '9', Null),
('1', '10', Null),
('1', '11', Null),

('2', '1', Null),
('2', '2', Null),
('2', '3', Null);

INSERT INTO `category_store_store_product` (`category_store_id`, `store_product_id`) VALUES
('1', '1'),
('2', '2'),
('3', '3'),

('12', '4'),
('13', '4'),
('13', '5'),
('14', '6'),

('8', '1'), -- Corona en Cerveza Retornable (store_id=1)
('1', '2'), -- Victoria en Cerveza Clara (store_id=1)
('12', '5'), -- Victoria en Cerveza Clara (store_id=2)
('12', '6'); -- Pacifico en Cerveza Clara (store_id=2)

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

INSERT INTO `feature_product` (`feature_id`, `product_id`) VALUES
(3, 1), -- 4.5% para Corona
(5, 1), -- Retornable para Corona
(10, 1), -- 24 piezas para Corona
(12, 1), -- 355 ml para Corona
(16, 1), -- Clara para Corona
(18, 1), -- México para Corona
(21, 1), -- No artesanal para Corona
(3, 2), -- 4.5% para Victoria
(5, 2), -- Retornable para Victoria
(12, 2), -- 355 ml para Victoria
(16, 2), -- Clara para Victoria
(18, 2), -- México para Victoria
(21, 2), -- No artesanal para Victoria
(2, 3), -- 3.5% para Pacifico
(5, 3), -- Retornable para Pacifico
(12, 3), -- 355 ml para Pacifico
(16, 3), -- Clara para Pacifico
(18, 3), -- México para Pacifico
(21, 3); -- No artesanal para Pacifico

-- (Nota: El password es un hash de prueba para "password". Usa bcrypt('password') en PHP para generar uno real).
INSERT INTO `users` (`store_id`, `given_name`, `family_name`, `email`, `password`, `trust_score`, `risk_level`) VALUES
(1, 'Juan', 'Pérez', 'juan@ddc.dev', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 50, 'low'),
(2, 'María', 'Gómez', 'maria@store.dev', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 50, 'low'),
(1, 'Carlos', 'López', 'carlos@ddc.dev', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 20, 'high');

INSERT INTO `carts` (`user_id`, `store_id`, `session_id`) VALUES
(1, 1, NULL), -- Carrito de Juan en DepositoDeChelas
(2, 2, NULL), -- Carrito de María en My Store
(NULL, 1, 'guest_123'), -- Carrito de invitado en DepositoDeChelas
(NULL, 2, 'guest_456'); -- Carrito de invitado en My Store

INSERT INTO `cart_items` (`cart_id`, `store_product_id`, `quantity`, `price`) VALUES
(3, 1, 1, 10), -- 1 Corona en el carrito de invitado (DepositoDeChelas)
(4, 4, 2, 299), -- 2 Coronas en el carrito de invitado (My Store)
(1, 1, 2, 10), -- 2 Coronas en el carrito de Juan (DepositoDeChelas)
(1, 2, 1, 20), -- 1 Victoria en el carrito de Juan
(2, 4, 1, 299); -- 1 Corona en el carrito de María (My Store)

-- NOTA: checkout_id en addresses corresponde a un ID de una base de datos externa para gestión de riesgos, no a user_id.
INSERT INTO `addresses` (`checkout_id`, `postal_code`, `address_line_1`, `type`) VALUES
(1, '01000', 'Calle Falsa 123, CDMX', 'sepomex'),
(2, '02000', 'Avenida Siempre Viva 456, CDMX', 'sepomex'),
(3, '03000', 'Calle Riesgo 789, CDMX', 'sepomex');

INSERT INTO `address_user` (`address_id`, `user_id`) VALUES
(1, 1), -- Dirección 1 para Juan
(2, 2), -- Dirección 2 para María
(3, 1), -- Dirección de riesgo para Juan
(3, 3); -- Dirección de riesgo para Carlos

INSERT INTO `order_statuses` (`name`) VALUES
('pending'),
('completed');

INSERT INTO `orders` (`store_id`, `user_id`, `shipping_address_id`, `order_number`, `order_date`, `total_amount`, `order_status_id`) VALUES
(1, 1, 1, 'ORD-001', '2025-04-13 10:00:00', 40, 1), -- Orden de Juan con 2 Coronas y 1 Victoria
(2, 2, 2, 'ORD-002', '2025-04-13 12:00:00', 299, 1); -- Orden de María con 1 Corona

INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `unit_price`) VALUES
(1, 1, 2, 10), -- 2 Coronas
(1, 2, 1, 20), -- 1 Victoria
(2, 1, 1, 299); -- 1 Corona

INSERT INTO `coupons` (`code`, `store_id`, `type`, `value`, `is_active`) VALUES
('DESC10', 1, 'percentage', 10, 1), -- 10% en DepositoDeChelas
('FIXED50', 2, 'fixed', 50, 1); -- $50 en My Store

INSERT INTO `discounts` (`store_id`, `type`, `value`, `is_active`) VALUES
(1, 'percentage', 15, 1); -- 15% en DepositoDeChelas

INSERT INTO `discount_product` (`discount_id`, `product_id`) VALUES
(1, 1); -- Descuento aplica a Corona


