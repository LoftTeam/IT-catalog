-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2015 at 02:59 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loft_catalog`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category_products`
--

CREATE TABLE IF NOT EXISTS `category_products` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_products`
--

INSERT INTO `category_products` (`id`, `title`) VALUES
(1, 'Ноутбуки'),
(2, 'Планшеты'),
(3, 'Компьютеры'),
(4, 'Электронные книги'),
(5, 'Видеокамеры'),
(6, 'Программное обеспечение'),
(7, 'Радиотелефоны'),
(8, 'Игры'),
(9, 'Фотоаппараты'),
(10, 'Samrt TV'),
(11, 'Смартфоны'),
(12, 'Новая категоря');

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE IF NOT EXISTS `managers` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `img` varchar(100) NOT NULL,
  `town` varchar(50) NOT NULL,
  `icq` int(11) unsigned NOT NULL,
  `tel` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `managers`
--

INSERT INTO `managers` (`id`, `name`, `lastName`, `img`, `town`, `icq`, `tel`) VALUES
(1, 'Иван', 'Иванов', '/images/content/manager.png', 'Ивановск', 4294967295, '8 (499) 123-45-67'),
(2, 'Петр', 'Петрович', '/images/content/manger2.png', 'Петровск', 4294967295, '8 (499) 123-45-67'),
(3, 'Николай', 'Николаев', '/images/content/manager3.jpg', 'Николаев', 1231231231, '8 (499) 123-45-67');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'В ожидании',
  `date_order` date NOT NULL,
  `payment_methot` varchar(100) NOT NULL,
  `delivery_service` varchar(100) NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE IF NOT EXISTS `order_products` (
  `id_order` int(10) unsigned NOT NULL,
  `product_id` int(11) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `mark` varchar(50) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `description` text,
  `id_catalog` int(11) unsigned DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `img`, `mark`, `count`, `price`, `description`, `id_catalog`) VALUES
(82, 'LG 47LB720V ', NULL, 'LG', 9, 20499, 'Диагональ экрана: 47"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2\r\nЧастота развертки панели: 200 Гц\r\nЧастота обновления: 800 Гц (MCI)\r\nWi-Fi: Да\r\n', 10),
(81, 'LG 42LB582V', NULL, 'LG', 5, 12499, 'Диагональ экрана: 42"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2, DVB-T\r\nЧастота развертки панели: 50 Гц\r\nЧастота обновления: 100 Гц (MCI)\r\nWi-Fi: Да\r\n', 10),
(80, 'LG 22LB491U', NULL, 'LG', 43, 5499, 'Диагональ экрана: 22"\r\nРазрешение: 1366x768\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2\r\nЧастота развертки панели: 50 Гц\r\nЧастота обновления: 100 Гц (MCI)\n\nWi-Fi: Да\r\n', 10),
(79, 'LG 32LB582V ', NULL, 'LG', 3, 9299, 'иагональ экрана: 32"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2\r\nЧастота развертки панели: 50 Гц\r\nЧастота обновления: 100 Гц (MCI)\r\nWi-Fi: Да\r\n', 10),
(78, 'LG 22LB491U', NULL, 'LG', 43, 5499, 'Диагональ экрана: 22"\r\nРазрешение: 1366x768\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2\r\nЧастота развертки панели: 50 Гц\r\nЧастота обновления: 100 Гц (MCI)\r\nWi-Fi: Да\r\n', 10),
(77, 'LG 32LB582V ', NULL, 'LG', 3, 9299, 'иагональ экрана: 32"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2\r\nЧастота развертки панели: 50 Гц\r\nЧастота обновления: 100 Гц (MCI)\r\nWi-Fi: Да\r\n', 10),
(76, 'Sony Alpha 6000 Kit 16-50mm Black', NULL, 'Sony', 7, 1749, 'Матрица 23.5 x 15.6 мм, 24.3 Мп / Объектив Sony E PZ 16-50 mm F3.5-5.6 OSS / поддержка карт памяти MS PRO Duo/MS PRO-HG Duo/MS XC-HG Duo/SD/SDHC/SDXC / наклонный ЖК-дисплей 3" / Full HD-видео / Wi-Fi / NFC / питание от литий-ионного аккумулятора / 120 x 75 x 66.9 мм, 460 г / черный\r\n', 9),
(75, 'Canon EOS 700D 18-55mm STM ', NULL, 'Canon', 4, 14799, 'атрица 22.3 x 14.9 мм, 18 Мп / объектив 18-55 IS STM / поддержка карт памяти SD/SDHC/SDXC / Сенсорный ЖК-экран с переменным углом наклона Clear View II TFT 3" / FullHD-видео / питание от литий-ионного аккумулятора / 133.1 x 99.8 x 154.0 мм, 785 г\r\n', 9),
(74, 'Sony Alpha 6000 Kit 16-50mm Black', NULL, 'Sony', 7, 1749, 'Матрица 23.5 x 15.6 мм, 24.3 Мп / Объектив Sony E PZ 16-50 mm F3.5-5.6 OSS / поддержка карт памяти MS PRO Duo/MS PRO-HG Duo/MS XC-HG Duo/SD/SDHC/SDXC / наклонный ЖК-дисплей 3" / Full HD-видео / Wi-Fi / NFC / питание от литий-ионного аккумулятора / 120 x 75 x 66.9 мм, 460 г / черный\r\n', 9),
(73, 'Canon EOS 700D 18-55mm STM ', NULL, 'Canon', 4, 14799, 'атрица 22.3 x 14.9 мм, 18 Мп / объектив 18-55 IS STM / поддержка карт памяти SD/SDHC/SDXC / Сенсорный ЖК-экран с переменным углом наклона Clear View II TFT 3" / FullHD-видео / питание от литий-ионного аккумулятора / 133.1 x 99.8 x 154.0 мм, 785 г\r\n', 9),
(72, 'Canon EOS 700D 18-55mm DC III ', NULL, 'Canon', 32, 11999, 'атрица 22.3 x 14.9 мм, 18 Мп / объектив 18-55DC III / поддержка карт памяти SD/SDHC/SDXC / Сенсорный ЖК-экран с переменным углом наклона Clear View II TFT 3" / FullHD-видео / питание от литий-ионного аккумулятора / 133.1 x 99.8 x 154.0 мм, 785 г\r\n', 9),
(71, 'Canon PowerShot SX400 IS Black \r\n', NULL, 'Canon', 43, 3699, 'Матрица 1/2.3", 16 Мп / Зум: 30х (оптический), 4х (цифровой) / поддержка карт памяти SD, SDHC, SDXC / LCD-дисплей 3" / HD-видео / питание от литий-ионнного аккумулятора / 104.4 x 69.1 x 80.1 мм, 313 г / черный', 9),
(70, 'Canon EOS 700D 18-55mm DC III ', NULL, 'Canon', 32, 11999, 'атрица 22.3 x 14.9 мм, 18 Мп / объектив 18-55DC III / поддержка карт памяти SD/SDHC/SDXC / Сенсорный ЖК-экран с переменным углом наклона Clear View II TFT 3" / FullHD-видео / питание от литий-ионного аккумулятора / 133.1 x 99.8 x 154.0 мм, 785 г\r\n', 9),
(69, 'Canon PowerShot SX400 IS Black \r\n', NULL, 'Canon', 43, 3699, 'Матрица 1/2.3", 16 Мп / Зум: 30х (оптический), 4х (цифровой) / поддержка карт памяти SD, SDHC, SDXC / LCD-дисплей 3" / HD-видео / питание от литий-ионнного аккумулятора / 104.4 x 69.1 x 80.1 мм, 313 г / черный', 9),
(68, 'tarCraft II: Heart of the Swarm (дополнение) (PC, Jewel, русская версия)', NULL, 'Blizzard', 34, 450, 'В Heart of the Swarm получает продолжение сюжетная линия StarCraft II: Wings of Liberty. Сара Керриган решила возродить Рой и отомстить Арктуру Менгску. На протяжении сюжетной кампании игрокам предстоит следовать за Керриган через всю галактику в поисках необычных разновидностей зергов, которые могут пополнить ее войско.', 8),
(67, 'StarCraft II: Wings of Liberty (PC, Jewel, русская версия)', NULL, 'Blizzard', 54, 445, 'Продолжение эпической научно-фантастической саги о трех могущественных расах — протоссах, терранах и зергах — им предстоит снова сойтись в бою.', 8),
(66, 'tarCraft II: Heart of the Swarm (дополнение) (PC, Jewel, русская версия)', NULL, 'Blizzard', 34, 450, 'В Heart of the Swarm получает продолжение сюжетная линия StarCraft II: Wings of Liberty. Сара Керриган решила возродить Рой и отомстить Арктуру Менгску. На протяжении сюжетной кампании игрокам предстоит следовать за Керриган через всю галактику в поисках необычных разновидностей зергов, которые могут пополнить ее войско.', 8),
(65, 'StarCraft II: Wings of Liberty (PC, Jewel, русская версия)', NULL, 'Blizzard', 54, 445, 'Продолжение эпической научно-фантастической саги о трех могущественных расах — протоссах, терранах и зергах — им предстоит снова сойтись в бою.', 8),
(64, 'The Elder Scrolls Online (PC, английская версия)\r\n', NULL, 'Valve', 43, 799, 'первые за свою двадцатилетнюю историю знаменитая фэнтезийная ролевая игра The Elder Scrolls выходит в онлайн. Отправляйтесь в грандиозное путешествие в одиночку или вместе с друзьями, собратьями по гильдиям и тысячами союзников. К вашим услугам богатства Тамриэля, тайны Морровинда, необъятные каменные джунгли Даггерфолла и многое другое. Впишите свое имя на скрижали истории и вступайте в грандиозные битвы между игроками, ведь в них решается судьба целого мира.', 8),
(63, 'World of Warcraft: Карта оплаты игрового времени (60 дней) (русская версия)\n\n', NULL, 'Blizzard', 4, 399, 'Карта оплаты игрового времени позволяет продлить время игры на 60 дней.\r\n', 8),
(61, 'World of Warcraft: Карта оплаты игрового времени (60 дней) (русская версия)\r\n', NULL, 'Blizzard', 4, 399, 'Карта оплаты игрового времени позволяет продлить время игры на 60 дней.\r\n', 8),
(62, 'The Elder Scrolls Online (PC, английская версия)\r\n', NULL, 'Valve', 43, 799, 'первые за свою двадцатилетнюю историю знаменитая фэнтезийная ролевая игра The Elder Scrolls выходит в онлайн. Отправляйтесь в грандиозное путешествие в одиночку или вместе с друзьями, собратьями по гильдиям и тысячами союзников. К вашим услугам богатства Тамриэля, тайны Морровинда, необъятные каменные джунгли Даггерфолла и многое другое. Впишите свое имя на скрижали истории и вступайте в грандиозные битвы между игроками, ведь в них решается судьба целого мира.', 8),
(60, 'World of Warcraft: Warlords of Draenor ', NULL, 'Blizzard', 3, 599, 'Идет эра старой Орды, закаленной железом, а не кровью демонов. Тяжелая поступь союза великих орочьих кланов и грохота ужасающих боевых машин сотрясает Дренор. Скоро падет Азерот. А за ним – тысячи других миров…\r\n', NULL),
(59, 'Heroes of the Storm (PC, Jewel, Русская версия)\r\n', NULL, 'Blizzard', 6, 459, 'Heroes of the Storm – потрясающе динамичная командная игра, в которой вы сможете встретить своих любимых персонажей из игр Blizzard. \r\nВыберите способности и облик героев и разработайте свою уникальную игровую тактику. Объединитесь с друзьями и примите участие в стремительных битвах.\r\nИ помните: от выбора поля боя будет напрямую зависеть стратегия и стиль игры!\r\n', 8),
(58, 'World of Warcraft: Warlords of Draenor ', NULL, 'Blizzard', 3, 599, 'Идет эра старой Орды, закаленной железом, а не кровью демонов. Тяжелая поступь союза великих орочьих кланов и грохота ужасающих боевых машин сотрясает Дренор. Скоро падет Азерот. А за ним – тысячи других миров…\r\n', NULL),
(55, 'Panasonic KX-TG2511UAM Metallic\r\n', NULL, 'Panasonic', 7, 769, 'Тип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный, голубая ', 7),
(56, 'Panasonic KX-TG2512UAT Titan', NULL, 'Panasonic', 5, 1199, 'Тип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный, голубая ', 7),
(57, 'Heroes of the Storm (PC, Jewel, Русская версия)\r\n', NULL, 'Blizzard', 6, 459, 'Heroes of the Storm – потрясающе динамичная командная игра, в которой вы сможете встретить своих любимых персонажей из игр Blizzard. \r\nВыберите способности и облик героев и разработайте свою уникальную игровую тактику. Объединитесь с друзьями и примите участие в стремительных битвах.\r\nИ помните: от выбора поля боя будет напрямую зависеть стратегия и стиль игры!\r\n', 8),
(54, 'Panasonic KX-TG2512UAT Titan', NULL, 'Panasonic', 5, 1199, 'Тип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный, голубая ', 7),
(51, 'Panasonic KX-TG6461UAT Titan', NULL, 'Panasonic', 6, 2099, 'ип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: 20 мин\r\nЖК-дисплей: Монохромный, с подсветкой\r\n', 7),
(52, 'Gigaset A120 Black', NULL, 'Gigaset', 65, 559, 'ип трубки: Беспроводной\r\nОпределение номера: Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный с оранжевой ', 7),
(53, 'Panasonic KX-TG2511UAM Metallic\r\n', NULL, 'Panasonic', 7, 769, 'Тип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный, голубая ', 7),
(49, 'Panasonic KX-TG6461UAT Titan', NULL, 'Panasonic', 6, 2099, 'ип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: 20 мин\r\nЖК-дисплей: Монохромный, с подсветкой\r\n', 7),
(50, 'Gigaset A120 Black', NULL, 'Gigaset', 65, 559, 'ип трубки: Беспроводной\r\nОпределение номера: Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный с оранжевой ', 7),
(48, 'Panasonic KX-TG2511UAT Titan', NULL, 'Panasonic', 65, 769, 'Тип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный, голубая подсветка\r\n', 7),
(46, 'Panasonic KX-TG2511UAT Titan', NULL, 'Panasonic', 65, 769, 'Тип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный, голубая подсветка\r\n', 7),
(47, 'Panasonic KX-TG1711UAB Black', NULL, 'Panasonic', 54, 699, 'ип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный с голубой подсветкой\r\n', 7),
(45, 'Panasonic KX-TG1711UAB Black', NULL, 'Panasonic', 54, 699, 'ип трубки: Беспроводной\r\nОпределение номера: АОН + Caller ID\r\nАвтоответчик: Нет\r\nЖК-дисплей: Монохромный с голубой подсветкой\r\n', 7),
(44, 'Microsoft Office для дома и бизнеса 2013 32/ 64 Russian \r\n', NULL, 'Microsoft', 43, 4839, 'В пакет входят следующие программы:\r\n\r\nMicrosoft Office Word 2013\r\nMicrosoft Office Excel 2013\r\nMicrosoft Office PowerPoint 2013\r\nMicrosoft Office Outlook 2013\r\nMicrosoft Office OneNote 2013\r\n\r\nОдна лицензия, допускается установка на 1 ПК.\r\n', 6),
(43, 'Microsoft Office 365 для дома 32/ 64 Russian Subscr 1YR Medialess BOX ', NULL, 'Microsoft', 56, 1399, '    Подписка 1 год\r\n·        5 пользователей х 3 устройства (PC/Mac+iPad+смартфон)\r\n·        Полный пакет программ Office\r\n·        1 ТБ хранилища OneDrive (каждый пользователь)\r\n·        60 мин. ежемесячных международных звонков Skype (1 пользователь)\r\nДля некоммерческого использования\r\n', 6),
(42, 'Microsoft Office для дома и бизнеса 2013 32/ 64 Russian \r\n', NULL, 'Microsoft', 43, 4839, 'В пакет входят следующие программы:\r\n\r\nMicrosoft Office Word 2013\r\nMicrosoft Office Excel 2013\r\nMicrosoft Office PowerPoint 2013\r\nMicrosoft Office Outlook 2013\r\nMicrosoft Office OneNote 2013\r\n\r\nОдна лицензия, допускается установка на 1 ПК.\r\n', 6),
(41, 'Microsoft Office 365 для дома 32/ 64 Russian Subscr 1YR Medialess BOX ', NULL, 'Microsoft', 56, 1399, '    Подписка 1 год\r\n·        5 пользователей х 3 устройства (PC/Mac+iPad+смартфон)\r\n·        Полный пакет программ Office\r\n·        1 ТБ хранилища OneDrive (каждый пользователь)\r\n·        60 мин. ежемесячных международных звонков Skype (1 пользователь)\r\nДля некоммерческого использования\r\n', 6),
(40, 'Microsoft Windows 7 Home Premium Russian VUP DVD Family Pack BOX\r\n', NULL, 'Microsoft', 5, 3625, 'нимание! Данная коробка включает только лицензии на ОБНОВЛЕНИЕ с Windows Vista/Windows XP до Windows 7. Продукт не предназначен для легализации ОС или установки на новый ПК !\r\nСпециальное предложение для всей семьи: три лицензии Windows 7 Домашняя расширенная по привлекательной цене\r\n', 6),
(39, 'Windows 7 SP1 Professional 64-bit Russian 1pk OEM DVD \r\n', NULL, 'Microsoft', 4, 3455, 'Windows 7 Professional позволяет устранить преграды на пути к успеху. Windows 7 Профессиональная обеспечивает запуск многих программ для Windows XP в режиме Windows XP и быстро восстанавливает данные с помощью автоматических архиваций в домашней или корпоративной сети.\r\n', 6),
(38, 'Microsoft Windows 7 Home Premium Russian VUP DVD Family Pack BOX\r\n', NULL, 'Microsoft', 5, 3625, 'нимание! Данная коробка включает только лицензии на ОБНОВЛЕНИЕ с Windows Vista/Windows XP до Windows 7. Продукт не предназначен для легализации ОС или установки на новый ПК !\r\nСпециальное предложение для всей семьи: три лицензии Windows 7 Домашняя расширенная по привлекательной цене\r\n', 6),
(37, 'Windows 7 SP1 Professional 64-bit Russian 1pk OEM DVD \r\n', NULL, 'Microsoft', 4, 3455, 'Windows 7 Professional позволяет устранить преграды на пути к успеху. Windows 7 Профессиональная обеспечивает запуск многих программ для Windows XP в режиме Windows XP и быстро восстанавливает данные с помощью автоматических архиваций в домашней или корпоративной сети.\r\n', 6),
(36, 'Windows LE 8.1 32-bit/64-bit All Lng PK Lic Online DwnLd NR\r\n', NULL, 'Microsoft', 3, 2699, 'Windows 8.1 — усовершенствованная и построенная на базе Windows 8. В центре внимания остаются приложения, они поддерживают новые способы взаимодействия с системой и дают пользователям более широкие возможности погружения в содержимое.\r\nПолная электронная лицензия ESD на 1 пользователя\r\n', 6),
(35, 'Windows 8.1 Professional 64-bit Russian 1 License 1pk OEM DVD \r\n', NULL, 'Microsoft', 5, 3529, 'Windows 8.1 Professional 64-bit Russian — усовершенствованная и построенная на базе Windows 8. В центре внимания остаются приложения, они поддерживают новые способы взаимодействия с системой и дают пользователям более широкие возможности погружения в содержимое.', 6),
(33, 'Windows 8.1 Professional 64-bit Russian 1 License 1pk OEM DVD \r\n', NULL, 'Microsoft', 5, 3529, 'Windows 8.1 Professional 64-bit Russian — усовершенствованная и построенная на базе Windows 8. В центре внимания остаются приложения, они поддерживают новые способы взаимодействия с системой и дают пользователям более широкие возможности погружения в содержимое.', 6),
(34, 'Windows LE 8.1 32-bit/64-bit All Lng PK Lic Online DwnLd NR\r\n', NULL, 'Microsoft', 3, 2699, 'Windows 8.1 — усовершенствованная и построенная на базе Windows 8. В центре внимания остаются приложения, они поддерживают новые способы взаимодействия с системой и дают пользователям более широкие возможности погружения в содержимое.\r\nПолная электронная лицензия ESD на 1 пользователя\r\n', 6),
(32, 'Sony HDR-AS200V', NULL, 'Sony', 8, 8999, 'Матрица (светочувствительный элемент): 1/2.3” (7.76 мм) матрица Exmor R CMOS с обратной засветкой Число пикселей: 8.8 Мп\r\nТип носителя: Flash память\r\nРазрешение видео: Full HD (1920x1080)\r\n', 5),
(30, 'Panasonic HC-V530EE', NULL, 'Panasonic', 4, 6799, 'Матрица (светочувствительный элемент): 1/5.8’’ MOП-матрица BSI\r\nОбщее количество пикселей: 2.51 Мп\r\nЭффективное число пикселей: 2.2 Мп [16:9]\r\nТип носителя: Flash память\r\nРазрешение видео: Full HD (1920x1080)\r\nЗум: Оптический зум: 50x\r\nИнтеллектуальный зум: 90x\r\nЦифровой зум: 150х / 3000x (максимальное значение увеличения)\r\n', 5),
(31, 'GoPro HERO3+ Silver Edition ', NULL, 'GoPro', 5, 8099, 'Матрица (светочувствительный элемент): 10 Мпикс, CMOS\r\nТип носителя: Flash память\r\nРазрешение видео: Full HD (1920x1080)\r\n', 5),
(29, 'GoPro HERO3+ Silver Edition ', NULL, 'GoPro', 5, 8099, 'Матрица (светочувствительный элемент): 10 Мпикс, CMOS\r\nТип носителя: Flash память\r\nРазрешение видео: Full HD (1920x1080)\r\n', 5),
(28, 'Panasonic HC-V530EE', NULL, 'Panasonic', 4, 6799, 'Матрица (светочувствительный элемент): 1/5.8’’ MOП-матрица BSI\r\nОбщее количество пикселей: 2.51 Мп\r\nЭффективное число пикселей: 2.2 Мп [16:9]\r\nТип носителя: Flash память\r\nРазрешение видео: Full HD (1920x1080)\r\nЗум: Оптический зум: 50x\r\nИнтеллектуальный зум: 90x\r\nЦифровой зум: 150х / 3000x (максимальное значение увеличения)\r\n', 5),
(27, 'Sony HDR-CX405B Black ', NULL, 'Sony', 6, 8999, 'Матрица (светочувствительный элемент): 1/5.8" (3.1 мм) Exmor R CMOS с обратной засветкой\r\nТип носителя: Flash память\r\nРазрешение видео: Full HD (1920x1080)\r\nЗум: Оптический - 30x\r\nЦифровой - 350x\r\n', 5),
(25, 'Sony HDR-CX405B Black ', NULL, 'Sony', 6, 8999, 'Матрица (светочувствительный элемент): 1/5.8" (3.1 мм) Exmor R CMOS с обратной засветкой\r\nТип носителя: Flash память\r\nРазрешение видео: Full HD (1920x1080)\r\nЗум: Оптический - 30x\r\nЦифровой - 350x\r\n', 5),
(26, 'GoPro HERO4 Black Standard Edition', NULL, 'GoPro', 11, 13699, 'Матрица (светочувствительный элемент): 12 Мп, CMOS\r\nТип носителя: Flash память\r\nРазрешение видео: 4K (3840x2160)\r\n', 5),
(23, 'Texet TB-166', NULL, 'Texet', 43, 3089, 'Диагональ дисплея: 6"\r\nРазрешение: 800х600\r\nТип матрицы: E Ink Pearl\r\nКоличество градаций серого: 16\r\nВстроенная память: 4 ГБ\r\nВес: 226 г\r\n', 4),
(24, 'GoPro HERO4 Black Standard Edition', NULL, 'GoPro', 11, 13699, 'Матрица (светочувствительный элемент): 12 Мп, CMOS\r\nТип носителя: Flash память\r\nРазрешение видео: 4K (3840x2160)\r\n', 5),
(22, 'PocketBook 640 Aqua ', NULL, 'PocketBook', 17, 2999, 'Диагональ дисплея: 6"\r\nРазрешение: 800х600\r\nТип матрицы: E Ink Pearl\r\nКоличество градаций серого: 16\r\nВстроенная память: 4 ГБ\r\nВес: 170 г\r\n', 4),
(21, 'PocketBook 624 Basic Touch Grey\r\n', NULL, 'PocketBook', 32, 3039, 'Диагональ дисплея: 6"\r\nРазрешение: 800х600\r\nТип матрицы: E Ink\r\nКоличество градаций серого: 16\r\nВстроенная память: 4 ГБ\r\nВес: 191 г\r\n', 4),
(19, 'PocketBook 624 Basic Touch Grey\r\n', NULL, 'PocketBook', 32, 3039, 'Диагональ дисплея: 6"\r\nРазрешение: 800х600\r\nТип матрицы: E Ink\r\nКоличество градаций серого: 16\r\nВстроенная память: 4 ГБ\r\nВес: 191 г\r\n', 4),
(20, 'PocketBook 626 Touch Lux2 White ', NULL, 'PocketBook', 123, 4179, 'иагональ дисплея: 6"\r\nРазрешение: 1024х758\r\nТип матрицы: E Ink Pearl\r\nКоличество градаций серого: 16\r\nВстроенная память: 4 ГБ\r\nВес: 208 г\r\n', 4),
(18, 'PocketBook 626 Touch Lux2 White ', NULL, 'PocketBook', 123, 4179, 'иагональ дисплея: 6"\r\nРазрешение: 1024х758\r\nТип матрицы: E Ink Pearl\r\nКоличество градаций серого: 16\r\nВстроенная память: 4 ГБ\r\nВес: 208 г\r\n', 4),
(16, 'Asus BM6820', NULL, 'Asus', 3, 7323, 'Intel Pentium Dual Core G2020 (2.9 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без OД / LAN / Без ОС\r\nПодробнее: ', 3),
(17, 'Acer Aspire TC-100 ', NULL, 'Acer', 7, 5950, 'AMD E1-2500 (1.4 ГГц) / RAM 4 ГБ / HDD 500 ГБ / AMD Radeon HD 8240 / DVD Super Multi / LAN / кардридер / DOS\r\n', 3),
(14, 'Персональный компьютер Lenovo ThinkStation E31\r\n', NULL, 'Lenovo', 4, 19624.9, 'Intel Xeon E3-1225V2 (3.2 ГГц) / 2 x RAM 2 ГБ / HDD 1 ТБ / LAN / DVD-RW / кард-ридер / Windows 7 Professional 64bit + клавиатура и мышь\r\n', 3),
(15, 'Asus BM1AD1-I54440047F (90PF00F1-M00470)', NULL, 'Asus', 6, 17605, 'ntel Core i5-4430S (2.7 - 3.2 ГГц) / RAM 4 ГБ / HDD 500 ГБ / Intel HD Graphics 4600 / DVD Super Multi / LAN / Windows 8.1 Pro / клавиатура + мышь\r\n', 3),
(13, 'Персональный компьютер Lenovo IdeaCentre H535', NULL, 'Lenovo', 5, 7326, 'AMD Trinity A8-5500 (3.2 - 3.7 ГГц) / RAM 4 ГБ / HDD 500 ГБ / AMD Radeon HD 7560D / DVD±RW / LAN / кардридер / DOS / клавиатура+ мышь\r\n', 3),
(11, 'Sony Xperia Z3 Tablet Compact 4G 16GB White\r\n', NULL, 'Sony', 12, 12471, 'Экран 8" IPS (1920x1200) емкостный Multi-Touch / Qualcomm Snapdragon MSM8974AB (2.5 ГГц) / RAM 3 ГБ / SSD 16 ГБ + поддержка карт памяти microSD / Wi-Fi / 3G / 4G LTE / Bluetooth 4.0 / NFC / пыле/влагозащищенный / камера основная 8.1 Мп, фронтальная - 2.2 Мп / GPS / ГЛОНАСС / ОС Android 4.4 (Kitkat) / 270 г / белый\r\n', 2),
(10, 'Apple A1475 iPad Air Wi-Fi 4G 16GB\r\n', NULL, 'Apple', 32, 12953, 'Экран 9.7" (2048 x 1536) Multi-Touch / Apple A7 (1.3 ГГц) / ОЗУ 1 ГБ / Флеш-память 16 ГБ / 3G / 4G / EV-DO / Wi-Fi / Bluetooth 4.0 / основная камера 5Мп, фронтальная 1.2 Мп / GPS / ОС iOS 7 / вес 478 г / серый\r\n', 2),
(9, 'Apple A1489 iPad mini with Retina display Wi-Fi', NULL, 'Apple', 12, 7123, 'Экран 7.9" (2048 x 1536) емкостной Multi-Touch / Apple A7 (1.3 ГГц) / ОЗУ 1 ГБ / Флеш-память 16 ГБ / Wi-Fi / Bluetooth 4.0 / основная камера 5 Мп, фронтальная - 1.2 Мп / ОС iOS 7.0 / вес 331 г / серебряный\r\n', 2),
(8, 'Asus MeMO Pad 7 16GB Black', NULL, 'Asus', 21, 4904, 'Экран 7" IPS (1920x1200) емкостный Multi-Touch / Intel Atom Z3560 (1.83 ГГц) / RAM 2 ГБ / 16 ГБ встроенной памяти + поддержка карт памяти microSD / Wi-Fi / Bluetooth 4.0 / основная камера 5 Мп, фронтальная - 2 Мп / GPS / ГЛОНАСС / Android 4.4 (KitKat) / 269 г / черный\r\n', 2),
(7, 'Asus Transformer Pad TF103C 16GB Doc Black ', NULL, 'Asus', 12, 4578, 'кран 10.1" (1280x800) емкостной Multi-Touch / Intel Atom Z3745 (1.33 ГГц) / RAM 1 ГБ / флеш память 16 ГБ + поддержка карт памяти MicroSD / Wi-Fi 802.11 a/b/g/n / Bluetooth 4.0 / основная камера 2 Мп + фронтальная 0.3 Мп / GPS + GLONASS / ОС Android 4.4 / 550 г / черный + док-станция (QWERTY-клавиатура, тачпад, USB 2.0)\r\n', 2),
(6, 'Apple MacBook Pro Retina 13" ', NULL, 'Apple MacBook Pro Retina 13" ', 21, 85531, 'Экран 13.3" IPS (2560x1600) Retina LED, глянцевый / Intel Core i7 (3.1 ГГц) / RAM 16 ГБ / SSD 1 TБ / Intel Iris Graphics 6100 / без ОД / Wi-Fi / Bluetooth / веб-камера / OS X Yosemite / 1.58 кг\r\nПодробнее: ', 1),
(5, 'Apple MacBook Air 13" ', NULL, 'Apple', 2, 26637, 'Экран 13.3" (1440x900) WXGA+ LED, глянцевый / Intel Core i5 (1.6 - 2.7 ГГц) / RAM 4 ГБ / SSD 128 ГБ / Intel HD Graphics 6000 / без ОД / Wi-Fi / Bluetooth / веб-камера / OS X Yosemite / 1.35 к', 1),
(3, 'Ноутбук Asus X553MA', NULL, 'Asus', 4, 6423, 'Экран 15.6" (1366x768) HD LED, глянцевый / Intel Celeron N2830 (2.16 ГГц) / RAM 4 ГБ / HDD 500 ГБ / Intel HD Graphics / DVD Super Multi / LAN / Bluetooth / Wi-Fi / веб-камера / DOS / 2.2 кг / черный\r\nПодробнее: ', 1),
(4, 'MSI GT80 2QE Titan SLI', NULL, 'MSI', 5, 123436, 'Экран 17.3" (1920x1080) Full HD LED, матовый / Intel Core i7- 5950HQ (2.9 - 3.8 ГГц) / RAM 32 ГБ / SSD 512 ГБ + HDD 1 ТБ / 2 x nVidia GeForce GTX 980M, 8 ГБ / Blu-Ray / LAN / Wi-Fi / Bluetooth / веб-камера / Windows 8.1 Single Language Rus 64bit / 4.5 кг / черный / PowerPack\r\nПодробнее: http://rozetka.com.ua/notebooks/msi/c80004/v109/', 1),
(2, 'Ноутбук HP 255 G3 ', NULL, 'HP', 3, 5245, 'Экран 15.6” (1366x768) HD LED, матовый / AMD Dual-Core E1-6010 (1.35 ГГц) / RAM 4 ГБ / HDD 500 ГБ / AMD Radeon R2 / без ОД / LAN / Bluetooth / Wi-Fi / веб-камера / Windows 8.1 64bit / 2.15 кг / черный', 1),
(1, 'Ноутбук Lenovo Flex 2 15', '/images/products/notebook/record_188211087.jpg', 'Lenovo', 10, 17342.5, 'Экран 15.6" (1920x1080) Full HD LED, глянцевый IPS Multi-Touch / Intel Core i3-4030U (1.9 ГГц) / RAM 4 ГБ / HDD 1 ТБ / nVidia GeForce 820M, 2 ГБ / DVD Super Multi / Wi-Fi / Bluetooth 4.0 / веб-камера / Windows 8.1 / 2.3 кг / черный\r\nПодробнее: ', 1),
(83, 'LG 42LB582V', NULL, 'LG', 5, 12499, 'Диагональ экрана: 42"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2, DVB-T\r\nЧастота развертки панели: 50 Гц\r\nЧастота обновления: 100 Гц (MCI)\r\nWi-Fi: Да\r\n', 10),
(84, 'LG 47LB720V ', NULL, 'LG', 9, 20499, 'Диагональ экрана: 47"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2\r\nЧастота развертки панели: 200 Гц\r\nЧастота обновления: 800 Гц (MCI)\r\nWi-Fi: Да\r\n', 10),
(85, 'Samsung UE40J5590 + KinoTV D', NULL, 'Samsung', 5, 14999, 'Диагональ экрана: 40"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2\r\nЧастота обновления: 100 Гц (CMR)\r\nWi-Fi: Да\r\n', 10),
(86, 'Samsung UE48H5500 + Жесткий диск Transcend 1TB в подарок!\r\n', NULL, 'Samsung', 4, 16899, 'Диагональ экрана: 48"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-C, DVB-T2\r\nЧастота развертки панели: 50 Гц\r\nЧастота обновления: 100 Гц (CMR)\r\nWi-Fi: Да\r\n', 10),
(87, 'Samsung UE40J5590 + KinoTV D', NULL, 'Samsung', 5, 14999, 'Диагональ экрана: 40"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-S2, DVB-C, DVB-T2\r\nЧастота обновления: 100 Гц (CMR)\r\nWi-Fi: Да\r\n', 10),
(88, 'Samsung UE48H5500 + Жесткий диск Transcend 1TB в подарок!\r\n', NULL, 'Samsung', 4, 16899, 'Диагональ экрана: 48"\r\nРазрешение: 1920x1080\r\nПоддержка Smart TV: Есть\r\nДиапазоны цифрового тюнера: DVB-C, DVB-T2\r\nЧастота развертки панели: 50 Гц\r\nЧастота обновления: 100 Гц (CMR)\r\nWi-Fi: Да\r\n', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` enum('1','0') NOT NULL,
  `role` enum('0','1','2') NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_update` date DEFAULT NULL,
  `user_hash` varchar(32) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `birthday`, `email`, `password`, `is_active`, `role`, `reg_date`, `last_update`, `user_hash`) VALUES
(2, 'Николай', 'Криворучко', '1987-01-03', 'krivoruchko@gmail.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '2', '2015-10-14 16:03:33', '2015-08-19', '816f713961cf0ea563ea6d4188b03536'),
(3, 'Ирина', 'Криворучко', '2000-03-11', 'irina-krivorucko', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(4, 'Ирма', 'Киркорова', '1993-05-18', 'irma-kirkorova@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(5, 'Евгений', 'Анегин', '1920-04-18', 'eugen-anegin', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(6, 'Георигий ', 'Жуков', '2001-08-26', 'georgiy-djukov', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(7, 'Барака', 'Обама', '1945-09-11', 'baraka-obama@icloud.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(8, 'Владимир', 'Путин', '1950-03-12', 'vladimir-putin@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(9, 'Джейд', 'Псаки', '1982-08-04', 'djeid-psaki@icloud.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(10, 'Дмитрий', 'Медведев', '1970-03-12', 'dmitriy-medvedev@yandex.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(11, 'Николай', 'Валуев', '1975-08-12', 'nikolay-valuev@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(12, 'Владимир', 'Жириновкий', '1950-08-04', 'vladimir-jirinovskiy@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(13, 'Борис', 'Ельцин', '1942-08-18', 'boris-elicin@icloud.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(14, 'Алексей', 'Дурнев', '1980-08-31', 'alex-durnev', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(15, 'Даша', 'Ши', '1980-08-10', 'dasha-shi@gmail.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-12', ''),
(16, 'Иван', 'Петров', '2000-08-10', 'ivan-petrov.gmail.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(17, 'Виктор', 'Шнур', '1965-08-18', 'victor-shnur@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(18, 'Артас', 'Менитил', '1795-08-18', 'artas-menitil@gmail.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(19, 'Адольф', 'Гитлер', '1920-08-18', 'adolf-gitler@icloud.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(20, 'Иван', 'Дорн', '1981-08-10', 'ivan-dorn@gmail.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(21, 'Макс', 'Барских', '1976-08-11', 'max-barskiy@yandex.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-18', ''),
(22, 'Ольга', 'Полякова', '1975-08-17', 'olga-polyakova@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(23, 'Кристиан', 'Рональдо', '1985-08-03', 'kristian-ronaldo', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-25', ''),
(24, 'Владимир', 'Кличко', '1976-07-21', 'vladimir-klichko@gmail.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(25, 'Арсений', 'Яцунюк', '1969-07-13', 'arseniy-yacenuk@gmai.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-26', ''),
(26, 'Виталий ', 'Кличко', '1975-08-18', 'vitaliy-klichko@gmail.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-26', ''),
(27, 'Алла', 'Пугачева', '1950-08-10', 'alla-pugacheva@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-26', ''),
(28, 'Сергей', 'Безруков', '1976-08-18', 'sergey-bezrukov@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(29, 'Джодж', 'Буш', '1962-05-12', 'joege-bush@icloud.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-26', ''),
(30, 'Сергей', 'Зверев', '1985-08-10', 'sergey-zverev@yandex.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-02 09:29:05', '2015-08-19', ''),
(40, 'Евгений', 'Васильцов', '1990-02-11', 'eugenevasilsov@gmail.com', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '2', '2015-10-18 18:10:07', NULL, '9c552c1d091162eb77045c1eb44cae70'),
(41, 'Екатерина', 'Вторая', '1985-10-02', 'ekaterina-vtoraya@mail.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-18 16:20:24', NULL, 'ceb37c6d154751fc754e30a69833e7c1'),
(43, 'admin', 'adminov', '1985-10-14', 'admin@bk.ru', 'fb47fde2fbd4931d05aa33dd9b21831c', '1', '2', '2015-10-12 13:53:05', NULL, 'eb18b002c1041f5c5108d00f30bde7d1'),
(44, 'Евгений', 'Гвардий', '1990-12-08', 'jehe4ka@bk.ru', '224cf2b695a5e8ecaecfb9015161fa4b', '1', '0', '2015-10-18 18:09:36', NULL, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_products`
--
ALTER TABLE `category_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_catalog` (`id_catalog`),
  ADD KEY `price` (`price`),
  ADD FULLTEXT KEY `mark` (`mark`);
ALTER TABLE `products`
  ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `products`
  ADD FULLTEXT KEY `description` (`description`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category_products`
--
ALTER TABLE `category_products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=83;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
