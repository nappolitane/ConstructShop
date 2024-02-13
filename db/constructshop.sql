SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database : `ConstructShop`
--

-- --------------------------------------------------------

--
-- Structure for table `Customers`
--

CREATE TABLE `Customers` (
  `ID_customer` int NOT NULL,
  `Family_name` varchar(50) NOT NULL,
  `First_name` varchar(100) NOT NULL,
  `Date_of_birth` varchar(30) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Cust_password` varchar(256) NOT NULL,
  `Card_number` varchar(30) DEFAULT NULL,
  `Expiring_date` varchar(30) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Address` varchar(200) DEFAULT NULL,
  `Postal_code` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data for table `Customers`
--

INSERT INTO `Customers` (`ID_customer`, `Family_name`, `First_name`, `Date_of_birth`, `Email`, `Cust_password`, `Card_number`, `Expiring_date`, `Country`, `Address`, `Postal_code`) VALUES
(1, 'Scraba', 'Cristian', NULL, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', NULL, NULL, NULL, NULL, NULL),
(2, 'Vasile', 'Ion', '06/11/1998', 'vasileion@email.com', '2d2b7a52d579f792a244a39076be0e95f7d891aa', '0000-1111-2222-3333', '01/06/2020', 'Romania', 'Fundul Moldovei, Str. Capsunelor nr. 124', '110020'),
(3, 'Popa', 'Alexandru', '30/07/1995', 'alexpopa@email.com', '2d2b7a52d579f792a244a39076be0e95f7d891aa', '1234-1234-1234-1234', '01/05/2021', 'Romania', 'Dolj, Craiova, Strada Cartof nr.14 bl.102 ap.99', '100200'),
(5, 'Test', 'Test', NULL, 'test@test.test', '45a33c2182ac94d46bcd1e03199745f0798524fe', '1111-2222-3333-4444', '31/12/1999', 'Romania', 'asdasdasdasd', '112000');

-- --------------------------------------------------------

--
-- Structure for table `Inbox`
--

CREATE TABLE `Inbox` (
  `ID_message` int NOT NULL,
  `Family_name` varchar(50) DEFAULT NULL,
  `First_name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `Message` varchar(1000) NOT NULL,
  `Subject` varchar(200) NOT NULL,
  `Send_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data for table `Inbox`
--

INSERT INTO `Inbox` (`ID_message`, `Family_name`, `First_name`, `Email`, `Message`, `Subject`, `Send_time`) VALUES
(1, 'Stanescu', 'Catalin', 'stanescucata@email.com', 'I do not like your website!', 'You suck!', '2023-05-11 23:24:05'),
(2, 'Ivan', 'Mihai', 'ivanmihai@email.com', 'Hello!\r\nThe site looks deplorable! Please solve!', 'Review', '2023-05-11 23:53:43');

-- --------------------------------------------------------

--
-- Structure for table `MaterialsCategory`
--

CREATE TABLE `MaterialsCategory` (
  `ID_category` int NOT NULL,
  `Category_name` varchar(100) NOT NULL,
  `Description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data for table `MaterialsCategory`
--

INSERT INTO `MaterialsCategory` (`ID_category`, `Category_name`, `Description`) VALUES
(1, 'Roofs', 'When it comes to roofs, there is diversity in terms of the type of covering and the choice is made according to the requirements of the house: roofs with metal tiles, ceramic tiles, concrete or shingles.'),
(2, 'Thermal and phono insulation', 'The U value is influenced by the thickness of the insulation and the lambda value, the coefficient of thermal conductivity. The lower the lambda value, the more insulating the material.'),
(3, 'Facades and finishes', 'The role of decorative plaster is an aesthetic one. This will be the clothing of the house, what is seen from the outside, so it is an important design element.'),
(4, 'Waterproofing', 'Waterproofing is the most important aspect when you want to build a house. They help keep water away from important works.');

-- --------------------------------------------------------

--
-- Structure for table `Products`
--

CREATE TABLE `Products` (
  `ID_product` int NOT NULL,
  `Product_name` varchar(100) NOT NULL,
  `ID_category` int NOT NULL,
  `Availability` enum('Ordinary','New','Premium') NOT NULL,
  `Description` text NOT NULL,
  `Aplications` text NOT NULL,
  `Price_per_unit` decimal(15,2) NOT NULL,
  `Number_of_units` int NOT NULL,
  `Image` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data for table `Products`
--

INSERT INTO `Products` (`ID_product`, `Product_name`, `ID_category`, `Availability`, `Description`, `Aplications`, `Price_per_unit`, `Number_of_units`, `Image`) VALUES
(1, 'Adhesive mortar', 4, 'Premium', 'Mortar for gluing to the support and reinforcing EPS and XPS polystyrene heat-insulating boards; The StrongFIX product is an adhesive and reinforcing mortar in the form of powders, pre-dosed in the factory and with cement as a binder;', 'Balconies, plinths, basements, walls, water tanks, domestic water installations; Waterproofing of concrete and reinforced concrete, masonry with full joints, mineral plasters;', '94.50', 15, '../images/adhesivemortar.jpg'),
(2, 'Bituminous membranes', 2, 'Premium', 'Membranes with added bitumen, reinforced with fiberglass or polyester braid, protected on the upper side with gray slate granules and on the lower side with polyethylene film with an anti-sticking role during transport and storage;', 'The membranes are recommended for mono- or double-layer waterproofing of foundations and basements, traversable and non-traversable terraces, block roofs, industrial roofs as well as for the restoration of old insulation;', '72.90', 47, '../images/bituminousmembranes.jpg'),
(3, 'Roof foil', 1, 'Premium', 'Multi-layer material, composed of reinforced polyethylene with a special protective layer; The installation is done by applying parallel or cross strips on the rafters, after overlapping the ends are sealed with an adhesive tape with a sealing role;', 'It is used as a vapor barrier under the thermal insulation, in combination with a diffusion layer on the outside, it prevents the appearance of moisture and condensation inside the thermal insulation;', '48.20', 84, '../images/rooffoil.jpg'),
(4, 'Smooth Board', 3, 'Premium', 'The flat sheet can be used for a whole diversity of works, in civil and industrial constructions. The superior qualities of the basic material steel satisfy the requirements of machinability, flexibility, corrosion resistance, durability, aesthetic appearance; Installation is easy due to easy and on-demand cutting, light weight, and low costs.', 'Covering houses, garages, warehouses; metal constructions for billboards, warehouses, halls;', '55.90', 30, '../images/smoothboard.jpg'),
(5, 'Dowel Screw', 2, 'Ordinary', 'Dowels for polystyrene reinforced with fiberglass, for fixing polystyrene;', 'These products can be used in brick, BCA and concrete walls;', '5.90', 94, '../images/dowelscrew.jpg'),
(6, 'Membrane with Studs', 2, 'Ordinary', 'In the usual works as well as in the construction of the tunnels, the HDPE membranes are placed with the studs towards the wall to ensure excellent drainage and allow the drainage of important quantities of water in the most difficult conditions;', 'Protection of foundation walls after applying bituminous waterproofing; Drainage systems; Garden terraces;', '32.40', 60, '../images/membranes_studs.jpg'),
(7, 'Double-adhesive butyl tape', 4, 'New', 'Adhesion by compression; excellent stability at high temperatures; self-adherence; self-sealing; waterproofing and waterproofing; without solvent; easy to peel off the protective film;', 'Assembly and sealing of foundation membranes, panels, metal roofs, metal constructions and prefabricated structures; sealing rainwater drains; combating moisture infiltration;', '25.90', 194, '../images/butyl_tape.jpg'),
(8, 'Bituminous mastic', 4, 'Ordinary', 'Bituminous mastic for waterproofing with hot application - this product is a homogeneous mixture of bitumen and binder;', 'Repairs to waterproofed membrane roofs; for filling expansion joints in concrete platforms, and construction joints; for equalizing and leveling the waterproofing surfaces with minimal deformations;', '68.50', 90, '../images/mastic_bituminous.jpg'),
(9, 'Gypsum Profile', 3, 'New', 'The CD profiles are made of galvanized sheet. They are used to support false ceilings, plasterboard plates being fixed to them;', 'Making false ceilings; mask of expansion joints; making connections to the ceiling; plasterboard masks;', '40.90', 149, '../images/gypsum_profile.jpg'),
(10, 'Plaster rail', 3, 'New', 'This profile allows plastering with controlled thickness and the exact observance of the thickness of the plaster layer;', 'Obtaining perfectly smooth and aesthetic plastered surfaces; increased work speed, especially in combination with a mechanized plastering machine;', '30.90', 200, '../images/plaster_rail.jpg'),
(11, 'Bituminous shingles', 1, 'New', 'Due to its qualities, bituminous shingles offer the possibility of building roofs with an innovative design, harmonized with the environment and the functionality of the building;', 'great flexibility at low temperatures, offering the possibility of installation in any season;', '82.50', 40, '../images/bituminous_shingles.jpg'),
(12, 'Bituminous board', 1, 'Ordinary', 'Organic fibers of high resistance, corrugated, impregnated with asphalt, with a lifetime superior to other types of roof. The corrugation allows the material to be both resistant and light. It is easy to handle;', 'Practical and economical on new building structures; It is a flexible product and can be used on curved roofs; It is fixed on any type of wood, steel or concrete structure;', '75.40', 50, '../images/bituminous_board.jpg');

-- --------------------------------------------------------

--
-- Structure for table `Cart`
--

CREATE TABLE `Cart` (
  `ID_cart` int NOT NULL,
  `ID_product` int NOT NULL,
  `ID_customer` int NOT NULL,
  `Quantity` int NOT NULL,
  `Status` enum('Ordered','Active') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data for table `Cart`
--

INSERT INTO `Cart` (`ID_cart`, `ID_product`, `ID_customer`, `Quantity`, `Status`) VALUES
(39, 1, 2, 2, 'Ordered'),
(40, 3, 2, 14, 'Ordered'),
(42, 2, 2, 1, 'Ordered'),
(43, 4, 2, 2, 'Ordered'),
(44, 1, 2, 2, 'Ordered'),
(47, 2, 2, 1, 'Ordered'),
(48, 1, 3, 1, 'Ordered'),
(49, 3, 3, 1, 'Ordered'),
(50, 2, 3, 2, 'Ordered'),
(52, 2, 2, 1, 'Ordered'),
(53, 4, 2, 2, 'Ordered'),
(54, 4, 2, 2, 'Ordered'),
(55, 4, 2, 2, 'Ordered'),
(56, 1, 2, 2, 'Ordered'),
(57, 2, 2, 1, 'Ordered'),
(58, 3, 2, 15, 'Ordered'),
(59, 2, 2, 1, 'Ordered'),
(60, 3, 2, 14, 'Ordered'),
(61, 3, 2, 14, 'Ordered'),
(62, 1, 2, 3, 'Ordered'),
(63, 1, 2, 2, 'Ordered'),
(64, 1, 2, 2, 'Ordered'),
(65, 2, 2, 1, 'Ordered'),
(66, 1, 2, 2, 'Ordered'),
(67, 3, 2, 14, 'Ordered'),
(68, 4, 2, 2, 'Ordered'),
(69, 1, 2, 2, 'Ordered'),
(70, 4, 2, 2, 'Ordered'),
(71, 3, 2, 14, 'Ordered'),
(72, 1, 2, 2, 'Ordered'),
(73, 4, 2, 2, 'Ordered'),
(74, 4, 2, 2, 'Ordered'),
(75, 1, 2, 2, 'Ordered'),
(76, 2, 2, 1, 'Ordered'),
(77, 4, 2, 2, 'Ordered'),
(78, 4, 2, 2, 'Ordered'),
(79, 3, 2, 14, 'Ordered'),
(80, 3, 2, 14, 'Ordered'),
(81, 3, 2, 14, 'Ordered'),
(82, 3, 2, 14, 'Ordered'),
(83, 3, 2, 14, 'Ordered'),
(84, 3, 2, 12, 'Ordered'),
(88, 1, 2, 2, 'Ordered'),
(90, 2, 2, 1, 'Ordered'),
(91, 2, 2, 1, 'Ordered'),
(93, 2, 2, 9, 'Ordered'),
(94, 4, 2, 2, 'Ordered'),
(101, 7, 3, 300, 'Active'),
(102, 7, 2, 4, 'Active'),
(103, 3, 5, 1, 'Ordered'),
(104, 1, 5, 5, 'Ordered'),
(105, 2, 5, -2, 'Ordered'),
(106, 5, 5, 6, 'Ordered'),
(107, 7, 5, 3, 'Ordered'),
(108, 9, 5, 1, 'Active'),
(109, 8, 5, -100, 'Active');

-- --------------------------------------------------------

--
-- Structure for table `Orders`
--

CREATE TABLE `Orders` (
  `ID_order` int NOT NULL,
  `ID_internal_order` int NOT NULL,
  `ID_cart` int NOT NULL,
  `Total_due` decimal(15,2) NOT NULL,
  `Order_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Data for table `Orders`
--

INSERT INTO `Orders` (`ID_order`, `ID_internal_order`, `ID_cart`, `Total_due`) VALUES
(1, 1, 39, '167.70'),
(2, 1, 40, '167.70'),
(3, 2, 42, '153.80'),
(4, 2, 43, '153.80'),
(5, 3, 44, '119.50'),
(6, 1, 48, '119.50'),
(7, 2, 49, '219.00'),
(8, 2, 50, '219.00'),
(9, 4, 47, '97.90'),
(10, 5, 52, '97.90'),
(11, 6, 53, '80.90'),
(12, 7, 54, '80.90'),
(13, 8, 55, '80.90'),
(14, 9, 56, '119.50'),
(15, 10, 57, '194.30'),
(16, 10, 58, '194.30'),
(17, 11, 59, '97.90'),
(18, 12, 60, '73.20'),
(19, 13, 61, '73.20'),
(20, 14, 62, '214.00'),
(21, 15, 63, '119.50'),
(22, 16, 64, '119.50'),
(23, 17, 65, '97.90'),
(24, 18, 66, '119.50'),
(25, 19, 67, '73.20'),
(26, 20, 68, '80.90'),
(27, 21, 69, '119.50'),
(28, 22, 70, '80.90'),
(29, 23, 71, '73.20'),
(30, 24, 72, '119.50'),
(31, 25, 73, '80.90'),
(32, 26, 74, '80.90'),
(33, 27, 75, '119.50'),
(34, 28, 76, '97.90'),
(35, 29, 77, '80.90'),
(36, 30, 78, '80.90'),
(37, 31, 79, '73.20'),
(38, 32, 80, '73.20'),
(39, 33, 81, '73.20'),
(40, 34, 82, '73.20'),
(41, 35, 83, '73.20'),
(42, 36, 84, '73.20'),
(43, 37, 88, '119.50'),
(44, 38, 90, '97.90'),
(45, 39, 91, '97.90'),
(46, 40, 93, '681.10'),
(47, 41, 94, '80.90'),
(48, 1, 103, '73.20'),
(49, 2, 104, '643.30'),
(50, 2, 105, '643.30'),
(51, 3, 106, '138.10'),
(52, 3, 107, '138.10');

-- --------------------------------------------------------

--
-- Indexes for tables
--

--
-- Indexes for table `Customers`
--
ALTER TABLE `Customers`
  ADD PRIMARY KEY (`ID_customer`);

--
-- Indexes for table `Inbox`
--
ALTER TABLE `Inbox`
  ADD PRIMARY KEY (`ID_message`);

--
-- Indexes for table `MaterialsCategory`
--
ALTER TABLE `MaterialsCategory`
  ADD PRIMARY KEY (`ID_category`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ID_product`),
  ADD KEY `ID_category` (`ID_category`);

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`ID_cart`),
  ADD KEY `ID_product` (`ID_product`),
  ADD KEY `ID_customer` (`ID_customer`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`ID_order`),
  ADD KEY `ID_cart` (`ID_cart`);


--
-- AUTO_INCREMENT for table `Customers`
--
ALTER TABLE `Customers`
  MODIFY `ID_customer` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Inbox`
--
ALTER TABLE `Inbox`
  MODIFY `ID_message` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `MaterialsCategory`
--
ALTER TABLE `MaterialsCategory`
  MODIFY `ID_category` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ID_product` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `ID_cart` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `ID_order` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;


--
-- Constraints for table `Products`
--
ALTER TABLE `Products`
  ADD CONSTRAINT `Products_ibfk_1` FOREIGN KEY (`ID_category`) REFERENCES `MaterialsCategory` (`ID_category`);

--
-- Constraints for table `Cart`
--
ALTER TABLE `Cart`
  ADD CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`ID_product`) REFERENCES `Products` (`ID_product`),
  ADD CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`ID_customer`) REFERENCES `Customers` (`ID_customer`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`ID_cart`) REFERENCES `Cart` (`ID_cart`);

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
