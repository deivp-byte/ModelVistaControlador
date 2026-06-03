## Configuració de la base de dades
És necessària la creació d'una base de dades d'on s'obtindran els productes. 

La taula que es consulta es pot crear amb l'script:

```sql
-- Crear la base de dades si no existeix
CREATE DATABASE IF NOT EXISTS `products`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `products`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Monitor'),
(2, 'Teclado'),
(3, 'Tablet');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `cod` int(11) NOT NULL,
  `short_name` varchar(20) NOT NULL,
  `pvp` decimal(5,2) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`cod`, `short_name`, `pvp`, `nombre`, `category_id`) VALUES
(1, 'Monitor', 400.00, 'Dell 21 full HD', 1),
(2, 'Teclado', 9.99, 'Teclado inalámbrico Logitech', 2),
(3, 'iPad Pro', 900.00, 'Apple iPad Pro 9', 3),
(11, 'Monitor LG', 100.00, 'Monitor LG 4k', 1),
(12, 'Samsung', 100.00, 'Samsung pad', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`cod`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;


Per afegir productes a la taula ```products```  pots utilitzar l'script:

```
INSERT INTO `products` (`cod`, `short_name`, `pvp`, `nombre`,`category_id`) VALUES
(1, 'Monitor', '400.00', 'Dell 21 full HD',1),
(2, 'Teclado', '9.99', 'Teclado inalámbrico Logitech',2),
(3, 'iPad Pro', '900.00', 'Apple iPad Pro 9',3);
```

## Resum patró MVC

Hi ha 3 nivells d'abstracció:

    Model.- És qui defineix la lògica de negoci. Són les classes i els mètodes que es comuniquen directament amb la base de dades.

    Vista.- Mostra la informació a l'usuari de manera lògica i llegible.

    Controlador.- És l'intermediari entre la vista i el model. Controla les interaccions de l'usuari a la vista. Demana les dades al model i les retorna a la vista perquè les mostri. És l'encarregat de realitzar les crides a les classes i als mètodes.

Funcionament del MVC

    L'usuari fa una petició.

    El controlador captura la petició.

    El controlador fa la crida al model corresponent.

    El model interactua amb la base de dades.

    El controlador rep la informació del model (base de dades) i l'envia a la vista.

    La vista mostra la informació.
**Diagrama MVC**

![](mvc-diagram.png) 

