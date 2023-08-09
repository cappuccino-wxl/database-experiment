-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3316
-- 生成日期： 2022-12-11 14:57:14
-- 服务器版本： 10.4.24-MariaDB
-- PHP 版本： 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `leasing_luxury`
--

DELIMITER $$
--
-- 存储过程
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_bags` (IN `bags_id` INT(11), IN `bag_name` VARCHAR(15), IN `color` VARCHAR(15), IN `manufacturer` VARCHAR(15), IN `price` FLOAT, IN `num_` INT)   begin
    DECLARE num INT;
    select count(*) into num from bags where bag_id = bags_id;
    if num = 0 then
        insert into bags
        (bag_id, names, Color, Manufacturer, Price, nums)
        values
        (bags_id, bag_name, color, manufacturer, price, num_);
    else 
        update bags set nums = nums +num_ where bag_id = bags_id;
    end if;
    
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_customer` (IN `customer_id_` INT(11), IN `first_name_` VARCHAR(15), IN `last_name_` VARCHAR(15), IN `phone_` VARCHAR(15), IN `creditID_` VARCHAR(15), IN `emailAdd_` VARCHAR(15), IN `regularAdd_` VARCHAR(15))   begin
    insert into customer
    (customer_id, first_name, last_name, phone, creditID, emailAdd, regularAdd)
    values
    (customer_id_, first_name_, last_name_, phone_, creditID_, emailAdd_, regularAdd_);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_rentals` (IN `customer_id` VARCHAR(15), IN `date_rented` DATETIME, IN `date_returned` DATETIME, IN `insurance` TINYINT(1), IN `bags_id` INT(11))   begin
    insert into rentals
    (customer_id, DateRent, DateReturn, Insurance, bag_id)
    values
    (customer_id, current_timestamp, date_returned, insurance, bags_id);
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bags_avaliable` ()   begin
   select * from bags where nums > 0;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `bags_for_manufactor` (IN `name` VARCHAR(15))   begin
    select names, Color, Manufacturer
    from bags
    where Manufacturer = name;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `best_customer` ()   begin
    select 
    last_name as Last_name, 
    first_name as Frist_name,
    regularAdd as Address, 
    phone as Telephone,
    sum(TIMESTAMPDIFF(DAY,DateRent,DateReturn)) as Total_Length_of_Rentals
    from customer C,rentals T
    where C.customer_id = T.customer_id
    group by Last_name, First_name
    order by Total_Length_of_Rentals desc;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `record_by_customerID` (IN `cus_id` INT(11))   begin
   select 
   C.customer_id,
   B.bag_id,
   B.names as Name,
   Color,
   Manufacturer,
   Insurance,
   Price, 
   R.DateRent,
   R.DateReturn
   from bags B, customer C, rentals R
   where C.customer_id = cus_id
   and R.customer_id = C.customer_id 
   and B.bag_id = R.bag_id
   and R.bag_state = 'rent';
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `rent2down` ()   begin
    
    declare id int;
    declare cus_id int;
    declare DRent datetime;
    declare DReturn datetime;
    declare Insura tinyint(1);

    select 
    bag_id, customer_id, DateRent, Insurance
    into 
    id, cus_id, DRent, Insura
    from rentals
    where bag_state = 'return'
    order by rentals_id desc limit 1;

    
    update rentals
    set bag_state = 'down'
    where bag_id = id 
    and customer_id = cus_id
    and DateRent = DRent
    and Insurance = Insura
    and bag_state = 'rent';
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `report_customer_amount` (IN `customer_id` VARCHAR(15))   begin
    (select
    last_name as Last_Name,
    first_name as First_Name,
    null as Manufacturer,
    null as Name,
    null as Cost
    from customer C, bags B, rentals T
    where C.customer_id = T.customer_id
    and T.bag_id = B.bag_id
    and C.customer_id = customer_id
    group by First_Name) 

    union 

    (select 
    null,null,
    Manufacturer,
    B.names as Name,
    TIMESTAMPDIFF(DAY,DateRent,DateReturn)*(B.Price) as Cost
    from customer C, bags B, rentals T
    where C.customer_id = T.customer_id
    and T.bag_id = B.bag_id
    and C.customer_id = customer_id
    order by Cost desc limit 1000000) 

    union 

    (select null,null,null,null,
    sum(TIMESTAMPDIFF(DAY,DateRent,DateReturn)*(B.Price))
    from customer C, bags B, rentals T
    where C.customer_id = T.customer_id
    and T.bag_id = B.bag_id
    and C.customer_id = customer_id) ;

end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_bags` ()   begin
    select * from bags;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_customer` ()   begin
    select * from customer;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `show_rentals` ()   begin
    select * from rentals;
end$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `bags`
--

CREATE TABLE `bags` (
  `bag_id` int(11) NOT NULL,
  `names` varchar(15) DEFAULT NULL,
  `Color` varchar(15) DEFAULT NULL,
  `Manufacturer` varchar(15) DEFAULT NULL,
  `Price` float NOT NULL,
  `nums` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `bags`
--

INSERT INTO `bags` (`bag_id`, `names`, `Color`, `Manufacturer`, `Price`, `nums`) VALUES
(101, 'Claudia', 'White', 'Louis Vuitton', 8.75, 0),
(102, 'Cabas Piano', 'Multi', 'Louis Vuitton', 8.75, 0),
(103, 'Monogram Pochet', 'Multi', 'Louis Vuitton', 8.75, 0),
(104, 'Satchel', 'Camel', 'Coach', 9, 1),
(105, 'Hippie Flap', 'Green', 'Coach', 9, 2),
(106, 'Bleeker Bucket', 'Blue', 'Coach', 9, 1),
(107, 'Messenger', 'Black', 'Prada', 9.5, 1),
(108, 'Fairy', 'Multi', 'Prada', 9.5, 1),
(109, 'Glove Soft Pebb', 'Mauve', 'Prada', 9.5, 1),
(110, 'Haymarket Woven', 'Gold', 'Burberry', 10, 1),
(111, 'Knight', 'Plaid', 'Burberry', 10, 1);

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(15) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `creditID` varchar(15) DEFAULT NULL,
  `emailAdd` varchar(15) DEFAULT NULL,
  `regularAdd` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`customer_id`, `first_name`, `last_name`, `phone`, `creditID`, `emailAdd`, `regularAdd`) VALUES
(1, 'hewen', 'deng', '135-378-49578', '000000000000', '1348478403@qq.c', 'shenzhen'),
(2, 'Annabelle', 'Murray', '404-998-3928', '443355463212', 'belle@comcast.n', '59 W. Central A'),
(3, 'Gina', 'Franco', '404-887-2342', '443398764532', 'gf59@gmail.com', '1012 Peachtree '),
(4, 'Sally', 'Quinn', '404-987-3427', '443398765439', 'quinn45@gmail.c', '54 Oak Ave'),
(5, 'Joan', 'Zern', '404-675-0091', '443357643254', 'zern@comcast.ne', '58 W. Central A'),
(6, 'Maria', 'Lopato', '404-234-8876', '443352635423', 'mrl@hotmail.com', '5490 West 5th'),
(7, 'Patricia', 'Smith', '404-765-3342', '443398762534', 'patti1@gmail.co', '1700 E. Lincoln'),
(8, 'Jill', 'Pao', '404-887-9238', '443367256543', 'pao@comcast.net', '89 Orchard'),
(9, 'Anna', 'Berry', '404-887-4673', '443376562837', 'aberry@hotmail.', '9 Pleasant Way'),
(21, 'wang', 'xiaoli', '1234', '445281', '1740284993@qq.c', 'shenzhen'),
(666, 'wang', 'xiaoLi', '7788', '5566', '1740284993@qq.c', 'shanghai'),
(152051, 'Wang', 'XiaoLi', '17875965969', '666666', '1740284993@qq.c', 'guangzhou');

-- --------------------------------------------------------

--
-- 表的结构 `rentals`
--

CREATE TABLE `rentals` (
  `rentals_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `DateRent` date NOT NULL,
  `DateReturn` date DEFAULT NULL,
  `Insurance` tinyint(1) DEFAULT NULL,
  `bag_id` int(11) NOT NULL,
  `bag_state` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `rentals`
--

INSERT INTO `rentals` (`rentals_id`, `customer_id`, `DateRent`, `DateReturn`, `Insurance`, `bag_id`, `bag_state`) VALUES
(1, 2, '2011-04-12', '2011-04-30', 1, 101, 'down'),
(2, 2, '2011-01-19', '2011-02-01', 1, 107, 'rent'),
(3, 3, '2011-02-11', '2011-02-19', 1, 102, 'down'),
(4, 3, '2011-03-09', '2011-03-11', 1, 104, 'down'),
(5, 3, '2011-05-21', '2011-05-25', 1, 105, 'down'),
(6, 4, '2011-03-16', '2011-03-17', 0, 110, 'rent'),
(7, 6, '2011-05-18', '2011-05-25', 0, 106, 'rent'),
(8, 5, '2011-01-01', '2011-02-01', 1, 108, 'rent'),
(9, 5, '2011-06-02', '2011-06-08', 1, 101, 'rent'),
(10, 5, '2011-05-06', '2011-05-09', 1, 103, 'rent'),
(11, 7, '2011-06-02', '2011-06-30', 0, 109, 'rent'),
(12, 8, '2011-02-19', '2011-03-01', 1, 111, 'rent'),
(13, 8, '2011-03-30', '2011-04-02', 1, 111, 'rent'),
(14, 9, '2011-03-05', '2011-03-09', 0, 101, 'rent'),
(15, 9, '2011-04-01', '2011-04-21', 0, 103, 'rent'),
(16, 9, '2011-05-05', '2011-05-09', 0, 106, 'rent'),
(17, 3, '2011-02-11', '2022-12-11', 1, 102, 'return'),
(18, 3, '2022-12-11', '2022-12-04', 1, 101, 'rent'),
(19, 2, '2011-04-12', '2022-12-11', 1, 101, 'return'),
(20, 3, '2022-12-11', '2022-12-04', 1, 101, 'rent'),
(21, 3, '2022-12-11', '2022-12-04', 1, 102, 'rent'),
(22, 3, '2022-12-11', '2022-12-04', 1, 102, 'rent'),
(23, 3, '2011-03-09', '2022-12-11', 1, 104, 'return'),
(24, 3, '2011-05-21', '2022-12-11', 1, 105, 'return'),
(25, 3, '2022-12-11', '2022-12-04', 1, 103, 'rent'),
(26, 4, '2022-12-11', '2022-12-14', 0, 104, 'down'),
(27, 3, '2022-12-11', '2022-12-14', 0, 104, 'rent'),
(28, 4, '2022-12-11', '2022-12-11', 0, 104, 'return');

--
-- 触发器 `rentals`
--
DELIMITER $$
CREATE TRIGGER `trigger_return` AFTER INSERT ON `rentals` FOR EACH ROW begin
    
    declare types varchar(15);
    
    declare id int;

    select bag_id, bag_state 
    into id, types
    from rentals
    order by rentals_id desc limit 1;
    
    if types = 'rent' then
        update bags
        set nums = nums - 1
        where bag_id = id;
    else 
        update bags
        set nums = nums + 1
        where bag_id = id;
    end if;
    
end
$$
DELIMITER ;

--
-- 转储表的索引
--

--
-- 表的索引 `bags`
--
ALTER TABLE `bags`
  ADD PRIMARY KEY (`bag_id`);

--
-- 表的索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `creditID` (`creditID`);

--
-- 表的索引 `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rentals_id`,`customer_id`,`DateRent`,`bag_id`),
  ADD UNIQUE KEY `rentals_id` (`rentals_id`,`customer_id`,`DateRent`,`bag_id`),
  ADD KEY `bag_id` (`bag_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152052;

--
-- 使用表AUTO_INCREMENT `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rentals_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- 限制导出的表
--

--
-- 限制表 `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`bag_id`) REFERENCES `bags` (`bag_id`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
