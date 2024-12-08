import MainLayout from '@/Layouts/MainLayout';
import '@fontsource/roboto/400.css';
import React, { useState, useEffect } from 'react';
import {
  Box,
  Typography,
  Table,
  TableHead,
  TableBody,
  TableRow,
  TableCell
} from '@mui/material';
import axios from 'axios'; // Import axios
import { Footer } from '@/components/Footer/Footer';

function PolicyPage() {
  const [policyData, setPolicyData] = useState<any>(null);
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string>('');

  useEffect(() => {
    axios
      .get('http://127.0.0.1:8000/api/policy')
      .then(response => {
        const data = JSON.parse(response.data.data[0].value);
        setPolicyData(data.chinh_sach); // Lưu chính sách vào state
        setLoading(false);
      })
      .catch(error => {
        setError('Error loading policy data');
        setLoading(false);
      });
  }, []);

  if (loading) {
    return (
      <Typography variant="h6" align="center">
        Loading...
      </Typography>
    );
  }

  if (error) {
    return (
      <Typography variant="h6" align="center" color="error">
        {error}
      </Typography>
    );
  }

  return (
    <>
      <Box sx={{ padding: 3 }}>
        <Typography variant="h4" align="center" gutterBottom>
          CHÍNH SÁCH KHÁCH SẠN
        </Typography>
        <Box sx={{ width: '100%', margin: 'auto' }}>
          {/* Kiểm tra sự tồn tại của policyData */}
          {policyData ? (
            <>
              {/* Hiển thị giờ nhận phòng và trả phòng */}
              {policyData.chinh_sach_nguoi_dung
                ?.thoi_gian_check_in_va_check_out && (
                <Box sx={{ marginBottom: 2 }}>
                  <Typography variant="h6" fontWeight="bold" gutterBottom>
                    Giờ nhận phòng và trả phòng:
                  </Typography>
                  <Typography sx={{ lineHeight: 1.8, fontSize: '15px' }}>
                    Tại Sleep Hotel, chúng tôi hiểu rằng việc có thời gian nhận
                    phòng và trả phòng linh hoạt là rất quan trọng đối với sự
                    thoải mái của khách hàng. Vì vậy, chúng tôi cam kết mang đến
                    một quy trình nhận phòng và trả phòng nhanh chóng và thuận
                    tiện.
                    <br />
                    . Nếu bạn có yêu cầu đặc biệt về thời gian nhận hoặc trả
                    phòng, vui lòng liên hệ với lễ tân của chúng tôi để được hỗ
                    trợ.
                    <br />
                    Sleep Hotel luôn cố gắng đảm bảo sự thuận tiện và linh hoạt
                    nhất cho khách hàng, giúp bạn có một kỳ nghỉ trọn vẹn và
                    thoải mái nhất.
                  </Typography>
                  <Table>
                    <TableHead>
                      <TableRow>
                        <TableCell sx={{ fontWeight: 'bold' }}>
                          Giờ nhận phòng
                        </TableCell>
                        <TableCell sx={{ fontWeight: 'bold' }}>
                          Giờ trả phòng
                        </TableCell>
                      </TableRow>
                    </TableHead>
                    <TableBody>
                      <TableRow>
                        <TableCell>
                          {
                            policyData.chinh_sach_nguoi_dung
                              .thoi_gian_check_in_va_check_out.check_in
                          }
                        </TableCell>
                        <TableCell>
                          {
                            policyData.chinh_sach_nguoi_dung
                              .thoi_gian_check_in_va_check_out.check_out
                          }
                        </TableCell>
                      </TableRow>
                    </TableBody>
                  </Table>
                </Box>
              )}

              {/* Hiển thị chính sách đặt cọc */}
              {policyData.chinh_sach_nguoi_dung?.dat_coc && (
                <Box sx={{ marginBottom: 2 }}>
                  <Typography variant="h6" fontWeight="bold" gutterBottom>
                    Chính sách đặt cọc:
                  </Typography>
                  <Typography sx={{ lineHeight: 1.8, fontSize: '15px' }}>
                    Chính sách đặt cọc tại Sleep Hotel giúp đảm bảo an toàn cho
                    khách sạn cũng như sự thoải mái của bạn trong suốt kỳ nghỉ.
                    Chúng tôi yêu cầu một khoản đặt cọc để bảo vệ quyền lợi của
                    khách và tránh trường hợp huỷ phòng vào phút chót.
                    <br />
                    Nếu bạn có thắc mắc về chính sách đặt cọc, vui lòng liên hệ
                    lễ tân để được tư vấn.
                  </Typography>
                  <Table>
                    <TableHead>
                      <TableRow>
                        <TableCell sx={{ fontWeight: 'bold' }}>Yêu cầu đặt cọc</TableCell>
                        <TableCell sx={{ fontWeight: 'bold' }}>Giá trị đặt cọc</TableCell>
                      </TableRow>
                    </TableHead>
                    <TableBody>
                      <TableRow>
                        <TableCell>
                          {policyData.chinh_sach_nguoi_dung.dat_coc.yeu_cau
                            ? 'Có'
                            : 'Không'}
                        </TableCell>
                        <TableCell>
                          {policyData.chinh_sach_nguoi_dung.dat_coc.gia_tri}
                        </TableCell>
                      </TableRow>
                    </TableBody>
                  </Table>
                </Box>
              )}

              {/* Hiển thị chính sách hủy phòng */}
              {policyData.chinh_sach_nguoi_dung?.chinh_sach_huy_phong && (
                <Box sx={{ marginBottom: 2 }}>
                  <Typography variant="h6" fontWeight="bold" gutterBottom>
                    Chính sách hủy phòng:
                  </Typography>
                  <Typography sx={{ lineHeight: 1.8, fontSize: '15px' }}>
                    Chính sách hủy phòng của Sleep Hotel cho phép khách hàng hủy
                    phòng với những điều kiện linh hoạt và rõ ràng. Bạn sẽ nhận
                    được thông báo về các khoản hoàn trả tùy thuộc vào thời gian
                    hủy phòng.
                  </Typography>
                  <Table>
                    <TableHead>
                      <TableRow>
                        <TableCell sx={{ fontWeight: 'bold' }}>Điều kiện hủy</TableCell>
                        <TableCell sx={{ fontWeight: 'bold' }}>Hoàn trả</TableCell>
                      </TableRow>
                    </TableHead>
                    <TableBody>
                      <TableRow>
                        <TableCell>Hủy trong vòng 1 giờ</TableCell>
                        <TableCell>
                          {
                            policyData.chinh_sach_nguoi_dung
                              .chinh_sach_huy_phong.huy_trong_vong_1_gio
                          }
                        </TableCell>
                      </TableRow>
                      <TableRow>
                        <TableCell>Hủy trước 12h ngày check-in</TableCell>
                        <TableCell>
                          {
                            policyData.chinh_sach_nguoi_dung
                              .chinh_sach_huy_phong.huy_truoc_12h_ngay_check_in
                          }
                        </TableCell>
                      </TableRow>
                      <TableRow>
                        <TableCell>Hủy sau 12h ngày check-in</TableCell>
                        <TableCell>
                          {
                            policyData.chinh_sach_nguoi_dung
                              .chinh_sach_huy_phong.huy_sau_12h_ngay_check_in
                          }
                        </TableCell>
                      </TableRow>
                      <TableRow>
                        <TableCell>Không check-in trước 21h</TableCell>
                        <TableCell>
                          {
                            policyData.chinh_sach_nguoi_dung
                              .chinh_sach_huy_phong
                              .khong_check_in_truoc_21h_ngay_check_in.trang_thai
                          }
                        </TableCell>
                      </TableRow>
                      <TableRow>
                        <TableCell>
                          Hoàn tiền khi không check-in trước 21h
                        </TableCell>
                        <TableCell>
                          {
                            policyData.chinh_sach_nguoi_dung
                              .chinh_sach_huy_phong
                              .khong_check_in_truoc_21h_ngay_check_in.hoan_tien
                          }
                        </TableCell>
                      </TableRow>
                    </TableBody>
                  </Table>
                </Box>
              )}

              {/* Hiển thị quy định khác */}
              {policyData.chinh_sach_nguoi_dung?.quy_dinh_khac && (
                <Box sx={{ marginBottom: 2 }}>
                  <Typography variant="h6" fontWeight="bold" gutterBottom>
                    Quy định khác:
                  </Typography>
                  <Typography sx={{ lineHeight: 1.8, fontSize: '15px' }}>
                    Sleep Hotel cam kết mang đến một không gian lưu trú an toàn
                    và tiện nghi. Dưới đây là các quy định quan trọng mà khách
                    hàng cần lưu ý trong suốt kỳ nghỉ tại khách sạn của chúng
                    tôi.
                  </Typography>
                  <Table>
                    <TableHead>
                      <TableRow>
                        <TableCell sx={{ fontWeight: 'bold' }}>Quy định</TableCell>
                        <TableCell sx={{ fontWeight: 'bold' }}>Thông tin</TableCell>
                      </TableRow>
                    </TableHead>
                    <TableBody>
                      <TableRow>
                        <TableCell>Giải quyết tranh chấp</TableCell>
                        <TableCell>
                          {
                            policyData.chinh_sach_nguoi_dung.quy_dinh_khac
                              .giai_quyet_tranh_chap
                          }
                        </TableCell>
                      </TableRow>
                    </TableBody>
                  </Table>
                </Box>
              )}
            </>
          ) : (
            <Typography variant="h6" align="center" color="error">
              No data available
            </Typography>
          )}
        </Box>
      </Box>
      <Footer />
    </>
  );
}

PolicyPage.layout = (page: React.ReactNode) => (
  <MainLayout title="Policy" children={page} />
);

export default PolicyPage;
