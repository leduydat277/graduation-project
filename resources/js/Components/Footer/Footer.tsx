import { Box, Typography, Button } from '@mui/material';
import FacebookIcon from '@mui/icons-material/Facebook';
import TwitterIcon from '@mui/icons-material/Twitter';
import YouTubeIcon from '@mui/icons-material/YouTube';
import XIcon from '@mui/icons-material/X';
export const Footer = () => {
  return (
    <Box
      sx={{
        color: 'black',
        padding: '20px',
      }}
    >
      <Box
        sx={{
          display: 'flex',
          flexWrap: 'wrap',
          gap: '15px',
        }}
      >
        <Box
          sx={{
            flex: 1,
            minWidth: '150px',
          }}
        >
          <Typography variant="h6" sx={{ fontWeight: 'bold' }}>
            Hỗ trợ
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Các câu hỏi thường gặp về virus corona (COVID-19)
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Quản lí các chuyến đi của bạn
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Liên hệ Dịch vụ Khách hàng
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Trung tâm thông tin bảo mật
          </Typography>
        </Box>
        <Box
          sx={{
            flex: 1,
            minWidth: '150px',
          }}
        >
          <Typography variant="h6" sx={{ fontWeight: 'bold' }}>
            Khám phá thêm
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Chương trình khách hàng thân thiết Genius
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Ưu đãi theo mùa và dịp lễ
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Bài viết về du lịch
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Booking.com dành cho Doanh Nghiệp
          </Typography>
        </Box>
        <Box
          sx={{
            flex: 1,
            minWidth: '150px',
          }}
        >
          <Typography variant="h6" sx={{ fontWeight: 'bold' }}>
            Điều khoản và cài đặt
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Bảo mật & Cookie
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Điều khoản và điều kiện
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Tranh chấp đối tác
          </Typography>
        </Box>
        <Box
          sx={{
            flex: 1,
            minWidth: '150px',
          }}
        >
          <Typography variant="h6" sx={{ fontWeight: 'bold' }}>
            Dành cho đối tác
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Đăng nhập vào trang Extranet
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Trợ giúp đối tác
          </Typography>
        </Box>
        <Box
          sx={{
            flex: 1,
            minWidth: '150px',
          }}
        >
          <Typography variant="h6" sx={{ fontWeight: 'bold' }}>
            Về chúng tôi
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Về Booking.com
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Chúng tôi hoạt động như thế nào
          </Typography>
          <Typography component="a" href="#" sx={{ display: 'block', color: 'black', textDecoration: 'none', margin: '5px 0', '&:hover': { textDecoration: 'underline' } }}>
            Truyền thông
          </Typography>
        </Box>
      </Box>
      <Box>
          <FacebookIcon />
          <TwitterIcon />
          <YouTubeIcon />
          <XIcon />
      </Box>
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
          <Typography variant="h6" sx={{ color: '#3366cc', fontWeight: 'bold' }}>
            SleepStay.
          </Typography>
          <Typography variant="body2" sx={{ color: '#666' }}>
            We kaboom your beauty holiday <br /> instantly and memorable.
          </Typography>
        </Box>
        <Box textAlign="right">
          <Typography variant="body1" sx={{ fontWeight: 'bold', color: '#333' }}>
            Become hotel Owner
          </Typography>
          <Button variant="contained" color="primary">
            Register Now
          </Button>
        </Box>
      </Box>
    </Box>
  );
};
