import MainLayout from '@/Layouts/MainLayout';
import '@fontsource/roboto/400.css';
import React from 'react';
import { Box, Typography, Paper, Grid } from '@mui/material';
import { Footer } from '@/components/Footer/Footer';

function AboutPage() {
  return (
    <>
      {/* Video Background Section */}
      <Box
        sx={{
          position: 'relative',
          width: '100%',
          height: '400px',
          overflow: 'hidden'
        }}
      >
        {/* Video as Background */}
        <video
          autoPlay
          loop
          muted
          playsInline
          style={{
            position: 'absolute',
            top: '50%',
            left: '50%',
            width: '100%',
            height: '100%',
            objectFit: 'cover',
            transform: 'translate(-50%, -50%)'
          }}
        >
          <source
            src="https://www.agoda.com/wp-content/uploads/2022/03/agoda-video-banner.mp4"
            type="video/mp4"
          />
          Your browser does not support the video tag.
        </video>

        {/* Title Overlay */}
        <Typography
          variant="h3"
          color="white"
          sx={{
            position: 'absolute',
            top: '50%',
            left: '50%',
            transform: 'translate(-50%, -50%)',
            fontWeight: 'bold',
            textAlign: 'center',
            zIndex: 1,
            
          }}
        >
          Về Sleep Hotel
        </Typography>

        {/* Optional Overlay for Dim Effect */}
        <Box
          sx={{
            position: 'absolute',
            top: 0,
            left: 0,
            width: '100%',
            height: '100%',
            backgroundColor: 'rgba(0, 0, 0, 0.5)',
            zIndex: 0
          }}
        />
      </Box>

      {/* Content Section */}
      <Box sx={{display: 'flex', justifyContent : 'center'}}>
        <Box
          sx={{
            backgroundColor: '#f7f9fa',
            padding: '40px 20px',
          }}
        >
          <Grid container justifyContent="center">
            <Grid item xs={12} md={11}>
              <Paper
                sx={{
                  padding: '20px',
                  backgroundColor: '#fff',
                  borderRadius: '20px',
                  width: '100%', // Đây là để Paper chiếm toàn bộ chiều rộng
                  maxWidth: '80', // Điều chỉnh chiều rộng tối đa của Paper
                  justifyContent: 'center',
                 
                }}
              >
                {/* Tiêu đề phần Sleep Hotel */}
                <Typography variant="h4" fontWeight="bold" gutterBottom>
                  Sleep Hotel - Nơi Nghỉ Dưỡng Thư Giãn và An Yên
                </Typography>

                {/* Phần mô tả Sleep Hotel và ảnh bên cạnh */}
                <Grid container spacing={10}>
                  <Grid item xs={12} md={6}>
                    <img
                      src="https://cdn.britannica.com/96/115096-050-5AFDAF5D/Bellagio-Hotel-Casino-Las-Vegas.jpg"
                      alt="Sleep Hotel"
                      style={{
                        width: '100%', // Đảm bảo ảnh chiếm toàn bộ chiều rộng của phần chứa
                        maxWidth: '100%', // Giới hạn chiều rộng tối đa của ảnh không vượt quá phần chứa
                        borderRadius: '10px',
                        objectFit: 'cover' // Giữ tỷ lệ ảnh mà không làm ảnh bị kéo dãn
                      }}
                    />
                  </Grid>
                  <Grid item xs={12} md={6}>
                    <Typography sx={{ lineHeight: 1.8, fontSize: '20px' }}>
                      Sleep Hotel là một khách sạn cao cấp, mang đến không gian
                      nghỉ ngơi yên tĩnh và tiện nghi hiện đại, lý tưởng cho những
                      ai tìm kiếm sự thư giãn và thoải mái. Với thiết kế tinh tế
                      và dịch vụ chu đáo, Sleep Hotel cam kết mang đến cho khách
                      hàng một trải nghiệm nghỉ dưỡng đáng nhớ. Chúng tôi cung cấp
                      các phòng nghỉ tiện nghi, cùng với các dịch vụ chuyên
                      nghiệp, giúp bạn thư giãn và nạp lại năng lượng. Chúng tôi
                      luôn nỗ lực không ngừng để cải thiện và nâng cao chất lượng
                      dịch vụ, mang đến cho bạn một trải nghiệm không thể quên tại
                      Sleep Hotel.
                    </Typography>
                  </Grid>
                </Grid>

                {/* Tiêu đề phần Phòng nghỉ */}
                <Typography
                  variant="h4"
                  fontWeight="bold"
                  gutterBottom
                  marginTop="30px"
                >
                  Phòng nghỉ
                </Typography>

                {/* Phần mô tả Phòng nghỉ và ảnh bên cạnh */}
                <Grid container spacing={10}>
                  <Grid item xs={12} md={6}>
                    <Typography sx={{ lineHeight: 1.8, fontSize: '20px' }}>
                      Tại Sleep Hotel, các phòng nghỉ được thiết kế để mang lại sự
                      thoải mái tối đa cho khách hàng. Mỗi phòng đều được trang bị
                      nội thất hiện đại, không gian rộng rãi, cùng các tiện nghi
                      cao cấp như giường ngủ êm ái, hệ thống điều hòa không khí,
                      Wi-Fi miễn phí và TV màn hình phẳng. Bạn sẽ cảm thấy như
                      đang ở chính ngôi nhà của mình, với một không gian yên tĩnh
                      và thư giãn.
                    </Typography>
                  </Grid>
                  <Grid item xs={12} md={6}>
                    <img
                      src="https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-1-2000px.jpg"
                      alt="Phòng nghỉ"
                      style={{
                        width: '100%',
                        maxWidth: '100%',
                        borderRadius: '10px',
                        objectFit: 'cover'
                      }}
                    />
                  </Grid>
                </Grid>

                {/* Tiêu đề phần Vị trí */}
                <Typography
                  variant="h4"
                  fontWeight="bold"
                  gutterBottom
                  marginTop="30px"
                >
                  Vị trí
                </Typography>

                {/* Phần mô tả Vị trí và ảnh bên cạnh */}
                <Grid container spacing={10}>
                  <Grid item xs={12} md={6}>
                    <img
                      src="https://du-lich.chudu24.com/f/m/2101/30/khach-san-ha-noi.png"
                      alt="Vị trí"
                      style={{
                        width: '100%',
                        maxWidth: '100%',
                        borderRadius: '10px',
                        objectFit: 'cover'
                      }}
                    />
                  </Grid>
                  <Grid item xs={12} md={6}>
                    <Typography sx={{ lineHeight: 1.8, fontSize: '20px' }}>
                      Khách sạn Sleep Hotel tọa lạc tại vị trí thuận tiện, dễ dàng
                      di chuyển đến các điểm tham quan, trung tâm thương mại và
                      các khu vực nổi bật trong thành phố. Dù bạn đang tìm kiếm
                      một kỳ nghỉ thư giãn hay một chuyến công tác, vị trí của
                      khách sạn sẽ mang đến cho bạn sự thuận tiện và dễ dàng tiếp
                      cận các dịch vụ xung quanh. Với chỉ vài phút đi bộ từ khách
                      sạn, bạn sẽ có cơ hội tham quan các địa danh nổi tiếng, khu
                      mua sắm sầm uất và những nhà hàng, quán cà phê hấp dẫn.
                      Ngoài ra, khách sạn cũng nằm gần các trạm giao thông công
                      cộng, giúp bạn dễ dàng di chuyển đến các khu vực khác trong
                      thành phố hoặc các điểm du lịch xa hơn.
                    </Typography>
                  </Grid>
                </Grid>

                {/* Tiêu đề phần Cam kết chất lượng */}
                <Typography
                  variant="h5"
                  fontWeight="bold"
                  gutterBottom
                  marginTop="30px"
                >
                  Cam kết chất lượng
                </Typography>

                {/* Phần mô tả Cam kết chất lượng */}
                <Grid
                  container
                  spacing={2}
                  justifyContent="center"
                  alignItems="center"
                >
                  <Grid item xs={12} md={12}>
                    <Typography
                      sx={{
                        lineHeight: 1.8,
                        fontSize: '1.2rem',
                        marginTop: '20px'
                      }}
                    >
                      Sleep Hotel cam kết mang đến cho khách hàng những dịch vụ
                      chất lượng nhất. Chúng tôi luôn lắng nghe và phục vụ nhu cầu
                      của bạn, đảm bảo rằng mọi trải nghiệm tại khách sạn đều đạt
                      tiêu chuẩn cao nhất.
                    </Typography>

                    {/* Các ý nổi bật */}
                    <Box sx={{ marginTop: '20px' }}>
                      <Typography
                        sx={{
                          fontWeight: 'bold',
                          fontSize: '1.1rem',
                          marginBottom: '10px'
                        }}
                      >
                        ✔ Đội ngũ nhân viên chuyên nghiệp và tận tâm
                      </Typography>
                      <Typography
                        sx={{
                          fontWeight: 'bold',
                          fontSize: '1.1rem',
                          marginBottom: '10px'
                        }}
                      >
                        ✔ Dịch vụ hoàn hảo với tiêu chuẩn cao
                      </Typography>
                      <Typography
                        sx={{
                          fontWeight: 'bold',
                          fontSize: '1.1rem',
                          marginBottom: '10px'
                        }}
                      >
                        ✔ Cam kết mang đến trải nghiệm nghỉ dưỡng tuyệt vời
                      </Typography>

                      {/* Thêm các cam kết mới */}
                      <Typography
                        sx={{
                          fontWeight: 'bold',
                          fontSize: '1.1rem',
                          marginBottom: '10px'
                        }}
                      >
                        ✔ Cung cấp các phòng nghỉ hiện đại, sạch sẽ và tiện nghi
                      </Typography>
                      <Typography
                        sx={{
                          fontWeight: 'bold',
                          fontSize: '1.1rem',
                          marginBottom: '10px'
                        }}
                      >
                        ✔ Hỗ trợ khách hàng 24/7 với dịch vụ chăm sóc khách hàng
                        tận tâm
                      </Typography>
                      <Typography
                        sx={{
                          fontWeight: 'bold',
                          fontSize: '1.1rem',
                          marginBottom: '10px'
                        }}
                      >
                        ✔ Môi trường yên tĩnh, không gian thư giãn, giúp tái tạo
                        năng lượng
                      </Typography>
                      <Typography
                        sx={{
                          fontWeight: 'bold',
                          fontSize: '1.1rem',
                          marginBottom: '10px'
                        }}
                      >
                        ✔ Đảm bảo an ninh và an toàn tuyệt đối cho khách hàng
                        trong suốt thời gian lưu trú
                      </Typography>
                      <Typography
                        sx={{
                          fontWeight: 'bold',
                          fontSize: '1.1rem',
                          marginBottom: '10px'
                        }}
                      >
                        ✔ Sử dụng nguyên liệu sạch, chất lượng cho tất cả dịch vụ
                        ẩm thực
                      </Typography>
                    </Box>
                  </Grid>
                </Grid>
              </Paper>
            </Grid>
          </Grid>
        </Box>
      </Box>

      {/* Footer Section */}
      <Footer />
    </>
  );
}

AboutPage.layout = (page: React.ReactNode) => (
  <MainLayout title="Về Agoda" children={page} />
);

export default AboutPage;
