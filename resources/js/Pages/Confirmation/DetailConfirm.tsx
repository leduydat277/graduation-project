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

export const DetailConfirm = () => (
  <Stack
    width="100%"
    direction="row"
    height={900}
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
    <Stack direction="column">
      <ConfirmInfoUser />
    </Stack>
    <Stack direction="column">
      <InfoConfirm />
      <InfoBooking />
    </Stack>
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
  const guest = calculateTotalGuest(numberOfGuests, numberOfChildren);
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
      <DetailRow label="Tổng số người" value={guest} />
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

const ConfirmInfoUser = () => {
  const [errors, setErrors] = useState({});
  const handleInputChange = (e, setError) => {
    const value = e.target.value;
    setError('');
    if (value === '') {
      setError('Vui lòng nhập thông tin');
    }
  };
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
  console.log(totalPrice);

  const guest = calculateTotalGuest(numberOfGuests, numberOfChildren);
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

  const [voucherCode, setVoucherCode] = useState('');
  const [voucherId, setVoucherId] = useState('');
  const [discountPrice, setDiscountPrice] = useState(0);
  const [voucherApplied, setVoucherApplied] = useState(false);
  const [voucherInfo, setVoucherInfo] = useState(null);

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

  const [setUserId, setAddress, setEmail, setFirstName, setLastName, setPhone] =
    userStore(state => [
      state.setUserId,
      state.setAddress,
      state.setEmail,
      state.setFirstName,
      state.setLastName,
      state.setPhone
    ]);

  const updateTotalPrice = voucher => {
    let newTotalPrice = totalPrice;
    if (voucher.type === '%') {
      newTotalPrice = totalPrice * (voucher.discount_value / 100);
    } else if (voucher.type === 'fixed') {
      newTotalPrice = totalPrice - voucher.discount_value;
    }
    return newTotalPrice;
  };

  const voucher = async () => {
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
        setVoucherId(response.data.voucher.id);
        setDiscountPrice(newTotalPrice);
      } else if (response.data.type === 'error') {
        toast.error(`Áp dụng voucher thất bại: ${response.data.message}`);
      }
    } catch (error) {
      console.error('Lỗi khi áp dụng voucher:', error);
      toast.error('Lỗi không xác định khi áp dụng voucher.');
    }
  };

  const removeVoucher = () => {
    setVoucherCode('');
    setVoucherInfo(null);
    setVoucherApplied(false);
    setDiscountPrice(0);
  };

  const [errorLastName, setErrorLastName] = useState('');
  const [errorFirstName, setErrorFirstName] = useState('');
  const [errorPhone, setErrorPhone] = useState('');
  const [errorEmail, setErrorEmail] = useState('');
  const [errorAddress, setErrorAddress] = useState('');

  const payAll = async () => {
    try {
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
        total_price: discountPrice > 0 ? discountPrice : totalPrice,
        voucher_id: voucherId || ''
      };

      const booking = await Booking(bookingData);
      if (booking.type === 'error') {
        if (booking.message.last_name) {
          // console.log(booking.message.last_name);
          setErrorLastName(booking.message.last_name);
        }
        if (booking.message.first_name) {
          // console.log(booking.message.first_name);
          setErrorFirstName(booking.message.first_name);
        }
        if (booking.message.email) {
          // console.log(booking.message.email);
          setErrorEmail(booking.message.email);
        }
        if (booking.message.phone) {
          // console.log(booking.message.phone);
          setErrorPhone(booking.message.phone);
        }
        if (booking.message.address) {
          // console.log(booking.message.address);
          setErrorAddress(booking.message.address);
        }
      }
      if (booking.paymentUrl) {
        window.location.href = booking.paymentUrl;
      }
    } catch (error) {
      console.error('Booking failed:', error);
    }
  };

  const depositPayment = async () => {
    try {
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
        total_price: discountPrice > 0 ? discountPrice : totalPrice,
        voucher_id: voucherId || ''
      };

      const booking = await Booking(bookingData);
      if (booking.type === 'error') {
        if (booking.message.last_name) {
          // console.log(booking.message.last_name);
          setErrorLastName(booking.message.last_name);
        }
        if (booking.message.first_name) {
          // console.log(booking.message.first_name);
          setErrorFirstName(booking.message.first_name);
        }
        if (booking.message.email) {
          // console.log(booking.message.email);
          setErrorEmail(booking.message.email);
        }
        if (booking.message.phone) {
          // console.log(booking.message.phone);
          setErrorPhone(booking.message.phone);
        }
        if (booking.message.address) {
          // console.log(booking.message.address);
          setErrorAddress(booking.message.address);
        }
      }
      if (booking.paymentUrl) {
        window.location.href = booking.paymentUrl;
      }
    } catch (error) {
      console.error('Booking failed:', error);
    }
  };

  return (
    <>
      <Stack direction="column" gap={2} alignItems="flex-start" pt={2}>
        <Typography
          variant="h3"
          textAlign="center"
          pb={2}
          sx={{ color: '#333', fontWeight: 'bold' }}
        >
          Thông tin khách hàng
        </Typography>

        <Stack direction="column" gap={2}>
          <Stack direction="row" justifyContent="space-between">
            <Stack direction="column">
              <DetailRow label="Họ"></DetailRow>
              <input
                type="text"
                value={lastName}
                onChange={e => {
                  setLastName(e.target.value);
                  handleInputChange(e, setErrorLastName);
                }}
                placeholder="Nhập họ"
                style={{
                  padding: '8px',
                  borderRadius: '4px',
                  border: '1px solid #ccc',
                  flex: 1
                }}
              />
              <Stack>
                {errorLastName && (
                  <div style={{ color: 'red' }}>{errorLastName}</div>
                )}
              </Stack>
            </Stack>
            <Stack direction="column">
              <DetailRow label="Tên"></DetailRow>
              <input
                type="text"
                value={firstName}
                onChange={e => {
                  setFirstName(e.target.value);
                  handleInputChange(e, setErrorFirstName);
                }}
                placeholder="Nhập tên"
                style={{
                  padding: '8px',
                  borderRadius: '4px',
                  border: '1px solid #ccc',
                  flex: 1
                }}
              />
              <Stack>
                {errorFirstName && (
                  <div style={{ color: 'red' }}>{errorFirstName}</div>
                )}
              </Stack>
            </Stack>
          </Stack>

          <Stack direction="column" justifyContent="space-between">
            <DetailRow label="Số điện thoại"></DetailRow>
            <input
              type="text"
              value={phone}
              onChange={e => {
                setPhone(e.target.value);
                handleInputChange(e, setErrorPhone);
              }}
              placeholder="Nhập số điện thoại"
              style={{
                padding: '8px',
                borderRadius: '4px',
                border: '1px solid #ccc',
                flex: 1
              }}
            />
            <Stack>
              {errorPhone && <div style={{ color: 'red' }}>{errorPhone}</div>}
            </Stack>
          </Stack>

          <Stack direction="column" justifyContent="space-between">
            <DetailRow label="Email"></DetailRow>
            <input
              type="email"
              value={email}
              onChange={e => {
                setEmail(e.target.value);
                handleInputChange(e, setErrorEmail);
              }}
              placeholder="Nhập địa chỉ email"
              style={{
                padding: '8px',
                borderRadius: '4px',
                border: '1px solid #ccc',
                flex: 1
              }}
            />
            <Stack>
              {errorEmail && <div style={{ color: 'red' }}>{errorEmail}</div>}
            </Stack>
          </Stack>

          <Stack direction="column" justifyContent="space-between">
            <DetailRow label="Địa chỉ"></DetailRow>
            <input
              type="text"
              value={address}
              onChange={e => {
                setAddress(e.target.value);
                handleInputChange(e, setErrorAddress);
              }}
              placeholder="Nhập địa chỉ"
              style={{
                padding: '8px',
                borderRadius: '4px',
                border: '1px solid #ccc',
                flex: 1
              }}
            />
            <Stack>
              {errorAddress && (
                <div style={{ color: 'red' }}>{errorAddress}</div>
              )}
            </Stack>
          </Stack>
        </Stack>
      </Stack>

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
                onClick={removeVoucher}
                sx={{ marginTop: '16px' }}
              >
                Hủy Voucher
              </Button>
            </Stack>
          </Box>
        </Stack>
      )}
      <DetailRow
        label="Tổng giá"
        value={
          voucherApplied ? formatPrice(discountPrice) : formatPrice(totalPrice)
        }
      />
      <Stack gap={2}>
        <Button variant="outline" onClick={depositPayment}>
          Thanh toán cọc (30%)
        </Button>
        <Button variant="outline" onClick={payAll}>
          Thanh toán tất cả
        </Button>
      </Stack>
    </>
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
