-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2017 at 06:44 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kpshah_master`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `ac_id` int(11) NOT NULL,
  `ac_name` varchar(100) NOT NULL,
  `prifix` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`ac_id`, `ac_name`, `prifix`) VALUES
(1, 'Bank Account', 'BD'),
(2, 'Bank O/D Account', 'BC'),
(3, 'Branch/ Division', ''),
(4, 'Capital Account', 'BC'),
(5, 'Cash in Hand', 'BD'),
(6, 'Current Assets', 'BD'),
(7, 'Current Liabilities', 'BC'),
(8, 'Deposits [Assets]', 'BD'),
(9, 'Direct Expenses', 'TD'),
(10, 'Direct Income', 'TC'),
(11, 'Duties And Tax', 'BC'),
(12, 'Fixed Assets', 'BD'),
(13, 'Indirect Expenses', 'PD'),
(14, 'Indirect Income', 'PC'),
(15, 'Investments', 'BD'),
(16, 'Loan And Advanced [Assets]', 'BD'),
(17, 'Loan [Liabilities]', 'BC'),
(18, 'Misc. Expenses', 'PD'),
(19, 'Net Loss', 'BD'),
(20, 'Net Profit', 'BC'),
(21, 'Deposits[Liabilities]', 'BC'),
(22, 'Provissions', 'BC'),
(23, 'Purchase Account', 'TD'),
(24, 'Reserve And Surplus', 'BC'),
(25, 'Sales Account', 'TC'),
(26, 'Secured Loan', 'BC'),
(27, 'Stock in Hand', 'BD'),
(28, 'Sundry Creditors', 'BC'),
(29, 'Sundry Debtors', 'BD'),
(30, 'Unsecured Loan', 'BC'),
(31, 'A/c Holders Name', '');

-- --------------------------------------------------------

--
-- Table structure for table `catagory_master`
--

CREATE TABLE `catagory_master` (
  `catagory_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `catagory_master`
--

INSERT INTO `catagory_master` (`catagory_id`, `name`) VALUES
(16, 'Computer'),
(17, 'Electronic'),
(18, 'Civil'),
(21, 'natural'),
(22, 'mobile');

-- --------------------------------------------------------

--
-- Table structure for table `client_master`
--

CREATE TABLE `client_master` (
  `client_id` int(11) NOT NULL,
  `client_name` varchar(250) NOT NULL,
  `client_contact_no` bigint(15) NOT NULL,
  `client_ac_type` varchar(250) NOT NULL,
  `client_email` varchar(250) NOT NULL,
  `client_tin` varchar(250) NOT NULL,
  `client_cst` varchar(250) NOT NULL,
  `gst` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `client_address` varchar(250) NOT NULL,
  `client_series` varchar(15) NOT NULL,
  `client_prefix` varchar(100) NOT NULL,
  `client_openingbal` varchar(250) NOT NULL,
  `client_opening_type` varchar(250) NOT NULL,
  `client_termday` int(5) NOT NULL,
  `client_created_by` varchar(250) NOT NULL,
  `flag` int(1) NOT NULL,
  `dflag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client_master`
--

INSERT INTO `client_master` (`client_id`, `client_name`, `client_contact_no`, `client_ac_type`, `client_email`, `client_tin`, `client_cst`, `gst`, `state`, `client_address`, `client_series`, `client_prefix`, `client_openingbal`, `client_opening_type`, `client_termday`, `client_created_by`, `flag`, `dflag`) VALUES
(1, 'Cash Account', 0, '5', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(2, 'Purchase Account', 0, '23', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(3, 'Sales Account', 0, '25', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(4, 'FREIGHT', 0, '9', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(5, 'CGST TAX', 0, '11', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(6, 'SGST TAX ', 0, '11', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(7, 'IGST TAX ', 0, '11', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(8, 'S.T. TAX ', 0, '11', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(9, 'G.S.T TAX', 0, '11', '', '', '', '', '', '', '0', '', '', 'None', 0, 'admi', 1, 0),
(10, 'tysu infotech', 1234567890, '28', 'lkvljvjxlckjv@ldfkjld.com', '123465', '4568889', '', '01', 'vastrapur,\r\nahmedabad', '0', '', '1000', 'Credit', 100, 'admi', 0, 0),
(11, 'Tcs pvt. Ltd', 9687524125, '28', 'tcs12345@gmail.com', '129091811', '771892821', '', '', '12/platinumplazza, banglore', '5', '', '2000000', 'Credit', 30, 'admi', 0, 0),
(12, 'Wipro Pvt Ltd.', 9741265123, '29', 'wipro@gmail.com', '963258', '741258', '', '', '87/swstik complax', '6', '', '5000000', 'Debit', 2, 'admi', 0, 0),
(13, 'jain industriesjain industriesjain industries', 7896124589, '28', 'jain@gmail.com', '12321245', '98743589', '1235464', '20', '12/swing industries\r\n12/swing industries\r\n12/swing industries\r\n12/swing industries\r\n12/swing industries', '6', '', '1000000', 'Credit', 30, 'admi', 0, 0),
(14, 'kava pvt.Ltd', 7865912364, '29', 'kava@gmail.com', '789654123', '125478', '2315648asd', '30', '123,swing it soltution', '0', '', '2000000', 'Debit', 1, 'admi', 0, 0),
(15, 'Kapil', 7383957073, '10', 'dadad@gmi.com', '564564', '46548', '12345678988', '24', 'sfsdff', '9', '', '456', 'Debit', 4564, 'admi', 0, 0),
(16, 'HDFC Bank ', 4567891230, '1', 'hdfc@gmail.com', '456789255', '046546557', '', '', 'hello', '0', '', '10000', 'Debit', 123, 'admi', 0, 0),
(17, 'ICICI Bank ', 56988789894, '1', 'icici@gmail.com', '5555', '456', '', '', '566565', '0', '', '', 'None', 0, 'admi', 0, 0),
(18, 'New infotech', 5559998885, '28', 'new@gmail.com', '79856', '4546465', '', '', 'new exprss.,', '0', '', '50000', 'Credit', 50, 'admi', 0, 0),
(19, 'Maulik', 45655, '28', 'new@gmail.com', '546898', '5645248', '', '', 'adasdad', '7', '', '1235', 'Credit', 12, 'admi', 0, 0),
(20, 'Kishan', 456879, '28', '', '', '', '', '24', '', '0', '', '', 'None', 0, 'admi', 0, 0),
(23, 'Harsh ', 9898985566, '28', 'harsh@gmail.com', '45646465464', '45662321', '456789555aa', '24', 'vastrapur,', '0', '', '1000', 'None', 10, 'admi', 0, 0),
(25, 'abc', 9898998989, '29', 'abc@gmail.com', '', '', '123456789123', '24', 'ggh', '0', '', '', 'None', 0, 'admi', 0, 0),
(26, 'Mehul KAva', 9898375981, '28', 'mehul@gmail.com', '', '', '456888999Tryer', '30', 'Junagadh,\r\nGujarat,\r\nIndia.', '9', '', '1000', 'None', 15, 'admi', 0, 0),
(27, 'Ayush Kava', 9898885588, '28', 'ayush2081@gmail.com', '', '', '7899955566622hh', '24', 'd , block fack street new road,\r\nhighway to road in the city\r\njunagadh,  \r\nvanthali', '9', '', '', 'None', 15, 'admi', 0, 0),
(28, 'as d', 8980844444, '29', 'mehul@gmail.com', '', '', '', '12', 'asasasas', '', '', '', 'None', 0, 'admi', 0, 0),
(29, 'Nnew', 9898989556, '9', 'as@gmail.com', '', '', '', '24', 'sdasdadas', '5', '', '', 'None', 0, 'Super Admin', 0, 0),
(30, 'aadss', 9878988888, '28', 'as@gmail.com', '', '', '', '20', '9878988888', '0', '', '', 'None', 0, 'Super Admin', 0, 0),
(31, 'Nnewas', 9898989556, '11', 'as@gmail.com', '', '', '', '01', '9878988888', '0', '', '', 'None', 0, 'Super Admin', 0, 0),
(32, 'aadssfgh', 9898989556, '16', 'as@gmail.com', '', '', '', '06', '9878988888', '0', '', '', 'None', 0, 'Super Admin', 0, 0),
(33, 'aadssytu', 9898989556, '22', 'as@gmail.com', '', '', '', '01', '9878988888', '0', '', '', 'None', 0, 'Super Admin', 0, 0),
(34, 'new', 9898987899, '4', 'mehul@gm.com', '', '', '4564646464', '35', '', '0', '', '', 'None', 0, 'Super Admin', 0, 0),
(35, 'Tysu infotech', 9898989898, '29', 'tysu@gmail.com', '', '', '24684asdggasd', '24', '223,Vasrapur', '', '', 'Tax Invoice', 'Credit', 30, '', 0, 0),
(36, 'Tysu infotech', 9898989898, '29', 'tysu@gmail.com', '', '', '24684asdggasd', '24', '223,Vasrapur', '', '', '', 'Credit', 30, '', 0, 0),
(37, 'Tysu infotech', 9898989898, '29', 'tysu@gmail.com', '', '', '24684asdggasd', '24', '223,Vasrapur', '5', '', '10000', 'Credit', 30, '', 0, 0),
(38, 'Tysu infotech', 9898989898, '29', 'tysu@gmail.com', '', '', '24684asdggasd', '24', '223,Vasrapur', '5', '', '10000', 'Credit', 30, '', 0, 0),
(39, 'ALSTROM INTERNATIONAL PVT.LTD.', 9428002288, '28', '', '240 7450 3746 ', '245 7450 3746', '', '24', '9, MAHARAJA ESTATE , NR. KARNAVATI ESTATE, B/H ANAND HOTEL SARKHEJ SANAND ROAD,SARKHEJ', '5', '', '', '', 30, '', 0, 0),
(40, 'ALSTROM INTERNATIONAL PVT.LTD.', 9428002288, '28', '', '240 7450 3746 ', '245 7450 3746', '', '24', '9, MAHARAJA ESTATE , NR. KARNAVATI ESTATE, B/H ANAND HOTEL SARKHEJ SANAND ROAD,SARKHEJ', '5', '', '', '', 30, '', 0, 0),
(41, 'ALUDECOR LAMINATION PVT LTD', 9327532822, '28', 'accountsahmedabad@aludecor.com', '240 7460 1770 ', '245 7460 1770', '', '24', 'C/510, 5TH FLOOR, DEV AURAM,OPP. COMMERCE HOUSE,ANAND NAGAR ROAD,PRAHLAD NAGAR,AHMEDABAD 380054', '5', '', '', 'Credit', 30, '', 0, 0),
(42, 'AUM INFRASTRUCTURE', 9825098826, '29', '', '240 7360 6985 ', '', '', '24', 'SATELITE', '5', '', '', 'Debit', 30, '', 0, 0),
(43, 'ASN ENTERPRISE', 9825098826, '29', '', '240 7420 2802', '', '', '24', '43/B,ADHVAIT SOC.RADHASWAMI ROAD, RANIP,AHMEDABAD-382480', '5', '', '', 'Debit', 30, '', 0, 0),
(44, 'ALUSTAR MARKETING PVT LTD', 9825973339, '28', '', '24074503416', '24574503416', '', '24', 'C - 1/2, KARNAVATI ESTATE,SANAND ROAD,', '5', '', '', '    ', 30, '', 0, 0),
(45, 'AARTI ENGINEERING & SERVICES', 0, '28', '', '24072300020', '', '', '24', 'VATVA', '5', '', '', '', 0, '', 0, 0),
(46, 'ACP TRADING CORPORATION', 0, '28', '', '24074503814', '', '', '24', 'SARKHEJ', '5', '', '', '', 0, '', 0, 0),
(47, 'ARVIND MULTITECH', 0, '29', '', '', '', '', '24', 'SOLA, AHMEDABAD', '4', '', '', '', 0, '', 0, 0),
(48, 'ALPHA ENTERPRISE', 9825153259, '29', '', '242 2050 0327', '247 2050 0327', '', '24', '506 - NATIONAL PLAZA COMPLEX, OPP. RAILWAY STATION, NR.AYURVEDIC HOSPITAL', '5', '', '', '', 0, '', 0, 0),
(49, 'AGICON BARODA', 8238058825, '29', 'agicon.baroda@gmail.com', '24190307127', '', '', '24', 'FF-14,TOWER-B,SUNDERWAN COMPLEX,NR.GORWA ITI,B/S - IOC PETROL PUMP,GORWA,VADODARA', '5', '', '', '', 0, '', 0, 0),
(50, 'AMBALIA CONSTRUCTION', 0, '29', '', '', '24140101165', '', '24', 'PLOT NO 173,MOTI TALAV V.I.P,BHAVNAGAR', '5', '', '', '', 0, '', 0, 0),
(51, 'AVINASH TECHNO SOLUTIONS (P) LTD', 9825315454, '29', 'office@avinashtechno.com', '24190304840', '24690304840', '', '24', 'B-6, ANAND MAHAL,OPP ROSARY SCHOOL,PRATAPGUNJ,VADODARA 390002', '5', '', '', '', 0, '', 0, 0),
(52, 'ARIHANT TRADERS', 9898225141, '28', '', '24072900310', '24572900310', '', '24', '96/1196, UDAY APPARTMENT,B/H, NARANPURA TE. EXCHANGE,NARANPURA,AHMEDABAD - 380063', '5', '', '', '', 0, '', 0, 0),
(53, 'A R ENGINEERS', 9924855000, '29', '', '24221800327', '24721800327', '', '24', 'ROAD NO - 10, UDYOGNAGAR, UDHNA,SURAT - 394210', '5', '', '', '', 0, '', 0, 0),
(54, 'AP MARKETING', 9714699277, '28', 'apmarketing17@gmail.com', '24074002377', '24574002377', '', '24', 'B/1 BHAVNA FLATS,VASNA BARAG ROAD,NR. NARAYANNAGAR ROAD, VASNA,AHMEDABAD-380007', '5', '', '', 'Credit', 0, '', 0, 0),
(55, 'AMBICA WIRE PRODUCTS', 9825060251, '28', '', '24072300799', '24572300799', '', '24', 'A-36, KARNAVATI ESTATE,NR.TRIKAMPURA PATIYA,G.I.D.C.PHASE-3,VATVA', '5', '', '', 'Debit', 0, '', 0, 0),
(56, 'AAKAR SALES AND SERVICE', 9913866555, '28', 'service.aakar@gmail.com', '24075702662', '', '', '24', '2, KAMESHWER ESTATE,PLOT NO 3609, G.I.D.C,VATVA, AHMEDABAD 382445.', '5', '', '', 'Credit', 0, '', 0, 0),
(57, 'AMBA CHEM', 0, '29', 'ambachem@yahoo.com', '', '7450103966', '', '07', 'T-565, ROOM NO.2, PRAGATI COMPLEX ROAD,NEAR JHANDELWALAN MANDIR,IDGAH CIRCLE,DELHI 110006.', '4', '', '', 'Debit', 0, '', 0, 0),
(58, 'A A THASARIYA', 9979793025, '29', '', '24140401115', '', '', '24', 'PLOT NO 1145,MANAT A 2,OPP POLLUTION CONTROL BOARD,GHOGHA CIRCLE,BHAVNAGAR,', '5', '', '', '', 0, '', 0, 0),
(59, 'ADISHWAR HARDWARE & TOOLS', 9426562700, '29', 'adishwarnilesh@yahoo.com', '24075700541', '', '', '24', 'NO.60 PLOT NO 3609,KAMESHWAR ESTATE-PH 4,VATVA, G.I.D.C.AHMEDABAD - 382445', '5', '', '', '', 0, '', 0, 0),
(60, 'B G CONSTRUCTION', 0, '29', '', '', '', '', '24', '10,SHARMAJIVI SOCIETY,OPP.SANKALP HOSPITAL, B/H GURUKUL,DHEBAR ROAD SOUTH,RAJKOT-2', '4', '', '', 'Debit', 0, '', 0, 0),
(61, 'BULTY ROLLER CENTRE', 0, '29', '', '', '', '', '24', 'B/7, GOKUL COMPLEX , NR NAGRI HOSPITAL,ELLIS BRIDGE', '4', '', '', 'Credit', 0, '', 0, 0),
(62, 'B J MANEK', 0, '29', '', '', '', '', '24', 'DWARKA', '4', '', '', '', 0, '', 0, 0),
(63, 'BALAJI RETROREFLACTIVE', 0, '29', '', '', '', '', '24', 'AHMEDABAD', '4', '', '', '', 0, '', 0, 0),
(64, 'BALVI STEEL AND INFRASTRUCTURE P LTD', 0, '29', '', '24091803135', '24591803135', '', '24', 'SHREE BALVI HOUSE,GONDAL ROAD OPP. TULIP PARTY PLOT,NR JCB SHOWROOM,RAJKOT', '5', '', '', '', 0, '', 0, 0),
(65, 'BLAZE PROCESS ENGINEERS', 0, '29', '', '', '', '', '24', 'AHMEDABAD', '4', '', '', '', 0, '', 0, 0),
(66, 'BHAGWATI SIGN', 9925247445, '29', '', '24060303647', '', '', '24', 'E-184, SEC 26, G.I.D.C.,OPP, GREEN CITY,OLD VIDEOCON STREET,GANDHINAGAR,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(67, 'CRD AUTO PARTS', 0, '29', '', '24190205119', '24690205119', '', '24', '402-SHILPI RECEDENCY,40 SRINAGAR SOCIETY,AKOTA,VADODARA -390020', '5', '', '', '', 0, '', 0, 0),
(68, 'DISHA STEEL FAB', 9879855868, '29', '', '240 7230 3657 ', '', '', '24', '9, YOGESHWAR ROADHOUSE,B/H WONDER POINT, C.T.M.,AHMEDABAD 380026', '5', '', '', '', 0, '', 0, 0),
(69, 'DIYA ENTERPRISE', 9825138101, '29', '', '240 7450 2983 ', '', '', '24', 'SHOP-10 SILVER COMPLEX,B/H UJALA HOTEL, SARKHEJ,AHMEDABAD 382210', '5', '', '', '', 0, '', 0, 0),
(70, 'DEEPAK ENTERPRISE', 22, '28', 'primeacp@gmail.com', '', '27430283582C', '', '27', '3, BHARAT COMPOUND, OPP.PRAVASI IND ESTATE,GOREGAON(EAST) MUMBAI 400063', '4', '', '', '', 0, '', 0, 0),
(71, 'DELTA SIGNS CORPORATION', 9374713198, '29', 'deltasignscorp@gmail.com', '24221805516', '', '', '24', 'A/17/12, M G ROAD NO. 6,UDHYOG NAGAR, UDHNA,SURAT-394210', '5', '', '', '', 0, '', 0, 0),
(72, 'DAVE ELETRICAL CORPORATION', 7543628, '29', '', '24073000731', '24573000731', '', '24', 'G-S-3 , RAMBHA COMPLEX,NR.AJANTA COMM. CENTERE,OPP. GUJARAT VIDHYAPEETH,ASHRAM ROAD,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(73, 'DEEPAK TRADING CORPORAION', 9870468119, '28', ' deepaktradingcorporation@gmail.com', '27270096945V ', '27270096945C', '27AAAFD2580J1ZH', '27', 'SHON NO.4, GROUND FLOOR,KHETWADI,11TH LANE, GRANT ROAD(EAST) MUMBAI -400004', '4', '', '', '', 0, '', 0, 0),
(74, 'DIGI SIGN INCORPORATE', 9099555986, '29', 'deltasignscorp@gmail.com ', '24220204279', '24720204279', '', '24', 'A/17/12, M G ROAD NO. 6,UDHYOG NAGAR, UDHNA,SURAT-394210', '5', '', '', '', 0, '', 0, 0),
(75, 'EVA ALU PANEL LIMITED', 7574816226, '28', '', '240 5080 0727 ', '245 5080 0727', '', '24', 'AL.& POST - DALPUR, N.H.-8, NR.ASHIRWAD HOTEL, TA.- PRANTIJ DIST.- SABARKANTHA,HIMMATNAGAR', '5', '', '', '', 0, '', 0, 0),
(76, 'ESS ESS ROAD SAFETY SOLUTIONS PVT LTD', 0, '29', 'essessroadsafety@gmail.com ', '29820800684', '', '29AACCE0125F1Z4', '29', '29, 1ST CROSS, GOWDANNAPALYA,BEHIND RAPASI ENGINEERING WORKS,BANGALORE-61', '4', '', '', '', 0, '', 0, 0),
(77, 'FOREMOST TRADEALS PVT. LTD', 9427000039, '28', '', '24073303228', '24573303228', '', '24', '5 G F,RIVERVIEW COLONY,B H SHAIKH AND CO,ASHRAM ROAD,AHMADABAD', '5', '', '', '', 0, '', 0, 0),
(78, 'GUJARAT REFLECTOR CORPORATION', 9898001595, '29', 'info@gujaratreflector.com', '240 7270 2182 ', '', '', '24', 'PLOT NO 242/243/244 ROAD NO.02, KATHWADA G.I.D.C, NR SARDAR PATEL, RING ROAD, KATHWADA,AHMEDABAD 382415', '5', '', '', '', 0, '', 0, 0),
(79, 'GLOBAL ENGINEERS', 9824060474, '29', 'global.engineers2@gmail.com', '240 7370 1910 ', '', '', '24', '302, 3RD FLOOR, SHIVAM COMPLEX, BHUYANGDEV CHAR RASTA, OPP. AGRAWAL TOWER, SOLA ROAD, AHMEDABAD 380061', '5', '', '', '', 0, '', 0, 0),
(80, 'G & G TRADERS', 9826033363, '29', 'thekaransanghvi@gmail.com ', '23860801343', '', '', '', 'INDORE', '4', '', '', '', 0, '', 0, 0),
(81, 'GAJANAN STEEL ', 0, '28', '', '240 7570 0588 ', '', '', '24', 'AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(82, 'GOLDSTAR STRIPS (GUJ) PVT LTD', 9825181220, '29', 'goldstarstrips@yahoo.com', '24075102604', '24575102604', '', '24', '356,G.V.M.M.S.A.V. LTD,ODHAV,AHMEDABAD-382415', '5', '', '', '', 0, '', 0, 0),
(83, 'HI-TECH INDUSTRUAL CORPORATION', 9824213426, '29', '', '24090401025', '24590401025', '', '24', '206, KALPATRU COMPLEX, INDIRA CIRCLE,UNIVERCITY  ROAD,RAJKOT - 360004', '5', '', '', '', 0, '', 0, 0),
(84, 'INDORE ALUMINIUM', 9726915513, '28', '', '240 6030 1416 ', '245 6030 1416', '', '24', 'CHILODA, RING ROAD CIRCLE, N-H. NO 8', '5', '', '', '', 0, '', 0, 0),
(85, 'INNOVATIVE SIGNS', 0, '29', '', '24073701952', '24573701952', '', '24', '9 SHRIKRISHNA COMPLEX,NR.SBI BHUDARPURA ROAD,AMBAVADI,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(86, 'JAY TECH INFRA PROJECTS', 9723821101, '29', '', '', '', '', '24', 'VIRAT NAGAR,AHMEDABAD  ', '4', '', '', '', 0, '', 0, 0),
(87, 'JIGNESHBHAI SONLANKI', 8000004008, '29', '', '', '', '', '24', 'JAMNAGAR', '4', '', '', '', 0, '', 0, 0),
(88, 'J.M.SCRAP TRADERS', 0, '28', '', '24070101824', '', '', '24', '89/5,VIMAYOGNA DAWAKHANA,DUDHESWAR ROAD,AHMEDABAD,AHMEDABAD-380001', '5', '', '', '', 0, '', 0, 0),
(89, 'J . K . PLASTICS', 9227231510, '28', '', '24071801011', '', '', '24', 'B-1,NILIMA PARK SOCIETY,BHAIRAVNATH ROAD,MANINAGAR,AHMEDABAD,07,AHMEDABAD-380008', '5', '', '', '', 0, '', 0, 0),
(90, 'JAGDISH STEEL', 9825159695, '28', '', '24140400405', '24640400405', '', '24', 'SURVEY NO. 56 , BHAVNAGAR-ALANG ROAD,BHAVNAGAR ', '5', '', '', '', 0, '', 0, 0),
(91, 'JAINAM METAL INDUSTRIES', 9327010438, '28', '', '24075101757', '24575101757', '', '24', '276,G ROAD,OPP ROAD NO 5,KATHWADA GIDC,AHMEDABAD,07,AHMEDABAD-382415', '5', '', '', '', 0, '', 0, 0),
(92, 'JAMNAGAR ELECTRIC & MACHINARY CO', 0, '29', '', '24100300284', '24600300284', '', '24', 'PUNJAB NATIONAL BANK STREET,RANJIT ROAD,JAMNAGAR - 361001', '5', '', '', '', 0, '', 0, 0),
(93, 'KRISHNA ART', 0, '29', '', '', '', '', '24', 'AHMEDABAD', '4', '', '', '', 0, '', 0, 0),
(94, 'KAMDHENU METAL INDUATRIES', 0, '28', '', '24075700259', '24575700259', '', '24', 'WARD 4,GIDC,VATVA,AHMEDABAD,07,AHMEDABAD-382445', '5', '', '', '', 0, '', 0, 0),
(95, 'KRISHNA STEEL YARD', 9327019272, '28', '', '24072900599', '24572900599', '', '24', 'E303,ARJUN GREEN,NRVALKESHWAR,NR MENARAV HALL B H NILKANTH,NARANPURA,AHMEDABAD,AHMEDABAD-380013', '5', '', '', '', 0, '', 0, 0),
(96, 'K P SHAH ENTERPRISE', 9879658113, '29', 'kpshahenterprise@gmail.com', '24073904860', '2457390860', '24BSRPS4705G1ZG', '24', '304, AMBIENCE ARCADE, PALDI AHMEDABAD 380007.', '5', '', '', '', 0, '', 0, 0),
(97, 'K.RAVEENDRAN', 0, '29', 'info@maxpinnacle.com', '', '32111546275C', '', '32', '28/309, A- NATH THONDAYAD,KOTTOOLI ROAD,CHEVARAMBALAM P.O,KOZHIKODE-673017', '4', '', '', '', 0, '', 0, 0),
(98, 'L.N.ENTERPRISE', 9825010611, '29', '', '24074503315', '', '', '24', 'FATEWADI,SURVEY NO.375,PLOT NO.4,UTTAM DAIRY,NR SANATHAL BRIDGE,SARKHEJ,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(99, 'MARS TECHNOLOGIES', 9825016507, '28', '', '240 7380 4323 ', '245 7380 4323', '', '24', 'CALLAR PRATHMESH APPT,NR. KOTHARI AUTOMOBILES,DHANANJAY CROSS ROAD,SATELITE,AHMEDABAD  .', '5', '', '', '', 0, '', 0, 0),
(100, 'MANISH ART', 9420692538, '29', '', '', '27530535339V', '', '27', 'NASHIK', '4', '', '', '', 0, '', 0, 0),
(101, 'M/S L.G.CHAUDHARY', 274904050, '29', 'mslgchaudhari@yahoo.co.in', '24072902758', '24572902758', '', '24', '6/64, GOKUL APPARTMENT, NR. PARASNAGAR BUS STOP, SOLA ROAD, NARANPURA, AHMEDABAD 380013', '5', '', '', '', 0, '', 0, 0),
(102, 'MIT GRAFIK PVT LTD', 9825020941, '29', 'MITGRAFIK@gmail.com', '24070903313', '24570903313', '', '24', '1609, OLD KHADIA GATE,KHADIYA 07 , KHADIA,AHMEDBAD- 380001', '5', '', '', '', 0, '', 0, 0),
(103, 'MAMTA ENTERPRISE', 0, '29', '', '24071902422', '24571902422', '', '24', '20, SHANTIBAUG SOCIETY,NR. MUNCIPALHIGH SCHOOL, ISANPUR, AHMEDABAD 382443.', '5', '', '', '', 0, '', 0, 0),
(104, 'MOMAY CONSTRUCTION', 9879318084, '29', 'girishart2012@gmail.com ', '24010506436', '', '24AWMPM2777L1ZX', '24', '15, KAILASHNAGAR SHOPPING CENTER,BHUJ,KACHCHH - 370001', '5', '', '', '', 0, '', 0, 0),
(105, 'MARUTI ENTERPRISES', 9824711733, '29', '', '24210901470', '24710901470', '', '24', '12/,RAJ KAMAL ARCADE,G.I.D.C.,OLD N.H.  8,,ANKLESHWAR,BHARUCH-393002', '5', '', '', '', 0, '', 0, 0),
(106, 'MAHI ENTERPRISE -', 9638863080, '29', '', '24075206112', '', '', '24', '66, SUMANGLAM PARK,OPP GALAXY,NARODA,AHMEDABAD-382330', '5', '', '', '', 0, '', 0, 0),
(107, 'N G PROJECTS LTD', 9825060006, '29', 'harendra@ngprojects.in ', '24050700164', '', '', '24', 'MEHTAPUR CROSSING, N G CIRCLE, HIMMATNAGAR,AHMEDABAD 383001', '5', '', '', '', 0, '', 0, 0),
(108, 'NAUTAMLAL SONS & COMPANY', 9826033334, '29', 'viral11222@gmail.com ', '', '23901001917', '', '', '62/4, VALLABHNAGAR,INDORE 425001.', '4', '', '', '', 0, '', 0, 0),
(109, 'NAUSHIN STEEL ENTERPRISE', 9824371067, '28', '', '24072203103', '', '', '24', '12, AJIT MILL COMPOUND,RAKHIAL,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(110, 'NATIONAL MANUFACTURERS', 9428233952, '29', '', '24090100868', '', '', '24', 'OFFICE NO :- 61 , PARA BAZAR , B/H CLOTH MARKET,RAJKOT', '5', '', '', '', 0, '', 0, 0),
(111, 'NITYA CONSULTANT', 9879595943, '29', '', '24224201050', '24724201050', '', '24', '103 ANJLI CHAMBER, NR.OLD BUS STAND,VYARA-394650', '5', '', '', '', 0, '', 0, 0),
(112, 'N.R.SIGN', 9824061520, '29', '', '24072904021', '', '', '24', 'F/1, TUSHAR CENTER,STADIUM CIRCLE,NAVRANGPURA,AHMEDABAD-380009', '5', '', '', '', 0, '', 0, 0),
(113, 'OSWAL METALS', 7922779988, '28', '', '24072202257', '', '', '24', '8, MANGAL ESTATE, RAKHIAL,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(114, 'PRIMACY SYSTEMS PRIVATE LIMITED', 0, '28', '', '24073802595', '24573802595', '', '24', '303,SATKAR,BH SWAGAT BUILDING,ELLISBRIDGE,AHMEDABAD,AHMEDABAD-380006', '5', '', '', '', 0, '', 0, 0),
(115, 'PINSON ENTERPRISE', 98980, '29', '', '', '', '', '24', 'BAPUNAGAR,AHMEDABAD', '4', '', '', '', 0, '', 0, 0),
(116, 'PUJARA & COMPANY', 9879310610, '29', '', '24092000117', '', '', '24', 'PARA BAZAR,AHMEDABAD 363641', '5', '', '', '', 0, '', 0, 0),
(117, 'PADHIYAR VEDANTRAJINH MAHAVIRSINH', 9879227047, '29', '', '24050704039', '', '', '24', '18, B/H ASIAN PARIVAR, ADARS MAHAL, KANKAROL ROAD,HIMMATNAGAR,SABARKANTHA 383001.', '5', '', '', '', 0, '', 0, 0),
(118, 'PROTECTOR FIRE & SAFTEY', 9377927737, '29', 'purchase@protectorfiresafety.com', '24071000492', '24571000492', '', '24', 'B-509/10 , SIGNATURE PARK ,SARKHEJ , SANAND CROSS ROAD, SARKHEJ,AHMEDABAD - 380001', '5', '', '', '', 0, '', 0, 0),
(119, 'PUDUSSERY HARDWARES PVT LTD', 9847361829, '29', '', '', '32090605828C', '', '32', 'APEX CENTER , V.H. ROAD,PALAKKAD - 678001', '4', '', '', '', 0, '', 0, 0),
(120, 'PANACEA ENTERPRISE', 9879192399, '29', 'panaceaenterprise14@gmail.com', '24074503742', '24074503742', '', '24', 'B/6, KRISHNA COMPLEX ,NEAR YELLOW LIME HOTEL,SARKHEJ SANAND ROAD,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(121, 'PARMESHWAR WIRE PRODUCT', 9825611325, '28', '', '24075500525', '24575500525', '', '24', '9-10 , RAGHUVIR - 2, NATIONAL BY PASS HIGHWAY,ASLALI,AHMEDABAD - 382427', '5', '', '', '', 0, '', 0, 0),
(122, 'PATEL CORPORATION', 9824540676, '28', '', '24075700623', '24575700623', '', '24', 'PLOT NO 4200/1, PHASE - 4,BEHIND NEW NIRMA,G.I.D.C. VATVA,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(123, 'RAMESH ALUMINIUM HOUSE', 9979778080, '28', '', '', '', '', '24', '1, BHAGYODAY ESTATE,RAKHIAL,AHMEDABAD', '4', '', '', '', 0, '', 0, 0),
(124, 'RAMDEV STEEL ( INDIA )', 9724888899, '28', '', '24072204808', '24572204808', '', '24', '386 20,LALA BHORELAL NI CHALI,0,NAGARWEL HANUMAN ROAD,RAKHIAL,AHMEDABAD,AHMEDABAD-380023', '5', '', '', '', 0, '', 0, 0),
(125, 'R&B DEPARTMENT - MODASA DIVISON', 9428964104, '29', '', '', '', '', '24', 'MODASA', '4', '', '', '', 0, '', 0, 0),
(126, 'RANJIT BUILDCON LTD', 0, '29', '', '', '', '', '24', 'SOLA, AHMEDABAD', '4', '', '', '', 0, '', 0, 0),
(127, 'RAMZANBHAI ', 0, '29', '', '', '', '', '24', 'SURENDRANAGAR', '4', '', '', '', 0, '', 0, 0),
(128, 'REAL LAMINATION', 2203650, '28', 'real2lam@yahoo.in', '24072601675', '24572601675', '', '24', '103,ANAR INDUSTRIALESATE,OPP FORGE & BLOWER,B/H FRUIT MARKE, NARODA ROAD-380025\nUTTAR GUJARAT VASANT ROAAD', '5', '', '', '', 0, '', 0, 0),
(129, 'RKC INFRABUILT PVT LTD', 0, '29', '', '', '', '', '24', '3/106/DG 9 DOLAR AVENUE, PRABHA ROAD, GODHAEA 389001', '4', '', '', '', 0, '', 0, 0),
(130, 'ROLLWALA ENTERPRISE', 26581319, '29', 'rollwala.enterprise@gmail.com', '24073302108', '24573302108', '', '24', '12,MILL OFFICERS COLONY,B/H LA GAJJAR CHAMBERS,ASHRAM ROAD,AHMEDABAD.-380009', '5', '', '', '', 0, '', 0, 0),
(131, 'SIMANDHAR ALLUSHEET PVT LTD', 0, '28', '', '240 7510 4980', '245 7510 4980', '', '24', '356, G.V.M.M., ODHAV, 382415', '5', '', '', '', 0, '', 0, 0),
(132, 'SURYA WALL-CARE CHEMPVT LTD', 9227236683, '29', '', '240 6010 2022 ', '', '', '24', 'THALTEJ CROSS ROAD, THALTEJ,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(133, 'SHITAL SIGNS (P) LTD', 9825095057, '29', 'n.purvi@yahoo.com', '24074500867', '24574500867', '', '24', '2-5, SAMARPAN COMPLEX,ABOVE ICICI BANK ,BOPAL CROSS ROAD,AMBALI,AHMEDABAD.', '5', '', '', '', 0, '', 0, 0),
(134, 'SAKURA SIGNS PVT LTD', 9820025870, '29', 'sakurasigns@gmail.com', '', '27530365977V', '', '27', 'PLOT 82, SECTOR 23, VASHI MUMBAI 400705', '4', '', '', '', 0, '', 0, 0),
(135, 'SURE SIGN & SAFETY', 8000004085, '29', 'suresignsafety@yahoo.com', '24221401827', '24721401827', '', '24', 'FLAT NO. 201, 2ND FLOOR, A/6 AKSHAR ,JYOT APT., NR. BHULKA BHAVAN SCHOOL,ADAJAN ROAD,SURAT', '5', '', '', '', 0, '', 0, 0),
(136, 'SHAH ENTERPRISE', 0, '29', '', '', '', '', '24', 'AHMEDABAD', '4', '', '', '', 0, '', 0, 0),
(137, 'SHAMBAV ENGINEERS', 0, '28', '', '24071903073', '24571903073', '', '24', 'B 34, YASH BUNGLOWS,OPP. JAGDISHNAGAR SOCIETY, NEAR GHODASAR CROSSING , AHMEDABAD 380050', '5', '', '', '', 0, '', 0, 0),
(138, 'S FOR ENTERPRISE', 0, '29', '', '', '', '', '24', 'B-57, B/H MARKETING YARD ,SURENDRANAGAR', '5', '', '', '', 0, '', 0, 0),
(139, 'STAR ELECTROMECH', 0, '29', '', '24072501580', '24572501580', '', '24', '14,UMIYANAGAR SOCIETY,RAGHUVIR PARK-1,NR KENAL,NIKOL GAM ROAD,AHMEDABAD,AHMEDABAD-382350', '5', '', '', '', 0, '', 0, 0),
(140, 'S M ENGINEERING WORKS', 9825936023, '29', '', '', '', '', '24', 'VASANDA ROAD CHIKHLI.', '4', '', '', '', 0, '', 0, 0),
(141, 'SHAAKAR BUILD SERVICES', 0, '29', '', '', '', '', '24', '124-PLENARY ARCADE,NEAR BOMBAY GARAGE PETROL PUMP,GONDL ROAD,RAJKOT-2', '4', '', '', '', 0, '', 0, 0),
(142, 'SIKANDARBHAI', 0, '29', '', '', '', '', '24', 'RAJKOT', '4', '', '', '', 0, '', 0, 0),
(143, 'SHILPA ROAD SAFETY PVT LTD', 9769973557, '29', '', '', '27950862289V', '', '27', 'NAGU MAMA COMPOUND,SHIVAJI NAGAR,NR CLASSIC COMFORT ,HOTEL,GOKHULDHAM,GOREGAON,EAST MUMBAI-400065', '4', '', '', '', 0, '', 0, 0),
(144, 'SHREE RAM ENTERPRISES', 0, '29', '', '24210103033', '', '', '24', '52, RAJ KAMAL ARCADE SHOPPING CENTER,GIDC STATION ROAD,ANKLESHWAR.', '5', '', '', '', 0, '', 0, 0),
(145, 'SHIV ENTERPRISE', 0, '29', '', '24190402390', '24690402390', '', '24', 'RAMDEV ESTATE GALI,0,OPP ANKITA HOTEL,GHATLODIA,AHMADABAD,AHMEDABAD-382581', '5', '', '', '', 0, '', 0, 0),
(146, 'SHIV PAVERS', 7405265084, '28', '', '24074207080', '', '', '24', 'GOTA, AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(147, 'SPLCO ALUMINIUM CO.', 0, '28', '', '24073608957', '24573608957', '', '24', 'D804,SAMRAJYA NAGAR,0,NR MANAV MANDIR,MEMNAGAR,AHMEDABAD,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(148, 'SHAH INSULATING CORPORATION', 0, '28', '', '24070901297', '24570901297', '', '24', 'BALA HANUMAN LANE,GANDHI RAOD,AHMEDABAD - 380001', '5', '', '', '', 0, '', 0, 0),
(149, 'SHUBHAM CONSTRUCTION', 0, '29', 'ambaliyaconstruction786@gmail.com', '24140401157', '24640401157', '', '24', 'PLOT NO 212, B 50 VARIYA,OPP HANUMAN TEMPLE,SAEDAR NAGAR,BHAVNAGAR', '5', '', '', '', 0, '', 0, 0),
(150, 'SINTEC CONTROLS & SWITCHGEAR', 0, '29', '', '24072603330', '24572603330', '', '24', '95, 1ST FLOOR, AMAR ESTATE, NR. LUBI ELECTRICALS, MEMCO, AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(151, 'SAFE VISION ENTERPRISE', 0, '29', 'safevisionent@gmail.com', '24075204012', '24575204012', '', '24', 'SHOP - 9, ARPAN BUNGLOWS,NR.SUKUN BUNGLOWS,NIKOL,NARODA ROAD,AHMEDABAD - 382346', '5', '', '', '', 0, '', 0, 0),
(152, 'SHREE UMA CONSTRUCTION', 0, '29', '', '', '', '', '24', 'SARDHAV VAS OPP, WATER TANK,PETHAPPUR DIIST,GANDHINAGAR-382610', '4', '', '', '', 0, '', 0, 0),
(153, 'SHAH CORPORATION', 0, '29', '', '24074500913', '24574500913', '', '24', 'CANTEEN NO 4, SAHJANAND ESTATE,NR WATER TANK,S G ROAD, AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(154, 'SAUMYA CONSTRUCTION', 9904833311, '29', 'j4jigarsoni@gmail.com', '24072501737', '', '', '24', 'A/15, HARIOM SOCIETY,BAPUNAGAR,AHMEDABAD 380025', '5', '', '', '', 0, '', 0, 0),
(155, 'SHREE HARI TRANSFORMER', 0, '29', '', '24075301747', '24575301747', '', '24', 'B/9, JAYLAXMI SOC., OPP.SATNARAYAN SOC.,THAKKARBAPA NAGAR,AHMEDABAD - 382350', '5', '', '', '', 0, '', 0, 0),
(156, 'SARASVATI SAFTEY PRODUCTS', 9898129948, '29', 'saraswatisafetyproducts@gmail.com', '24040304026', '24540304026', '', '24', '34, SARDANAGAR SOCIETY, 2 GARE NEAR ROSE GARDEN, HOTEL HIGHWAY ROAD, MAKTUPUR, MAHESANA 384170', '5', '', '', '', 0, '', 0, 0),
(157, 'SHARDA GRAMODHYOG KENDRA', 9825474797, '29', 'shardagk@gmail.com', '24071500956', '24571500956', '', '24', '29, MIHIR TOWER,UTTAMNAGAR,OPP HIRABHAI TOWER,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(158, 'S G PATEL', 9099400009, '29', '', '', '', '', '24', 'AT & PO. JAMLIYA,NEAR AMBIKA STONE,QUARRY,VANADA, NAVSARI 396580', '4', '', '', '', 0, '', 0, 0),
(159, 'SOMNATH INDUSTRIES', 9998088904, '28', 'info@somnathsteel.com,info.somnath11@gmail.com', '24072204181', '24572204181', '24ABWFS1388L1ZC', '24', '8, MAGAL ESTATE,NR. CHAKUDIA MAHADEV,RAKHIAL,AHMEDABAD - 380023', '5', '', '', '', 0, '', 0, 0),
(160, 'SOLTRACK TECHNOLOGIES PVT LTD', 9824540746, '28', 'info@soltrack.co.in, soltracktechno@gmail.com', '', '', '24AAMCS6861J1ZU', '24', 'A/312, 3RD FLOOR,RATNA BUSINESS COMPLEX, OPP H.K. COMMERCECOLLEGE, ASHRAM ROAD,AHMEDABAD 380002', '5', '', '', '', 0, '', 0, 0),
(161, 'SHIVSHAKTI PAINTS INDUSTRIES', 7383461733, '28', '', '24075602959', '', '', '24', '29, VODHI ESTATE, PHASE I,MAHALAXMI IND. ESTATE,BOMBAY CONDUCTOR ROAD,G.I.D.C. VATVA,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(162, 'TANVI ENGIMECH PVT LTD', 9998556262, '29', '', '24072703601', '', '', '24', 'RAMOL-VANCH GAM ROAD, NR RING ROAD, AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(163, 'TARALBHAI', 0, '29', '', '', '', '', '24', 'HIMMATNAGAR', '4', '', '', '', 0, '', 0, 0),
(164, 'UNIQUE AGENCY', 9879310610, '29', 'unique.agency@gmail.com', '24092002112', '24592002112', '', '24', 'SHED NO K1/09 G.I.D.C, SANALA ROAD, MORBI,RAJKT 363641', '5', '', '', '', 0, '', 0, 0),
(165, 'UNIVERSAL SIGNAGE', 9825039597, '29', 'rajeshshroff@unisign.co.in', '24073601541', '24573601541', '', '24', 'C/3,TUSHAR CENTER,STADIUM CIRCLE,NAVRANGPURA,AHMEDABAD-380009', '5', '', '', '', 0, '', 0, 0),
(166, 'UNICORP SOLUTIONS PVT LTD', 7554200121, '29', 'unicorpltd@ymail.com', '23709034505', '23709034505', '', '', '29-A, SECTOR D, OPPOSITE EICHER MAIN GATE NO1,INDUSTRIAL AREA MANDIDEEP,DIST. RAISEN (M.P)', '4', '', '', '', 0, '', 0, 0),
(167, 'VINAYAK SAFTEY SERVICE', 9879109834, '29', '', '24011005992', '24511005992', '', '24', 'G-14 , MADHUBAN COMPLEX,PLOT NO : - 128 , OSLO ROAD ,GANDHIDHAM - 370201\n', '5', '', '', '', 0, '', 0, 0),
(168, 'VASANT TRANSFORMER', 0, '29', '', '24072601431', '', '', '24', '20/SUKRUT ESTATE, MEMCO,AHMEDABAD', '5', '', '', '', 0, '', 0, 0),
(169, 'VEDANSHEE SAFETY AND SIGN', 9712996098, '29', 'vdsign123@gmail.com', '24220203995', '24720203995', '', '24', '171,AGIYARI STREET,NAVYUG COLLEGE,ADAJAN GAM SURAT,395009\n', '5', '', '', '', 0, '', 0, 0),
(170, 'VIVA COMPOSITE PANEL PVT LTD', 0, '28', '', '24250503418', '24750503418', '', '24', '45/1, 45/2 PRIME ESTATE ,NR. KHUSHBU AAUTO PVT LTD,B/H JAMNAGAR TRANSPORT, SARKHEJ,AHMEDABAD- 382210', '5', '', '', '', 0, '', 0, 0),
(171, 'YAGNA INDUSTRIES', 0, '29', '', '24222302417', '', '', '24', 'A 21/9 UDYOGNAGAR , UDHNA OPP. VIREN STEEL, SURAT', '5', '', '', '', 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `company_mas`
--

CREATE TABLE `company_mas` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `contact_no` varchar(10) NOT NULL,
  `comp_email` varchar(250) NOT NULL,
  `comp_vat_no` varchar(250) NOT NULL,
  `comp_cst_no` varchar(250) NOT NULL,
  `gst` varchar(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `comp_address` varchar(250) NOT NULL,
  `contact_person_name` varchar(250) NOT NULL,
  `contact_person_no` varchar(10) NOT NULL,
  `header_img` varchar(250) NOT NULL,
  `footer_img` varchar(250) NOT NULL,
  `stamp_img` varchar(250) NOT NULL,
  `comp_createdby` varchar(250) NOT NULL,
  `flag` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_mas`
--

INSERT INTO `company_mas` (`company_id`, `company_name`, `contact_no`, `comp_email`, `comp_vat_no`, `comp_cst_no`, `gst`, `state`, `comp_address`, `contact_person_name`, `contact_person_no`, `header_img`, `footer_img`, `stamp_img`, `comp_createdby`, `flag`) VALUES
(1, 'K P SHAH ENTERPRISE PVT LTD PVT LTD PVT LTD', '9898985566', 'mehul@gmail.com', '1234567890', '1234567890', '456888999232aaa', '24', 'asss', 'dhaval', '9898985566', 'images_pro/company/head/5f688acd914d596918a1fe7a0e4939a71.png', 'images_pro/company/foot/14039fed0aace3252023bf7985b32a3b2.png', 'images_pro/company/stamp/14039fed0aace3252023bf7985b32a3b3.png', '8', 0),
(2, 'TYSU1', '9898998989', 'mehul@gmail.com', '12', '123', '1124568', '24', 'hello,a', 'TYSU2', '9898998989', '1.gif', '2.gif', '3.gif', '8', 0),
(5, 'new company', '789', 'hellohellohello@gmail.com', '45688', '4568888', '', '', 'adasdasd', 'mehul', '895', 'images_pro/company/head/99a7e3cbcaaaf6c336f6e4eb1cfe5ebf1.png', 'images_pro/company/foot/99a7e3cbcaaaf6c336f6e4eb1cfe5ebf2.png', 'images_pro/company/stamp/99a7e3cbcaaaf6c336f6e4eb1cfe5ebf3.jpg', 'admin', 0),
(6, 'K P Shah', '2147483647', 'kpshah@gmail.com', '45688899', '45688899', '3789898522', '01', 'ahmedabad', 'Kpshah ', '2147483647', 'images_pro/company/head/513824d2987d0758538e567dd1005f351.', 'images_pro/company/foot/513824d2987d0758538e567dd1005f352.', 'images_pro/company/stamp/513824d2987d0758538e567dd1005f353.', 'admi', 0),
(7, 'tataa', '9898989851', 'mehula@gmail.com', '12345', '12345', 'aa', '35', 'mehula@gmail.com', 'rahul kavaa', '9898989851', 'images_pro/company/head/fc75f292ed602be5a91c6fef927d9e2b1.', 'images_pro/company/foot/1d340969196b8da9cbfbd093763556962.', 'images_pro/company/stamp/1d340969196b8da9cbfbd093763556963.', '8', 0),
(8, 'new company s', '8866552255', 'mehul2081@gmail.com', '', '', '', '37', 'sfsdfsdfs', 'new company s', '8866552255', 'images_pro/company/head/78174ba1ba0eaf26bba80e82f6618d5f1.png', 'images_pro/company/foot/78174ba1ba0eaf26bba80e82f6618d5f2.png', 'images_pro/company/stamp/78174ba1ba0eaf26bba80e82f6618d5f3.png', '8', 0),
(9, 'Moto', 'sdfsdfs', 'sfdsdfdsf', '', '', '', '', '', 'sdfsdf', 'sdfsdfd', '', '', '', 'Super Admin', 0),
(10, 'adfsdfsdf', '9898987898', 'sadad@das.vcb', '', '', '', '28', 'asdasdds\r\nadsds', 'dsfsdfdsf', '9898989898', 'images_pro/company/head/80043c948145a83d514849a57e1fefb51.gif', 'images_pro/company/foot/0754a8874c7fbe564bc3101aa18914042.png', 'images_pro/company/stamp/0754a8874c7fbe564bc3101aa18914043.gif', 'Super Admin', 0),
(11, 'kava my', '9898987899', 'a@gmail.com', '', '', '', '35', 'jhgjh', 'sasass', '9898987899', 'images_pro/company/head/947a9f9f2f6a542db01b27ddece1b5281.png', 'images_pro/company/foot/6c9ae01fab7b354d8ce0acabd1e886202.gif', 'images_pro/company/stamp/6c9ae01fab7b354d8ce0acabd1e886203.', 'Super Admin', 0),
(12, 'OHMS', '9898987899', 'a@gmail.com', '', '', '', '28', 'OHMS', 'OHMS', '9898987899', 'images_pro/company/head/7e10cfd623395c846b6fb2219f4a07341.png', 'images_pro/company/foot/7e10cfd623395c846b6fb2219f4a07342.png', '', 'Super Admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `financial_year_master`
--

CREATE TABLE `financial_year_master` (
  `financial_id` int(11) NOT NULL,
  `year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `financial_year_master`
--

INSERT INTO `financial_year_master` (`financial_id`, `year`) VALUES
(1, '2014_2015'),
(2, '2015_2016'),
(3, '2016_2017'),
(99, '2017_2018');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `val` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `name`, `val`) VALUES
(1, 'Manage Product', 1),
(2, 'Manage Project', 2),
(4, 'Manage Category', 3),
(5, 'Manage Prefix', 4),
(6, 'Manage Tax', 5),
(7, 'Manage Company', 6),
(8, 'Add Financial Year', 7),
(9, 'Manage User', 8),
(10, 'Manage Unit', 9),
(11, 'Add New Client', 10),
(12, 'Manage Client', 11),
(13, 'Add New Challan', 12),
(14, 'Manage Challan', 13),
(15, 'Add New Quatation', 14),
(16, 'Manage Quatation', 15),
(17, 'Add Purchase Invoice', 16),
(18, 'Add Purchase Return Invoice', 17),
(19, 'Manage Purchase Invoice', 18),
(20, 'Manage Purchase Return Invoice', 19),
(21, 'Add Sales Invoice', 20),
(22, 'Add Sales Return Invoice', 21),
(23, 'Manage Sales Invoice', 22),
(24, 'Manage Sales Return Invoice', 23),
(25, 'Add New Payment', 24),
(26, 'Manage Payment', 25),
(27, 'Add New Reciept', 26),
(28, 'Manage Reciept', 27),
(29, 'Add New Expensess', 28),
(30, 'Manage Expensess', 29),
(31, 'New Project Verification', 30),
(32, 'Manage Project Verification', 31),
(33, 'Add Journal Entery', 32),
(34, 'Journal Enteries', 33),
(35, 'Ledger Reports', 34),
(36, 'Account Reports', 35),
(37, 'Project Reports', 36),
(38, 'Trading Reports', 37),
(39, 'Profit & Loss Reports', 38),
(40, 'Balance Sheet Reports', 39),
(43, 'Manage State Code', 42),
(44, 'Import Products', 43),
(45, 'Import Clients', 44);

-- --------------------------------------------------------

--
-- Table structure for table `prefix_master`
--

CREATE TABLE `prefix_master` (
  `prefix_id` int(11) NOT NULL,
  `serial_name` varchar(25) NOT NULL,
  `prefix_code` varchar(5) NOT NULL,
  `suffix_code` varchar(10) NOT NULL,
  `total_page` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `prefix_master`
--

INSERT INTO `prefix_master` (`prefix_id`, `serial_name`, `prefix_code`, `suffix_code`, `total_page`) VALUES
(4, 'RETAIL INVOICE', 'R', '17-18', 100),
(5, 'TAX INVOICE', 'T', '17-18', 100),
(6, 'CASH INVOICE', 'C', '17-18', 100),
(7, 'Add Invoice', 'A', '15-16', 25),
(9, 'GST INVOICE', 'G', '17-18', 50),
(10, 'sdasd', 'D', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `product_id` int(5) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `HSN` varchar(250) NOT NULL,
  `rate` int(11) NOT NULL,
  `product_unit` varchar(25) NOT NULL,
  `product_size` varchar(5) NOT NULL,
  `product_catagory` varchar(50) NOT NULL,
  `product_desc` varchar(200) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`product_id`, `product_name`, `HSN`, `rate`, `product_unit`, `product_size`, `product_catagory`, `product_desc`, `flag`) VALUES
(16, 'charger', '46452', 18, 'cm', '5', 'Electronic', 'sfsdfsdf', 0),
(22, 'Mouse', '456888999', 18, 'mm', '45', 'Electronic', 'asdasds', 0),
(23, 'Hand-phone', '789555666', 28, 'meter', '1', 'Electronic', 'head phone for\r\n samsung', 0),
(24, 'pen drive', '4568899', 18, 'Hard-disc', '32', 'Computer', 'fsdfsdf', 0),
(25, 'Mobile Apple ', '455689', 28, 'cm', '22', 'Electronic', 'new i phone\r\n', 0),
(26, 'bag', '5566889', 18, 'cm', '2212', 'Natural', 'new bag ', 0),
(27, 'Headphone', '12', 5, 'mm', '10', 'Electronic', 'sadasdas', 0),
(28, 'aasdasd', 'adasdasd', 5, 'cm', '88', 'Civil', 'sdfdsfd', 0),
(29, 'pen Parker', '5896622abc', 5, 'meter', '', '', 'sdfsfds', 0),
(31, 'Mobile', '458952156', 10000, 'MM', '20', 'Electronics', 'Samsung S3 Mobile', 0),
(32, 'product_name', 'HSN', 0, 'product_unit', 'produ', 'product_catagory', 'product_desc', 0),
(33, 'Mobile', '458952156', 10000, 'MM', '20', 'Electronics', 'Samsung S3 Mobile', 0),
(34, 'product_name', 'HSN', 0, 'product_unit', 'produ', 'product_catagory', 'product_desc', 0),
(35, 'Mobile', '458952156', 10000, 'MM', '20', 'Electronics', 'Samsung S3 Mobile', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_master`
--

CREATE TABLE `project_master` (
  `project_id` int(11) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `client_name` varchar(250) NOT NULL,
  `contact_person_name` varchar(50) NOT NULL,
  `contact_no` bigint(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_master`
--

INSERT INTO `project_master` (`project_id`, `project_name`, `client_name`, `contact_person_name`, `contact_no`, `email`, `address`, `flag`) VALUES
(9, 'Baroda', 'Tcs pvt. Ltd', 'mahesh panchal', 9876548721, 'mahesh23@gmail.com', '198/archade mall,navrangpura', 0),
(10, 'mumbai', 'Wipro Pvt Ltd.', 'naishadh Dave', 9812652378, 'naishadh12@gmail.com', '123/ pushpak mall', 0),
(11, 'Dubai', 'kava pvt.Ltd', 'Mehul Kava', 9847271900, 'mehulkava90@gmail.com', 'b-198/c-675/gokuldham,vrandavan', 0),
(12, 'Singapore', 'jain industries', 'kajal jain', 7698352411, 'jain2901@gmail.com', '12/ajay shopping mall,vastral', 0),
(13, 'Banglore', 'Apple Inc.', 'Gopal garasiya', 9087452671, 'gopal76@gmail.com', 'c-91/platinumplazza,bangkok', 0),
(14, 'vastrapur', '', 'rahul jain', 7895556667, 'rahul@gmail.com', 'vastrapur,satyam mall', 0),
(15, 'abc', '', 'mr.abc', 9898998989, 'abc@gmil.com', 'sfdfd', 0),
(16, 'sddsdfsf', '', '', 0, 'asasdsad@dfgfg.cbn', '', 0),
(17, 'asdsd', '', '', 0, 'asasdsad@dfgfg.cbn', 'hello\r\nssfsdf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sel_type`
--

CREATE TABLE `sel_type` (
  `id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sel_type`
--

INSERT INTO `sel_type` (`id`, `type`) VALUES
(1, 'Local-Tax'),
(2, 'Local-Retail'),
(3, 'InterState-Tax'),
(4, 'InterState-Retail');

-- --------------------------------------------------------

--
-- Table structure for table `state_code`
--

CREATE TABLE `state_code` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `code` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state_code`
--

INSERT INTO `state_code` (`id`, `name`, `code`) VALUES
(1, 'Andaman and Nicobar Islands', '35'),
(2, 'Andhra Pradesh ', '28'),
(3, 'Andhra Pradesh (New)', '37'),
(4, 'Arunachal Pradesh ', '12'),
(5, 'Assam', '18'),
(6, 'Bihar', '10'),
(7, 'Chandigarh', '04'),
(8, 'Chattisgarh', '22'),
(9, 'Dadra and Nagar Haveli', '26'),
(10, 'Daman and Diu ', '25'),
(11, 'Delhi ', '07'),
(12, 'Goa', '30'),
(13, 'Gujarat', '24'),
(14, 'Haryana', '06'),
(15, 'Himachal Pradesh', '02'),
(16, 'Jammu and Kashmir', '01'),
(17, 'Jharkhand', '20'),
(18, 'Karnataka', '29'),
(19, 'Kerala', '32'),
(20, 'Lakshadweep Islands ', '31'),
(21, 'Madhya Pradesh', '23'),
(22, 'Maharashtra', '27'),
(23, 'Manipur', '14'),
(24, 'Meghalaya', '17'),
(25, 'Mizoram', '15'),
(26, 'Nagaland', '13'),
(27, 'Odisha', '21'),
(28, 'Pondicherry', '34'),
(29, 'Punjab', '03'),
(30, 'Rajasthan', '08'),
(31, 'Sikkim', '11'),
(32, 'Tamil Nadu ', '33'),
(33, 'Telangana', '36'),
(34, 'Tripura', '16'),
(35, 'Uttar Pradesh', '09'),
(36, 'Uttarakhand', '05'),
(37, 'West Bengal', '19');

-- --------------------------------------------------------

--
-- Table structure for table `tax_master`
--

CREATE TABLE `tax_master` (
  `tax_id` int(11) NOT NULL,
  `tax_name` varchar(20) NOT NULL,
  `st` float NOT NULL,
  `vat` float NOT NULL,
  `cst` float NOT NULL,
  `gst` float NOT NULL,
  `add_tax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tax_master`
--

INSERT INTO `tax_master` (`tax_id`, `tax_name`, `st`, `vat`, `cst`, `gst`, `add_tax`) VALUES
(8, '5 % G.S.T', 5, 0, 0, 0, 0),
(9, '12 % G.S.T', 12, 0, 0, 0, 0),
(10, '18 % G.S.T', 18, 0, 0, 0, 0),
(11, '28 % GST', 28, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unit_master`
--

CREATE TABLE `unit_master` (
  `unit_id` int(11) NOT NULL,
  `unit_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_master`
--

INSERT INTO `unit_master` (`unit_id`, `unit_name`) VALUES
(8, 'meter'),
(9, 'cm'),
(10, 'mm'),
(11, 'feet'),
(13, 'Hard-disc'),
(14, 'k g');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `user_master_id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `user_pass` varchar(32) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_photo` varchar(250) NOT NULL,
  `page_authen` varchar(500) NOT NULL,
  `company_authen` varchar(250) NOT NULL,
  `year_authen` varchar(250) NOT NULL,
  `df` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`user_master_id`, `full_name`, `user_pass`, `username`, `user_photo`, `page_authen`, `company_authen`, `year_authen`, `df`) VALUES
(1, 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', '', '', '', '', 1),
(2, 'Mehul kava', '827ccb0eea8a706c4c34a16891f84e7b', 'mehul', 'images_pro/user/0399ddf171d74a798cc6c202cb677d19.png', '1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1', '1,2', '1,2,3,86', 0),
(8, 'Super Admin', '60eb0f73e33ce3ffd4e51d974447db53', 'admi', 'images_pro/user/11b28a9770995d6c57ebe83b2b4d028d1.png', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,42,43,44', '1,2,11', '101,99,3,1', 0),
(9, 'Ayush Kava', '827ccb0eea8a706c4c34a16891f84e7b', 'ayush', 'images_pro/user/5a6447d0ddd99755c8d4f1b2859d666a.png', '22', '1', '99', 0),
(12, 'MehulKava', '21232f297a57a5a743894a0e4a801fc3', 'Mehul555', 'images_pro/user/6e782071fd15582fd368f19f45e2bb31.gif', '', '1,2', '99,3', 0),
(13, '', 'd41d8cd98f00b204e9800998ecf8427e', '', 'images_pro/user/095d7a765cfd92c4acfed81e95b59836.', '', '', '', 0),
(14, 'sadasd', '202cb962ac59075b964b07152d234b70', 'sdsad', 'images_pro/user/8b31f2521f9a4ca605ece8f6088de4ae.', '', '', '', 0),
(15, 'sdasd', '47bce5c74f589f4867dbd57e9ca9f808', '', 'images_pro/user/5edcbd8029cba54ec1b68f147634281f.pdf', '', '', '', 0),
(16, 'aaaa', '47bce5c74f589f4867dbd57e9ca9f808', 'mehul', 'images_pro/user/fdbbe4de669d655851191323ea7d8e90.', '', '', '', 0),
(17, 'aaa', '47bce5c74f589f4867dbd57e9ca9f808', '', 'images_pro/user/4226da7d809d9f833b30fd37c2dee2bb.', '', '', '', 0),
(18, 'new user', 'e10adc3949ba59abbe56e057f20f883e', 'newuser', 'images_pro/user/eca90a5a4edc459effa6c3e2220b2748.', '', '1', '99', 0),
(19, 'kava', 'f5b768225a3f3f7770217293d3bf7882', 'kava', 'images_pro/user/f3.png', '', '1', '99', 0),
(20, 'kavaa', 'e10adc3949ba59abbe56e057f20f883e', 'kavaa', 'images_pro/user/550d20c7381c80c759baf5d8e96c98db.png', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`ac_id`);

--
-- Indexes for table `catagory_master`
--
ALTER TABLE `catagory_master`
  ADD PRIMARY KEY (`catagory_id`);

--
-- Indexes for table `client_master`
--
ALTER TABLE `client_master`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `company_mas`
--
ALTER TABLE `company_mas`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `financial_year_master`
--
ALTER TABLE `financial_year_master`
  ADD PRIMARY KEY (`financial_id`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prefix_master`
--
ALTER TABLE `prefix_master`
  ADD PRIMARY KEY (`prefix_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `project_master`
--
ALTER TABLE `project_master`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `sel_type`
--
ALTER TABLE `sel_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_code`
--
ALTER TABLE `state_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_master`
--
ALTER TABLE `tax_master`
  ADD PRIMARY KEY (`tax_id`);

--
-- Indexes for table `unit_master`
--
ALTER TABLE `unit_master`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`user_master_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `ac_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `catagory_master`
--
ALTER TABLE `catagory_master`
  MODIFY `catagory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `client_master`
--
ALTER TABLE `client_master`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;
--
-- AUTO_INCREMENT for table `company_mas`
--
ALTER TABLE `company_mas`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `financial_year_master`
--
ALTER TABLE `financial_year_master`
  MODIFY `financial_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;
--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `prefix_master`
--
ALTER TABLE `prefix_master`
  MODIFY `prefix_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `product_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `project_master`
--
ALTER TABLE `project_master`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `sel_type`
--
ALTER TABLE `sel_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `state_code`
--
ALTER TABLE `state_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tax_master`
--
ALTER TABLE `tax_master`
  MODIFY `tax_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `unit_master`
--
ALTER TABLE `unit_master`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `user_master_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
