import { Box, Typography, Link, Button } from '@mui/material';
import { useState } from 'react';
export const Footer = ({}) => {
    const [showMore, setShowMore] = useState(false);

  // Array for default links
  const defaultLinks = [
    'Khách sạn Hà Nội',
    'Khách sạn Huế',
    'Khách sạn Hội An',
    'Khách sạn Mũi Né',
    'Khách sạn Sapa',
    'Khách sạn Nha Trang',
  ];

  // Array for additional links to be shown when "Show More" is clicked
  const additionalLinks = [
    'Khách sạn Quy Nhơn',
    'Khách sạn Hạ Long',
    'Khách sạn Phan Thiết',
    'Khách sạn Đảo Cát Bà',
    'Khách sạn Ninh Bình',
    'Khách sạn Côn Đảo',
    'Khách sạn Đà Nẵng',
    'Khách sạn Long Hải',
  ];

  // Toggle "Show More" state
  const handleShowMore = () => {
    setShowMore((prevShowMore:any) => !prevShowMore);
  };
  return (
    <>
    <Box
      sx={{
        fontFamily: 'Arial, sans-serif',
        color: 'black',
        // backgroundColor: '#f8f8f8',
        padding: '20px',
        '.footerSection': {
          display: 'flex',
          flexWrap: 'wrap',
          gap: '15px',
          'a': {
            color: '',
            textDecoration: 'none',
            margin: '5px 0',
          },
          '.showMore': {
            fontWeight: 'bold',
            cursor: 'pointer', // Ensures the pointer cursor appears on hover
          },
        },
        '.footerLinks': {
          display: 'flex',
          justifyContent: 'space-between',
          paddingTop: '20px',
          borderTop: '1px solid #ddd',
          marginTop: '20px',
          '.footerColumn': {
            flex: 1,
            minWidth: '150px',
            'h6': {
              fontWeight: 'bold',
              marginBottom: '10px',
            },
            'a': {
              display: 'block',
              color: 'black',
              textDecoration: 'none',
              margin: '5px 0',
              '&:hover': {
                textDecoration: 'underline',
              },
            },
          },
        },
        '.footerBottom': {
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
          paddingTop: '20px',
          borderTop: '1px solid #ddd',
          marginTop: '20px',
          'p': {
            margin: 0,
          },
          '.footerLogos img': {
            width: '50px',
            marginLeft: '10px',
          },
        },
        '.footerCopy': {
          textAlign: 'center',
          color: '#fff',
          backgroundColor: '#3b4cca',
          padding: '10px',
          marginTop: '20px',
        },
      }}
    >
      {/* Main Footer Content */}
      <Box sx={{fontSize: "25px", marginBottom:'20px'}}>
        Phổ biến với du khách từ Việt Nam
      </Box>
      {/* Display main and additional links based on showMore state */}
      <Box className="footerSection">
        {defaultLinks.map((link, index) => (
          <Link key={index} href="#">{link}</Link>
        ))}
        {showMore && additionalLinks.map((link, index) => (
          <Link key={index + defaultLinks.length} href="#">{link}</Link>
        ))}
        <Link className="showMore" onClick={handleShowMore}>
          {showMore ? '- Ẩn bớt' : '+ Hiển thị thêm'}
        </Link>
      </Box>

      <Box className="footerLinks">
        <Box className="footerColumn">
          <Typography variant="h6">Hỗ trợ</Typography>
          <Link href="#">Các câu hỏi thường gặp về virus corona (COVID-19)</Link>
          <Link href="#">Quản lí các chuyến đi của bạn</Link>
          <Link href="#">Liên hệ Dịch vụ Khách hàng</Link>
          <Link href="#">Trung tâm thông tin bảo mật</Link>
        </Box>
        <Box className="footerColumn">
          <Typography variant="h6">Khám phá thêm</Typography>
          <Link href="#">Chương trình khách hàng thân thiết Genius</Link>
          <Link href="#">Ưu đãi theo mùa và dịp lễ</Link>
          <Link href="#">Bài viết về du lịch</Link>
          <Link href="#">Booking.com dành cho Doanh Nghiệp</Link>
        </Box>
        <Box className="footerColumn">
          <Typography variant="h6">Điều khoản và cài đặt</Typography>
          <Link href="#">Bảo mật & Cookie</Link>
          <Link href="#">Điều khoản và điều kiện</Link>
          <Link href="#">Tranh chấp đối tác</Link>
        </Box>
        <Box className="footerColumn">
          <Typography variant="h6">Dành cho đối tác</Typography>
          <Link href="#">Đăng nhập vào trang Extranet</Link>
          <Link href="#">Trợ giúp đối tác</Link>
        </Box>
        <Box className="footerColumn">
          <Typography variant="h6">Về chúng tôi</Typography>
          <Link href="#">Về Booking.com</Link>
          <Link href="#">Chúng tôi hoạt động như thế nào</Link>
          <Link href="#">Truyền thông</Link>
        </Box>
      </Box>

      {/* Additional Section Similar to Image */}
      <Box
        sx={{
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
        
          backgroundColor: '#fff',
          borderTop: '1px solid #ddd',
          marginTop: '20px',
        }}
      >
        <Box>
          <Typography variant="h6" sx={{ color: '#3366cc', fontWeight: 'bold' }}>LankaStay.</Typography>
          <Typography variant="body2" sx={{ color: '#666' }}>
            We kaboom your beauty holiday <br /> instantly and memorable.
          </Typography>
        </Box>
        <Box textAlign="right">
          <Typography variant="body1" sx={{ fontWeight: 'bold', color: '#333' }}>Become hotel Owner</Typography>
          <Button variant="contained" color="primary">Register Now</Button>
        </Box>
      </Box>
    </Box>
    </>
  );
};

