import axios from 'axios';
import { Box, Stack, Typography } from '@mui/material';
import { useBookingStore } from '../../../service/stores/booking-store';
import { useState } from 'react';
import { formatPrice } from '../../../service/hooks/price';
import { Booking, calculateTotalGuest } from '../../../service/hooks/booking';
import { format } from 'date-fns';
import { userStore } from '../../../service/stores/user-store';
import { ArrowRight } from 'lucide-react';
import { Button } from '@/components/ui/button';
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { log } from 'console';

export const DetailConfirm = () => (
  <Stack
    width="85%"
    direction="row"
    height={650}
    justifyContent="center"
    backgroundColor="#f2f2f2"
    pt={4}
    pl={6}
    borderRadius={6}
    sx={{
      boxShadow: '0px 4px 10px rgba(0, 0, 0, 0.2)',
      transition: 'transform 0.3s ease-in-out',
      '&:hover': {
        transform: 'scale(1.02)'
      }
    }}
  >
    <InfoConfirm />
    <InfoBooking />
  </Stack>
);

const DetailRow = ({
  label,
  value
}: {
  label: string;
  value: string | number;
}) => (
  <Stack
    direction="row"
    sx={{
      p: 1,
      borderRadius: 3,
      transition: 'background-color 0.3s ease',
      '&:hover': {
        backgroundColor: '#fafafa'
      }
    }}
  >
    <Typography variant="h5" sx={{ fontWeight: 600, color: '#555' }}>
      {label}:
    </Typography>
    <Typography variant="h5" sx={{ pl: 1, fontWeight: 400, color: '#888' }}>
      {value}
    </Typography>
  </Stack>
);

const InfoBooking = () => {
  const [
    checkInDate,
    checkOutDate,
    totalDays,
    totalPrice,
    numberOfGuests,
    numberOfChildren,
    idRoom
  ] = useBookingStore(state => [
    state.checkInDate,
    state.checkOutDate,
    state.totalDays,
    state.totalPrice,
    state.numberOfGuests,
    state.numberOfChildren,
    state.idRoom
  ]);
  const [voucherCode, setVoucherCode] = useState('');
  const discountPrice = useBookingStore(state => state.discountPrice);
  const setDiscountPrice = useBookingStore(state => state.setDiscountPrice);
  const [voucherApplied, setVoucherApplied] = useState(false);
  const [voucherInfo, setVoucherInfo] = useState(null);

  const guest = calculateTotalGuest(numberOfGuests, numberOfChildren);
  const [userId, address, email, firstName, lastName, phone] = userStore(
    state => [
      state.userId,
      state.address,
      state.email,
      state.firstName,
      state.lastName,
      state.phone
    ]
  );
  const ps: any = [];
  const validate = () => {
    if (
      checkInDate < checkOutDate &&
      checkInDate > Date.now() &&
      checkOutDate > Date.now()
    ) {
      return true;
    }
    return false;
  };
  ps.push(validate());

  const payAll = async () => {
    await Promise.all(ps);
    console.log('onPress');

    // Nếu có mã giảm giá, sử dụng discountPrice, nếu không thì sử dụng totalPrice
    const finalPrice = discountPrice > 0 ? discountPrice : totalPrice;

    const bookingData = {
      user_id: userId,
      check_in_date: checkInDate,
      check_out_date: checkOutDate,
      first_name: firstName,
      last_name: lastName,
      payment_type: 2,
      address: address,
      created_at: Date.now(),
      phone: phone,
      email: email,
      room_id: idRoom,
      total_price: finalPrice // Gửi giá trị tổng tiền sau khi áp dụng mã giảm giá nếu có
    };

    try {
      const booking = await Booking(bookingData);
      console.log('Booking successful', booking.paymentUrl);
      if (booking.paymentUrl) {
        window.location.href = booking.paymentUrl;
      }
    } catch (error) {
      console.error('Booking failed:', error);
    }
  };

  const depositPayment = async () => {
    await Promise.all(ps);
    console.log('onPress');

    const finalPrice = discountPrice > 0 ? discountPrice : totalPrice;

    const bookingData = {
      user_id: userId,
      check_in_date: checkInDate,
      check_out_date: checkOutDate,
      first_name: firstName,
      last_name: lastName,
      payment_type: 1,
      address: address,
      created_at: Date.now(),
      phone: phone,
      email: email,
      room_id: idRoom,
      total_price: finalPrice
    };

    try {
      const booking = await Booking(bookingData);
      console.log('Booking successful', booking.paymentUrl);
      if (booking.paymentUrl) {
        window.location.href = booking.paymentUrl;
      }
    } catch (error) {
      console.error('Booking failed:', error);
    }
  };

  const removeVoucher = () => {
    setVoucherCode(null);
    resetDiscount();
  };

  const resetDiscount = () => {
    setDiscountPrice(0);
  };

  const voucher = async () => {
    console.log('Mã voucher:', voucherCode);

    if (!voucherCode.trim()) {
      toast.error('Vui lòng nhập mã voucher');
      return;
    }

    try {
      const response = await axios.post(
        '/api/voucher',
        {
          voucher: voucherCode
        },
        {
          headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json'
          }
        }
      );

      if (response.data.type === 'success') {
        toast.success('Áp dụng voucher thành công!');
        setVoucherInfo(response.data.voucher);
        setVoucherApplied(true);
        const newTotalPrice = updateTotalPrice(response.data.voucher);
        console.log(newTotalPrice);
        useBookingStore.getState().setDiscountPrice(newTotalPrice);
      } else if (response.data.type === 'error') {
        toast.error(`Áp dụng voucher thất bại: ${response.data.message}`);
      }
    } catch (error) {
      console.error('Lỗi khi áp dụng voucher:', error);
      toast.error('Lỗi không xác định khi áp dụng voucher.');
    }
  };

  const updateTotalPrice = voucher => {
    let newTotalPrice = totalPrice;
    if (voucher.type === '%') {
      newTotalPrice = totalPrice * (voucher.discount_value / 100);
      console.log(newTotalPrice);
    } else if (voucher.type === 'fixed') {
      newTotalPrice = totalPrice - voucher.discount_value;
    }

    return newTotalPrice;
  };

  return (
    <Stack
      width="100%"
      gap={1}
      pr={5}
      backgroundColor="#f2f2f2"
      borderRadius={6}
      sx={{
        p: 3,
        animation: 'fadeIn 0.8s',
        '@keyframes fadeIn': {
          '0%': { opacity: 0 },
          '100%': { opacity: 1 }
        }
      }}
    >
      <ToastContainer position="top-right" autoClose={3000} />
      <Typography
        variant="h3"
        textAlign="center"
        pb={2}
        sx={{ color: '#333', fontWeight: 'bold' }}
      >
        Thông tin đặt phòng
      </Typography>
      <Stack direction="row" justifyContent="space-between">
        <DateInfo label="Check in" date={checkInDate} />
        <ArrowRight />
        <DateInfo label="Check out" date={checkOutDate} />
      </Stack>
      <DetailRow label="Tổng số ngày" value={totalDays} />
      <DetailRow
        label="Tổng giá"
        value={
          voucherApplied ? formatPrice(discountPrice) : formatPrice(totalPrice)
        }
      />
      <DetailRow label="Tổng số người" value={guest} />
      <DetailRow label="Tên khách hàng" value={lastName} />
      <DetailRow label="Số điện thoại" value={phone} />
      {!voucherApplied ? (
        <Stack direction="row" gap={2} alignItems="center" pt={2}>
          <input
            type="text"
            value={voucherCode}
            onChange={e => setVoucherCode(e.target.value)}
            placeholder="Nhập mã voucher"
            style={{
              padding: '8px',
              borderRadius: '4px',
              border: '1px solid #ccc',
              flex: 1
            }}
          />
          <Button variant="outline" onClick={voucher}>
            Nhập
          </Button>
        </Stack>
      ) : (
        <Stack
          direction="column"
          gap={2}
          alignItems="flex-start"
          pt={2}
          sx={{
            padding: '16px',
            borderRadius: '8px',
            backgroundColor: '#f9f9f9',
            boxShadow: '0px 4px 8px rgba(0, 0, 0, 0.1)'
          }}
        >
          <Typography
            variant="h5"
            sx={{ fontWeight: 600, color: '#333', textAlign: 'center' }}
          >
            Voucher đã áp dụng
          </Typography>

          <Box
            sx={{
              width: '100%',
              border: '1px solid #ccc',
              borderRadius: '8px',
              padding: '16px',
              backgroundColor: '#fff',
              boxShadow: '0px 2px 4px rgba(0, 0, 0, 0.1)'
            }}
          >
            <Stack direction="column" spacing={2}>
              <Stack direction="row" justifyContent="space-between">
                <Typography
                  variant="body1"
                  sx={{ fontWeight: 500, color: '#555' }}
                >
                  Tên Voucher:
                </Typography>
                <Typography
                  variant="body1"
                  sx={{ fontWeight: 400, color: '#888' }}
                >
                  {voucherInfo ? voucherInfo.name : 'N/A'}
                </Typography>
              </Stack>

              <Stack direction="row" justifyContent="space-between">
                <Typography
                  variant="body1"
                  sx={{ fontWeight: 500, color: '#555' }}
                >
                  Loại Voucher:
                </Typography>
                <Typography
                  variant="body1"
                  sx={{ fontWeight: 400, color: '#888' }}
                >
                  {voucherInfo ? voucherInfo.type : 'N/A'}
                </Typography>
              </Stack>

              <Stack direction="row" justifyContent="space-between">
                <Typography
                  variant="body1"
                  sx={{ fontWeight: 500, color: '#555' }}
                >
                  Giá trị giảm giá:
                </Typography>
                <Typography
                  variant="body1"
                  sx={{ fontWeight: 400, color: '#888' }}
                >
                  {voucherInfo ? voucherInfo.discount_value : 'N/A'}
                </Typography>
              </Stack>

              <Button
                variant="outline"
                onClick={() => {
                  // Reset thông tin voucher và giá trị discountPrice
                  setVoucherApplied(false);
                  setVoucherCode(''); // Xóa mã voucher nhập vào
                  setVoucherInfo(null); // Xóa thông tin voucher
                  resetDiscount(); // Reset giá trị discountPrice
                }}
                sx={{ marginTop: '16px' }}
              >
                Hủy Voucher
              </Button>
            </Stack>
          </Box>
        </Stack>
      )}

      <Stack gap={2}>
        <Button variant="outline" onClick={depositPayment}>
          Thanh toán cọc (20%)
        </Button>
        <Button variant="outline" onClick={payAll}>
          Thanh toán tất cả
        </Button>
      </Stack>
    </Stack>
  );
};

const InfoConfirm = () => {
  const [price, subtitle, type] = useBookingStore(state => [
    state.price,
    state.subtitle,
    state.type
  ]);

  return (
    <Stack
      width="100%"
      gap={1}
      backgroundColor="#f2f2f2"
      borderRadius={6}
      sx={{
        p: 3,
        animation: 'fadeIn 0.8s',
        '@keyframes fadeIn': {
          '0%': { opacity: 0 },
          '100%': { opacity: 1 }
        }
      }}
    >
      <Typography
        variant="h3"
        textAlign="center"
        pb={2}
        sx={{ color: '#333', fontWeight: 'bold' }}
      >
        Thông tin phòng
      </Typography>
      <DetailRow label="Phòng" value={subtitle} />
      <DetailRow label="Loại phòng" value={type} />
      <DetailRow label="Giá phòng" value={formatPrice(price)} />
      <DetailRow label="Thông tin Phòng" value="101" />
    </Stack>
  );
};

const DateInfo = ({ label, date }: { label: string; date: Date }) => (
  <Stack direction="column">
    <Typography
      variant="h5"
      textAlign="center"
      sx={{ fontWeight: 600, color: '#555' }}
    >
      {label}
    </Typography>
    <Typography
      variant="h5"
      textAlign="center"
      pt={1}
      sx={{ fontWeight: 400, color: '#888' }}
    >
      {format(date, 'dd/MM/yyyy')}
    </Typography>
  </Stack>
);
