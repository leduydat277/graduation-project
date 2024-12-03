
import MainLayout from '@/Layouts/MainLayout';
import React, { useState } from 'react';
import { Box, Typography, List, ListItem, ListItemText } from '@mui/material';
import { Footer } from '@/components/Footer/Footer';




function PolicyPage() {


  return (
    <>
      <Box sx={{ padding: 3 }}>
        <Typography variant="h4" align="center" gutterBottom>
          CHÍNH SÁCH KHÁCH SẠN
        </Typography>

        {/* <Box sx={{ display: 'flex', justifyContent: 'center', gap: 2, mb: 4 }}>
          <Typography variant="body1" color="textSecondary">VỀ CHÚNG TÔI</Typography>
          <Typography variant="body1" color="textPrimary">CHÍNH SÁCH KHÁCH SẠN</Typography>
          <Typography variant="body1" color="textSecondary">VỊ TRÍ KHÁCH SẠN</Typography>
        </Box> */}

        <Box sx={{ width: '60%', margin: 'auto' }}>
          <Typography variant="h6" gutterBottom>Giờ nhận phòng: 14:00</Typography>
          <Typography variant="h6" gutterBottom>Giờ trả phòng: 12:00</Typography>

          <Typography variant="h6" gutterBottom>Chính sách Nhận – Trả phòng sớm và muộn:</Typography>
          <List>

            <ListItemText primary="Nhận phòng sớm:" secondary="Trước 6:00: 100% tiền phòng. Sau 6:00: 50% tiền phòng (không bao gồm ăn sáng)." />


            <ListItemText primary="Trả phòng muộn:" secondary="Trước 18:00: 50% tiền phòng. Sau 18:00: 100% tiền phòng." />

          </List>

          <Typography variant="h6" gutterBottom>Chính sách ăn sáng trẻ em và phí kê giường phụ:</Typography>
          <List>

            <ListItemText primary="Dưới 5 tuổi" secondary="Miễn phí ăn sáng, ngủ chung." />


            <ListItemText primary="Từ 6-11 tuổi" secondary="VND 300,000/ trẻ/ phòng/ đêm." />


            <ListItemText primary="Trên 12 tuổi" secondary="Tính như người lớn: VND 400,000/ phòng/ đêm." />


            <ListItemText primary="Phí kê giường phụ" secondary="VND 800,000/ khách (áp dụng với người lớn hoặc trẻ em từ 12 tuổi trở lên)." />

          </List>

          <Typography variant="h6" gutterBottom>Chính sách hủy phòng:</Typography>
          <Typography variant="body1" paragraph>
            Tất cả các yêu cầu đặt/hủy phòng phải được gửi bằng văn bản, fax hoặc thư điện tử và được khách sạn xác nhận.
            Sau khi nhận được xác nhận đặt phòng từ phía khách sạn, khách hàng thanh toán toàn bộ chi phí đặt phòng.
            Đặt phòng không hoàn lại tiền phải thanh toán toàn bộ chi phí và chỉ được nhận email xác nhận đặt phòng.
          </Typography>

          <Typography variant="h6" gutterBottom>Chính sách đổi phòng, đổi ngày nhận trả phòng:</Typography>
          <Typography variant="body1" paragraph>
            Trong trường hợp Quý khách hàng muốn thay đổi ngày nhận/trả phòng, hoặc thay đổi hạng phòng, loại phòng, vui lòng liên hệ với bộ phận đặt phòng của chúng tôi để được hỗ trợ.
          </Typography>

          <Typography variant="h6" gutterBottom>Chính sách hoàn tiền (bao gồm thời hạn hoàn trả, phương thức trả):</Typography>
          <Typography variant="body1" paragraph>
            Trong trường hợp Khách hàng đã thanh toàn tiền cọc, thanh toán đầy đủ tiền đặt phòng, nhưng do điều kiện khách quan nên hủy chuyến đi của mình, chúng tôi sẽ xem xét hoàn lại số tiền cho Khách hàng. Việc hoàn tiền sẽ dựa vào quy định của mỗi đơn đặt phòng khác nhau và việc hoàn tiền này sẽ được nhân viên của chúng tôi thông báo chính thức cho Khách hàng qua email.
            <ListItemText secondary="- Thời gian bồi hoàn là trong vòng 21-30 ngày làm việc tuỳ vào ngân hàng." />
            <ListItemText secondary="- Hình thức bồi hoàn: bồi hoàn tài khoản ngân hàng đã được cung cấp hoặc thẻ đã thu tiền." />
            <ListItemText secondary="- Chi phí bồi hoàn: miễn phí." />
            <Typography> Lưu ý:
              Chúng tôi có quyền thay đổi điều kiện, hủy bỏ chính sách bất cứ lúc nào không cần thông báo trước.
              Chúng tôi không chịu trách nhiệm bồi thường thiệt hại, thay đổi ngày, loại phòng… gián tiếp, ngẫu nhiên hay do hậu quả phát sinh hoặc trong trường hợp bất khả kháng (thiên tai, chiến tranh…).</Typography>
          </Typography>

          <Typography variant="h6" gutterBottom>Trường hợp bất khả kháng:</Typography>
          <Typography variant="body1" paragraph>
            Trong các trường hợp bất khả kháng (có nghĩa là bất kỳ hoàn cảnh khách quan nào không lường trước được và không thể tránh khỏi, bao gồm nhưng không giới hạn như các cuộc đình công, rối loạn dân sự, chiến tranh, hoả hoạn, lũ lụt, các trường hợp khẩn cấp khác hoặc bất kỳ sự chậm trễ nào trong việc sửa chữa cần thiết và thiết yếu của khách sạn…) khiến cho khách sạn không thể thực hiện nghĩa vụ được nêu, khách sạn sẽ không chịu trách nhiệm về bất kỳ sự tổn thất, thiệt hại, chi phí, khiếu nại, …. vượt ngoài tầm kiểm soát của chúng tôi.
          </Typography>

          <Typography variant="h6" gutterBottom>Nghĩa vụ của người bán và nghĩa vụ của Khách hàng trong mỗi giao dịch:</Typography>
          <Typography >Nghĩa vụ bên cung cấp dịch vụ:
            <ListItemText secondary="- Cung cấp sản phẩm đúng chất lượng, đúng thời hạn và địa điểm mà Quý khách hàng đã đăng ký." />
            <ListItemText secondary="-  Bảo mật thông tin của người sử dụng địch vụ theo chính sách bảo mật." />
          </Typography>
          <Typography >Nghĩa vụ người sử dụng dịch vụ:
            <ListItemText secondary="- Nghĩa vụ thanh toán tiền và nhận phòng theo thỏa thuận." />
            <ListItemText secondary="- Nếu chúng tôi yêu cầu bạn cung cấp bằng chứng về giấy tờ tùy thân, vui lòng cung cấp trong vòng 30 ngày." />
            <ListItemText secondary="- Bạn chịu trách nhiệm giữ thông tin đăng nhập của mình được an toàn và bảo mật." />
          </Typography>
          <Typography >Chính sách kiểm tra thông tin đặt phòng:
            <ListItemText secondary="- Khi Quý khách đặt phòng online, công ty chúng tôi sẽ gửi thông tin đặt phòng cho khách hàng qua email, Khách hàng có thể kiểm tra thông tin và có thể liên hệ qua Hotline: 84 214 356 6666 trong trường hợp có thắc mắc gì, bộ phận chăm sóc khách hàng của chúng tôi sẽ hỗ trợ Quý khách. Xin chân thành cảm ơn." />
          </Typography>
          <Typography >Hình thức thanh toán:
            <ListItemText secondary="1. Thanh toán qua chuyển khoản ngân hàng: Tên tài khoản: Khách sạn Sleep, Số tài khoản: 0363691084 " />
            <ListItemText secondary="2. Thanh toán bằng tiền mặt hoặc quẹt thẻ tín dụng tại máy POS ở quầy Lễ tân khách sạn." />
          </Typography>
        </Box>

        {/* Add more sections here following similar pattern as above */}
      </Box>
      <Footer />
    </>

  );
}

PolicyPage.layout = (page: React.ReactNode) => (
  <MainLayout title="Policy" children={page} />
);

export default PolicyPage;