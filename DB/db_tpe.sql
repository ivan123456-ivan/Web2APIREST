-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-11-2023 a las 03:03:24
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tpe`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(6, ' Pizza'),
(5, 'Beverages'),
(8, 'Empanadas'),
(7, 'Hamburgers');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `price` float NOT NULL,
  `stock` int(11) NOT NULL,
  `id_categories` int(11) NOT NULL,
  `id_shops` int(11) NOT NULL,
  `product_image` varchar(250) NOT NULL,
  `product_description` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `stock`, `id_categories`, `id_shops`, `product_image`, `product_description`) VALUES
(24, 'Coca-Cola', 2, 50, 5, 11, 'https://cdn.gobankingrates.com/wp-content/uploads/2019/05/Coca-Cola-can-dropped-in-water-shutterstock_559599946.jpg?quality=75&w=800&webp=1', 'Refreshing cola-flavored carbonated drink.'),
(25, 'Mineral Water', 1, 100, 5, 11, 'https://www.riverkeeper.org/wp-content/uploads/2018/04/bottled-water-credit-CC-Myrtle-Beach-TheDigitel-viaFlickr-modified-1000-650x333.jpg', 'Pure and natural bottled water.'),
(26, 'Orange Juice', 2, 30, 5, 11, 'https://images.herzindagi.info/image/2020/Nov/orange-juice-for-health.jpg', 'Freshly squeezed orange juice.'),
(27, 'Craft IPA Beer', 5, 20, 5, 11, 'https://img.spiegelau.com/w_430,q_80,v_801997,hash_d7e80e/dam/4000x4000px-Product-Grid-n-Gallerie/SPIEGELAU/until-08-2022/4000x4000px_4991382_4992662_4991782_4991693_4991697_PR_CraftBeerGlasses_IPA_08.jpg', 'Craft beer with a hint of hops and citrus.'),
(28, 'Iced Tea', 3, 40, 5, 11, 'https://www.revolutiontea.com/cdn/shop/articles/green-iced-tea_1445x.jpg?v=1623361458', 'Homemade iced tea sweetened with lemon.'),
(29, 'Margherita Pizza', 13, 15, 6, 11, 'https://i.pinimg.com/564x/dd/db/13/dddb13ae6e2e53257dac1af98fe376ba.jpg', 'Classic pizza with tomato sauce, mozzarella, '),
(30, 'Pepperoni Pizza', 15, 10, 6, 11, 'https://hacermasapizza.com/img/pizza-pepperoni-916.jpg', 'Pizza with tomato sauce, mozzarella, and pepp'),
(31, 'Vegetarian Pizza', 14, 8, 6, 11, 'https://thetastyk.com/wp-content/uploads/2016/07/Healthy-Vegan-Pizza.jpg', 'Pizza with tomato sauce, mozzarella, and a va'),
(32, 'BBQ Chicken Pizza', 16, 7, 6, 11, 'https://d104wv11b7o3gc.cloudfront.net/wp-content/uploads/2018/02/BBQ-chicken-crust-pizza-5-600x900.jpg', 'Pizza with BBQ sauce, grilled chicken, mozzar'),
(33, 'Pesto and Cherry Tomato Pizza', 14, 9, 6, 11, 'https://www.healthyseasonalrecipes.com/wp-content/uploads/2014/08/grilled-pesto-pizza-017.jpg', 'Pizza with pesto sauce, fresh cherry tomatoes'),
(34, 'Classic Burger', 9, 20, 7, 11, 'https://cook.fnr.sndimg.com/content/dam/images/cook/fullset/2011/5/9/1/cc-web-burger_classic-burger-sarah-copeland-4166-02_s4x3.jpg.rend.hgtvcom.826.620.suffix/1357780920227.jpeg', ' 100% beef burger with lettuce, tomato, and m'),
(35, 'BBQ Burger', 10, 15, 7, 11, 'https://recipes.net/wp-content/uploads/2021/10/the-best-grilled-bbq-burger-recipe.jpg', ' Burger with BBQ sauce, caramelized onions, a'),
(36, 'Vegetarian Burger', 11, 12, 7, 11, 'https://www.realsimple.com/thmb/SU9YyxI_5dFIurutkkGUe0iieLI=/750x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/real-simple-mushroom-black-bean-burgers-recipe-0c365277d4294e6db2daa3353d6ff605.jpg', 'Chickpea burger with avocado and fresh spinac'),
(38, 'Chicken Burger', 8, 18, 7, 11, 'https://assets.unileversolutions.com/recipes-v2/243652.jpg?im=Resize,height=530;Crop,size=(540,530),gravity=Center', 'Grilled chicken burger with lettuce and speci'),
(39, 'Turkey Burger', 11, 14, 7, 11, 'https://www.briannas.com/wp-content/uploads/2014/03/turkey-burger-header.jpg', 'Lean turkey burger with sun-dried tomatoes an'),
(40, 'Beef Empanada', 3, 30, 8, 11, 'https://numstheword.com/wp-content/uploads/2014/04/EMPANADAS-5-735x1007.jpg.webp', 'Filled with seasoned ground beef.'),
(41, 'Chicken and Mushroom Empanada', 3, 20, 8, 11, 'https://mediaproxy.salon.com/width/1200/https://media.salon.com/2020/02/empanadas-0205201.jpg', 'Filled with chicken, mushrooms, and onions.'),
(42, 'Cheese and Spinach Empanada', 3, 20, 8, 11, 'https://ourplantbasedworld.com/wp-content/uploads/2021/03/easy-argentine-spinach-empanadas-recipe-6989.jpg', 'Filled with cheese and fresh spinach.'),
(43, 'Ham and Cheese Empanada', 3, 22, 8, 11, 'https://assets.bonappetit.com/photos/5d923d42c5d4ea0008b45ea5/1:1/w_1600,c_limit/1019-Ham-Empenadas-2.jpg', 'Filled with ham and melted cheese.'),
(44, 'Portobello Mushroom Empanada', 3, 18, 8, 11, 'https://ourplantbasedworld.com/wp-content/uploads/2021/03/IMG_2466.jpg', 'Filled with Portobello mushrooms and carameli'),
(47, 'Mojito', 2, 100, 5, 12, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXaG3Ja_jWKko21BVCPWxL1bxSC_KPWFtW2A', 'El mojito​ es un cóctel popular originario de'),
(48, 'Hamburguesa Casera', 3, 100, 7, 12, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT-vIlIESFn0xKWxOKlomHNmMqeBh1h7VfT2A', 'Hamburguesa rellena de 3 capas de carne, supe');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `shops`
--

CREATE TABLE `shops` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `shop_image` varchar(250) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `shops`
--

INSERT INTO `shops` (`id`, `name`, `address`, `shop_image`, `id_users`) VALUES
(11, 'Restaurant', 'A random address', 'https://www.spectator.co.uk/wp-content/uploads/2022/07/Tanya-The-Savoy.jpg', 5),
(12, 'Bar', 'A random address', 'https://cnnespanol.cnn.com/wp-content/uploads/2022/10/221004154233-01-world-best-bars-2022-full-169.jpg?resize=1024,576', 5),
(13, 'Comedor Universidad', 'Facultad Ciencias Exactas', 'https://www.unicen.edu.ar/sites/default/files/imagenes/actualidad/2009-11/comedor.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `user`, `password`) VALUES
(1, 'webadmin', '$2y$10$MrrNrVH20xLJAxTC6ycQFeWQPakMXCaKK7ntevYRetIlq7n5q7VpO'),
(5, 'Restaurant', '$2y$10$E8nnIkBPXROj0.89Suyac.MudnWNYVGNKiEaSMBXxO/E3HuhtKk0K');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre_UNIQUE` (`name`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id_idx` (`id_categories`),
  ADD KEY `fk_productos_comercios1_idx` (`id_shops`);

--
-- Indices de la tabla `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users_idx` (`id_users`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `shops`
--
ALTER TABLE `shops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `categoria_id` FOREIGN KEY (`id_categories`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_productos_comercios1` FOREIGN KEY (`id_shops`) REFERENCES `shops` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `shops`
--
ALTER TABLE `shops`
  ADD CONSTRAINT `id_users` FOREIGN KEY (`id_users`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
