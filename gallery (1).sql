-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2025 at 05:54 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `albumid` int(11) NOT NULL,
  `namaalbum` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggalbuat` date NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumid`, `namaalbum`, `deskripsi`, `tanggalbuat`, `userid`) VALUES
(44, 'Bedroom Interior Design', '                                                                    Dengan perpaduan sempurna antara estetika modern dan elemen yang nyaman, kamar tidur ini dirancang untuk memberikan ketenangan. Sentuhan kayu dan kain lembut membawa kehangatan pada ruang, sementara pencahayaan yang strategis meningkatkan suasana yang tenang.                                                                 ', '2025-02-16', 12),
(45, 'Living Room Interior Design', 'Elegan dan hangat, ruang tamu yang dirancang dengan baik menjadi pusat dari sebuah rumah. Dengan furnitur, pencahayaan, dan dekorasi yang tepat, ruang ini menciptakan suasana nyaman untuk bersantai dan berkumpul. ', '2025-02-13', 12),
(46, 'building interior design', 'Desain Interior Gedung adalah proses perencanaan dan penataan ruang dalam sebuah bangunan agar lebih fungsional, estetis, dan nyaman sesuai dengan kebutuhan penghuninya.', '2025-02-16', 16);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `fotoid` int(11) NOT NULL,
  `judulfoto` varchar(255) NOT NULL,
  `deskripsifoto` text NOT NULL,
  `tanggalunggah` date NOT NULL,
  `lokasifile` varchar(255) NOT NULL,
  `albumid` int(11) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`fotoid`, `judulfoto`, `deskripsifoto`, `tanggalunggah`, `lokasifile`, `albumid`, `userid`) VALUES
(76, 'LR dein1', 'Desain modern yang menciptakan ruang yang lapang dan menenangkan.', '2025-02-10', '1493564505-LR Dein1.jpg', 45, 12),
(77, 'LR dein2', 'Keseimbangan antara estetika dan fungsi dalam desain ruang tamu modern', '2025-02-10', '251687271-LR Dein2.jpg', 45, 12),
(78, 'LR dein3', 'Desain eksklusif yang menghadirkan kesan berkelas dan elegan.', '2025-02-10', '2070750301-LR Dein3.jpg', 45, 12),
(79, 'LR dein4', 'Perpaduan sempurna antara kemewahan dan kenyamanan dalam desain ruang.', '2025-02-10', '222661921-LR Dein4.jpg', 45, 12),
(80, 'LR dein5', 'Nuansa kemewahan dalam ruang tamu yang penuh pesona.', '2025-02-10', '404350124-LR Dein5.jpg', 45, 12),
(81, 'LR dein6', 'Keindahan dalam kesederhanaan, menciptakan ruang yang nyaman dan menawan.', '2025-02-10', '934080773-LR Dein6.jpg', 45, 12),
(82, 'LR dein7', 'Menikmati atmosfer mewah dalam ruang tamu yang dirancang dengan sempurna.', '2025-02-12', '1634199480-LR Dein7.jpg', 45, 12),
(83, 'LR dein8', 'Sentuhan material alami untuk ruang yang lebih tenang dan harmonis.', '2025-02-12', '772054214-LR Dein8.jpg', 45, 12),
(84, 'LR dein9', 'Ruang tamu yang terasa lebih hidup dengan elemen alami dan pencahayaan alami.', '2025-02-12', '1698479217-LR Dein9.jpg', 45, 12),
(85, 'LR dein10', 'Setiap elemen dirancang dengan cermat untuk menciptakan ruang yang memikat.', '2025-02-12', '201246139-LR Dein10.jpg', 45, 12),
(86, 'BR Dein1', 'Warna netral mendominasi ruangan dengan dinding polos dan perabot simpel, menciptakan suasana tenang dan lapang.', '2025-02-16', '1995914396-BR Dein1.jpg', 44, 12),
(87, 'BR Dein2', 'Perpaduan warna lembut dengan aksen kayu dan ukiran elegan memberikan sentuhan mewah dan timeless.', '2025-02-16', '1675809155-BR Dein2.jpg', 44, 12),
(89, 'BD Dein1', 'Dinding beige dipadukan dengan furnitur senada, memberikan tampilan harmonis', '2025-02-16', '673629662-BD Dein1.jpg', 46, 16),
(90, 'BD Dein2', ' Sentuhan beige lembut pada lantai dan langit-langit menambah kesan luas.', '2025-02-16', '48168053-BD Dein2.jpg', 46, 16),
(91, 'BD Dein3', 'Nuansa beige mendominasi ruang, menciptakan kesan hangat dan elegan.', '2025-02-16', '639804004-BD Dein3.jpg', 46, 16),
(92, 'BD Dein4', ' Pencahayaan hangat memperkuat tone beige, menciptakan atmosfer yang nyaman.', '2025-02-16', '1961994487-BD Dein4.jpg', 46, 16),
(93, 'BR Dein3', 'Warna natural berpadu dengan elemen kaca dan pencahayaan tersembunyi, menciptakan tampilan yang bersih dan futuristik.', '2025-02-16', '1609250524-BR Dein3.jpg', 44, 12),
(94, 'BR Dein4', 'Palet warna lembut dipadukan dengan tekstur kayu terang dan kain linen, menghadirkan suasana hangat dan nyaman.', '2025-02-16', '1135783080-BR Dein4.jpg', 44, 12),
(95, 'BR Dein5', 'Nuansa netral dengan dekorasi anyaman, tanaman hijau, dan motif etnik menciptakan suasana santai dan alami', '2025-02-16', '922592438-BR Dein5.jpg', 44, 12),
(96, 'BR Dein6', ' Warna natural dipadukan dengan elemen beton dan besi hitam, menghasilkan tampilan yang unik dan berkarakter.', '2025-02-16', '303360479-BR Dein6.jpg', 44, 12),
(97, 'BR Dein7', 'Warna yang menenangkan dikombinasikan dengan furnitur rendah dan elemen alami, menciptakan keseimbangan antara Jepang dan Skandinavia.', '2025-02-16', '698321731-BR Dein7.jpg', 44, 12),
(98, 'BR Dein8', ' Warna elegan dengan aksen emas dan kain beludru menciptakan nuansa mewah dan eksklusif.', '2025-02-16', '2058011516-BR Dein8.jpg', 44, 12),
(99, 'BR Dein9', 'Dinding bertekstur dengan elemen kayu tua menghadirkan kesan alami dan hangat.', '2025-02-16', '570632492-BR Dein9.jpg', 44, 12),
(100, 'BR Dein10', 'Warna netral dikombinasikan dengan pencahayaan LED dan bentuk geometris modern, memberikan tampilan unik dan inovatif.', '2025-02-16', '1450527082-BR Dein10.jpg', 44, 12);

-- --------------------------------------------------------

--
-- Table structure for table `komentarfoto`
--

CREATE TABLE `komentarfoto` (
  `komentarid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `isikomentar` text NOT NULL,
  `tanggalkomentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentarfoto`
--

INSERT INTO `komentarfoto` (`komentarid`, `fotoid`, `userid`, `isikomentar`, `tanggalkomentar`) VALUES
(36, 77, 12, 'prettyy', '2025-02-12'),
(37, 82, 12, 'pretty^^!!!', '2025-02-13'),
(38, 82, 12, 'woaww', '2025-02-13'),
(39, 83, 12, 'pretty^^!!!', '2025-02-14'),
(40, 90, 12, 'nicee design!!', '2025-02-16'),
(42, 93, 12, 'pretty room!!', '2025-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `likeid` int(11) NOT NULL,
  `fotoid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `tanggallike` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`likeid`, `fotoid`, `userid`, `tanggallike`) VALUES
(127, 77, 12, '2025-02-12'),
(128, 78, 12, '2025-02-12'),
(129, 79, 12, '2025-02-12'),
(130, 82, 12, '2025-02-12'),
(132, 86, 12, '2025-02-13'),
(133, 76, 12, '2025-02-14'),
(135, 83, 12, '2025-02-14'),
(136, 77, 16, '2025-02-16'),
(137, 90, 12, '2025-02-16'),
(138, 80, 12, '2025-02-16'),
(139, 94, 12, '2025-02-16'),
(140, 93, 12, '2025-02-16'),
(141, 96, 16, '2025-02-16'),
(142, 86, 16, '2025-02-16');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `namalengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `role` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `namalengkap`, `alamat`, `role`) VALUES
(12, 'jomar', 'caf1a3dfb505ffed0d024130f58c5cfa', 'jomar@gmail.com', 'jomardoan', 'jkt', 'user'),
(16, 'fya', '698d51a19d8a121ce581499d7b701668', 'fya@gmail.com', 'flavia', 'jkt', 'user'),
(17, 'pey', '698d51a19d8a121ce581499d7b701668', 'pey@gmail.com', 'peyva', 'jakarta', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`albumid`),
  ADD KEY `iduser` (`userid`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`fotoid`),
  ADD KEY `albumid` (`albumid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD PRIMARY KEY (`komentarid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`likeid`),
  ADD KEY `fotoid` (`fotoid`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `albumid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `fotoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  MODIFY `komentarid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `likeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`albumid`) REFERENCES `album` (`albumid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentarfoto`
--
ALTER TABLE `komentarfoto`
  ADD CONSTRAINT `komentarfoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentarfoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD CONSTRAINT `likefoto_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likefoto_ibfk_2` FOREIGN KEY (`fotoid`) REFERENCES `foto` (`fotoid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
