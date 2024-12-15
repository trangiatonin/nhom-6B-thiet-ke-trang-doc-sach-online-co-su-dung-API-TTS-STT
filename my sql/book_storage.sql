-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2024 at 04:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `book_storage`
--

-- --------------------------------------------------------

--
-- Table structure for table `abook`
--
use book_storage;
CREATE TABLE `abook` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_img` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `abook`
--

INSERT INTO `abook` (`book_id`, `book_title`, `book_img`, `book_author`, `book_quantity`, `price`, `description`) VALUES
(1, 'BCD', 'https://via.placeholder.com/227x328', 'Nin', 60, 1000, NULL),
(2, 'EFG', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(3, 'LMN', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(4, 'PQRS', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(5, 'PDD', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(6, 'PFF', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(7, 'AAA', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(8, 'PQRS', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(9, 'PDD', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(10, 'PFF', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(11, 'AAA', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL),
(12, 'AAA', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49291.jpg?v=1&w=350&h=510', 'Nin', 60, 1000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ebook`
--

CREATE TABLE `ebook` (
  `book_id` int(11) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `book_img` varchar(255) NOT NULL,
  `book_author` varchar(255) NOT NULL,
  `book_quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(60) DEFAULT NULL,
  `publisher` varchar(60) DEFAULT NULL,
  `book_update` date DEFAULT NULL,
  `content` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ebook`
--

INSERT INTO `ebook` (`book_id`, `book_title`, `book_img`, `book_author`, `book_quantity`, `price`, `description`, `category`, `publisher`, `book_update`, `content`) VALUES
(1, 'Đập nồi bán sắt đi học', 'https://307a0e78.vws.vegacdn.vn/view/v2/image/img.book/0/0/1/49435.jpg?v=1&w=480&h=700', 'Hồng Thứ Bắc', 0, 20000, 'Trong giai đoạn huấn luyện chuẩn bị cho một giải đấu nào đó, cánh truyền thông lần lượt đến phỏng vấn chiến sĩ của các trường. Chương trình được phát sóng trực tiếp trên tinh võng nên khán giả có thể thấy được toàn cảnh tất cả mọi người đang ra sức huấn luyện, tăng cường trọng lực, đánh giáp lá cà, đánh gần rồi cả đánh tầm xa...', 'Truyện ngắn', 'Đang cập nhật', '2024-11-11', 'Trong tòa nhà cũ nát, âm u và hôi hám. Không khí ẩm ướt, mốc meo. Thỉnh thoảng có chuột, rắn chạy xung quanh. Nếu nhìn kĩ sẽ thấy một đứa trẻ đang nằm trong góc.   Không gian cực kỳ yên tĩnh.  Trên người VỆ TAM được che phủ bởi một tấm chăn cũ nát, xi măng trên trần nhà rớt thành từng mảng, thanh sắt lộ ra ngòai. Cảm giác có thể sụp xuống bất cứ lúc nào. '),
(27, 'Lão Hạc', 'https://bizweb.dktcdn.net/100/370/339/products/z4529778288710-9a538b8bcac451561af81cd240d963a1.jpg?v=1689758099500', 'Nam Cao', 0, 2000, ' Lão Hạc là một người nông dân nghèo, sống cùng một con chó gọi là cậu Vàng. Lão có một người con trai nhưng vì nghèo không có tiền lấy vợ nên đã bỏ đi làm đồn điền cao su. Một mình lão phải tự lo liệu mưu sinh.', 'Truyện ngắn', 'Đang cập nhật', '2024-11-11', 'Lão Hạc thổi cái mồi rơm, châm đóm. Tôi đã thông điếu và bỏ thuốc rồi. Tôi mời lão hút trước. Nhưng lão không nghe...- Ông giáo hút trước đi.  Lão đưa đóm cho tôi...  - Tôi xin cụ...  Và tôi cầm lấy đóm, vo viên một điếu. Tôi rít một hơi xong, thông điếu rồi mới đặt vào lòng lão. Lão bỏ thuốc, nhưng chưa hút vội. Lão cầm lấy đóm, gạt tàn, và bảo:  - Có lẽ tôi bán con chó đấy, ông giáo ạ!  Lão đặt xe điếu, hút. Tôi vừa thở khói, vừa gà gà đôi mắt của người say, nhìn lão, nhìn để làm ra vẻ chú ý đến câu nói của lão đó thôi. Thật ra thì trong lòng tôi rất dửng dưng. Tôi nghe câu ấy đã nhàm rồi. Tôi lại biết rằng: lão nói là nói để có đấy thôi; chẳng bao giờ lão bán đâu. Vả lại, có bán thật nữa thì đã sao? Làm quái gì một con chó mà lão có vẻ băn khoăn quá thế... '),
(28, 'Làng', 'https://isach.info/images/story/cover/lang__kim_lan.jpg', 'Kim Lân', 0, 20000, ' Ông Hai là một người nông dân sống ở làng Chợ Dầu, do chiến tranh nên ông phải đi tản cư. Ở nơi tản cư, ông luôn tự hào về cái làng của mình và mang nó khoe với mọi người. Khi tin làng Chợ Dầu theo giặc, ông sững sờ, cổ ông nghẹn ắng lại, da mặt tê rân rân, xấu hổ tới mức cứ cúi gằm mặt xuống mà đi.', 'Truyện ngắn', 'Đang cập nhật', '2024-11-11', 'Ở nơi tản cư, đang vui với tin chiến thắng của ta, bất chợt ông Hai nghe tin dữ về làng Chợ Dầu Việt gian theo Tây. Ông cụt hứng, đau khổ, xấu hổ. Ông buồn chán và lo sợ suốt mấy ngày chẳng dám đi đâu, càng bế tắc hơn khi mụ chủ nhà đánh tiếng đuổi gia đình ông đi không cho ở nhờ vì là người của làng Việt gian. Ông chỉ biết trút bầu tâm sự cùng đứa con trai bé nhỏ như nói với chính lòng mình: theo kháng chiến, theo Cụ Hồ chứ không theo giặc, còn làng theo giặc thì phải thù làng.'),
(29, 'Ai đã đặt tên cho dòng sông', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFXgNxJj342wDXV7BLPSsrxMS0UfUOUZQNeA&s', 'Hoàng Phủ Ngọc Tường', 0, 222222, '/“Ai đã đặt tên cho dòng sông/” được viết tại Huế vào tháng 1 năm 1981 ngay sau chiến thắng mùa Xuân 1975, trong tác giả vẫn còn bừng bừng khí thế chống ngoại xâm và cảm hứng ngợi ca chủ nghĩa anh hùng. Đây là một trong những tác phẩm tiêu biểu cho thành công của Hoàng Phủ Ngọc Tường ở thể loại ký và tùy bút.', 'Truyện ngắn', 'Đang cập nhật', '2024-11-11', 'Xuân hạ thu đông tôi vẫn thường lên thăm vườn An Hiên của bà Tùng ở KimLong. Khu vườn xưa cổ sầm uất, mùa nào cũng có những loài hoa đang nở, nhữngtrái cây đang chín, nhưng luôn luôn toả sáng thần thái yên tĩnh và khoáng đạt, giốngnhư một tự do nội tâm. Ngày xưa Nguyễn Du đã sống rất lâu ở vùng này, và bây giờ,trước sân nhà bà Tùng vẫn toả bóng một cây hồng cổ, giống hồng Tiên Điền nổi tiếngmà chính cụ Nghè Mai, cháu nội cụ Nguyễn Du đã tặng cho gia đình bà. Mùa thu tôingồi đọc Kiều dưới mái rêu phong của chiếc cổng vòm quay mặt ra sông ăn nhữngtrái hồng ngọt và thanh đến độ tưởng như mỗi miếng vừa ngậm vào nửa chừng đã tanthành dư vang của một tiếng chim.'),
(33, 'Ai đã đặt tên cho dòng sông', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRFXgNxJj342wDXV7BLPSsrxMS0UfUOUZQNeA&s', 'Hoàng Phủ Ngọc Tường', 0, 0, '/“Ai đã đặt tên cho dòng sông/” được viết tại Huế vào tháng 1 năm 1981 ngay sau chiến thắng mùa Xuân 1975, trong tác giả vẫn còn bừng bừng khí thế chống ngoại xâm và cảm hứng ngợi ca chủ nghĩa anh hùng. Đây là một trong những tác phẩm tiêu biểu cho thành công của Hoàng Phủ Ngọc Tường ở thể loại ký và tùy bút.', NULL, NULL, '2021-12-12', 'abv');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abook`
--
ALTER TABLE `abook`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `ebook`
--
ALTER TABLE `ebook`
  ADD PRIMARY KEY (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abook`
--
ALTER TABLE `abook`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ebook`
--
ALTER TABLE `ebook`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
