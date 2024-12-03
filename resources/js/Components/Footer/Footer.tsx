

import React from 'react';
import { Box, Grid, Typography, IconButton, Link } from '@mui/material';
import FacebookIcon from '@mui/icons-material/Facebook';
import AccountBalanceWalletIcon from '@mui/icons-material/AccountBalanceWallet';
import AddCardIcon from '@mui/icons-material/AddCard';
import GoogleIcon from '@mui/icons-material/Google';
export const Footer = () => {
  return (
    <Box sx={{ bgcolor: '#092533', color: '#E5E5E5', padding: '2rem 0' }}>
      <Grid container spacing={2} justifyContent="center">
        <Grid item xs={12} md={8} display="flex" justifyContent="center" gap={2}>
          {['Sang Trọng', 'Chính Sách Hợp Lý', 'Bảo Mật An Toàn', 'Tiện Nghi Đủ Đầy', 'Vị Trí Khách Sạn Thuận Lợi', 'Lễ Tân chuyên nghiệp'].map((item) => (
            <Typography key={item} variant="body2" component="a" href="#" sx={{ textDecoration: 'none', color: '#E5E5E5' }}>
              {item}
            </Typography>
          ))}
        </Grid>
        <Grid item xs={12} md={8} display="flex" flexDirection="column" alignItems="center" textAlign="center" my={2}>
          
          <Typography variant="body2">Địa chỉ: Số 29, tổ 5, đường Thác Bạc, Phường Sapa, Thị xã Sapa, tỉnh Lào Cai, Việt Nam</Typography>
          <Typography variant="body2">VPKD: P409, Tòa nhà Savina, Số 1 Đinh Lễ, Quận Hoàn Kiếm, Hà Nội</Typography>
          <Typography variant="body2">ĐKKD số 5300200993-001 do Sở KHĐT Lào Cai cấp ngày 24/09/2018 & Sửa đổi lần 4 ngày 05/04/2023</Typography>
          <Typography variant="body2">Điện thoại: 0214 356 6666 | Hotline: 0868 588 364 | Email: rsv@pistachiohotel.com</Typography>
        </Grid>
        <Grid item xs={12} md={8} display="flex" justifyContent="center" alignItems="center" gap={2}>
          <Box>
            <Typography variant="body2" align="center">Tìm chúng tôi trên</Typography>
            <Box display="flex" gap={1} justifyContent="center">
              <FacebookIcon></FacebookIcon>
            </Box>
          </Box>
          <Box display="flex" flexDirection="column" alignItems="center">
      
            <Typography variant="body2" align="center">Xếp hạng trên Google</Typography>
            <GoogleIcon></GoogleIcon>
            
          </Box>
          <Box>
            <Typography variant="body2" align="center">Các hình thức được chấp nhận</Typography>
            <Box display="flex" gap={1} justifyContent="center">
            <AccountBalanceWalletIcon></AccountBalanceWalletIcon> 
            <AddCardIcon></AddCardIcon>
            </Box>
          </Box>
        </Grid>
        <Grid item xs={12} textAlign="center" mt={2}>
          <Typography variant="body2">© Bản quyền 2020 - 2025 bởi Sleep Hotel</Typography>
        </Grid>
      </Grid>
    </Box>
  );
};
