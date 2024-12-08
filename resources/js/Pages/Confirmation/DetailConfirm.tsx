import { Box, Stack, Typography } from "@mui/material";
import { useBookingStore } from "../../../service/stores/booking-store";
import { formatPrice } from "../../../service/hooks/price";
import { Booking, calculateTotalGuest } from "../../../service/hooks/booking";
import { format } from "date-fns";
import { userStore } from '../../../service/stores/user-store';
import { ArrowRight } from "lucide-react";
import { Button } from '@/components/ui/button';

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
            boxShadow: "0px 4px 10px rgba(0, 0, 0, 0.2)",
            transition: "transform 0.3s ease-in-out",
            "&:hover": {
                transform: "scale(1.02)",
            },
        }}
    >
        <InfoConfirm />
        <InfoBooking />
    </Stack>
);

const DetailRow = ({ label, value }: { label: string; value: string | number }) => (
    <Stack
        direction="row"
        sx={{
            p: 1,
            borderRadius: 3,
            transition: "background-color 0.3s ease",
            "&:hover": {
                backgroundColor: "#fafafa",
            },
        }}
    >
        <Typography
            variant="h5"
            sx={{ fontWeight: 600, color: "#555" }}
        >
            {label}:
        </Typography>
        <Typography
            variant="h5"
            sx={{ pl: 1, fontWeight: 400, color: "#888" }}
        >
            {value}
        </Typography>
    </Stack>
);

const InfoBooking = () => {
    const [checkInDate, checkOutDate, totalDays, totalPrice, numberOfGuests, numberOfChildren,idRoom] =
        useBookingStore((state) => [
            state.checkInDate,
            state.checkOutDate,
            state.totalDays,
            state.totalPrice,
            state.numberOfGuests,
            state.numberOfChildren,
            state.idRoom
        ]);

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
        const bookingData = {
          user_id: 5,
          check_in_date: checkInDate,
          check_out_date: checkOutDate,
          first_name: 'John',
          last_name: 'Doe',
          payment_type: 2,
          address: '123 Main St',
          created_at: Date.now(),
          phone: '0123456789',
          email: 'johndoe@example.com',
          room_id: idRoom || 5
        };
        try {
          const booking = await Booking(bookingData);
          console.log(checkInDate, checkOutDate);
    
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
        const bookingData = {
          user_id: 5,
          check_in_date: checkInDate,
          check_out_date: checkOutDate,
          first_name: 'John',
          last_name: 'Doe',
          address: '123 Main St',
          payment_type: 1,
          created_at: Date.now(),
          phone: '0123456789',
          email: 'johndoe@example.com',
          room_id: idRoom || 5
        };
        try {
          const booking = await Booking(bookingData);
          console.log(checkInDate, checkOutDate);
    
          console.log('Booking successful', booking.paymentUrl);
          if (booking.paymentUrl) {
            window.location.href = booking.paymentUrl;
          }
        } catch (error) {
          console.error('Booking failed:', error);
        }
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
                animation: "fadeIn 0.8s",
                "@keyframes fadeIn": {
                    "0%": { opacity: 0 },
                    "100%": { opacity: 1 },
                },
            }}
        >
            <Typography
                variant="h3"
                textAlign="center"
                pb={2}
                sx={{ color: "#333", fontWeight: "bold" }}
            >
                Thông tin đặt phòng
            </Typography>
            <Stack direction="row" justifyContent="space-between">
                <DateInfo label="Check in" date={checkInDate} />
                <ArrowRight />
                <DateInfo label="Check out" date={checkOutDate} />
            </Stack>
            <DetailRow label="Tổng số ngày" value={totalDays} />
            <DetailRow label="Tổng giá" value={formatPrice(totalPrice)} />
            <DetailRow label="Tổng số người" value={guest} />
            <DetailRow label="Tên khách hàng" value="subtitle" />
            <DetailRow label="Số điện thoại" value="subtitle" />
            <Stack gap={2}>
            <Button  variant="outline" onClick={depositPayment}>
          Thanh toán cọc (20%)
        </Button>
            <Button  variant="outline" onClick={payAll}>
          Thanh toán tất cả
        </Button>
       
            </Stack>
        </Stack>
    );
};

const InfoConfirm = () => {
    const [price, subtitle, type] = useBookingStore((state) => [state.price, state.subtitle, state.type]);

    return (
        <Stack
            width="100%"
            gap={1}
            backgroundColor="#f2f2f2"
            borderRadius={6}
            sx={{
                p: 3,
                animation: "fadeIn 0.8s",
                "@keyframes fadeIn": {
                    "0%": { opacity: 0 },
                    "100%": { opacity: 1 },
                },
            }}
        >
            <Typography
                variant="h3"
                textAlign="center"
                pb={2}
                sx={{ color: "#333", fontWeight: "bold" }}
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
            sx={{ fontWeight: 600, color: "#555" }}
        >
            {label}
        </Typography>
        <Typography
            variant="h5"
            textAlign="center"
            pt={1}
            sx={{ fontWeight: 400, color: "#888" }}
        >
            {format(date, "dd/MM/yyyy")}
        </Typography>
    </Stack>
);
