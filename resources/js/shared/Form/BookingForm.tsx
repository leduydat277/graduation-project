import React, { useState } from "react";
import { Typography, Stack, Snackbar } from '@mui/material';
import { Button } from '@/components/ui/button';
import { RoomSearchBar } from '../Room/RoomSearchBar';
import { calculateTotalAmount, calculateTotalGuest } from '../../../service/hooks/booking';
import { useBookingStore } from '../../../service/stores/booking-store';
import { userStore } from '../../../service/stores/user-store';
import { ArrowRight, CalendarClock } from 'lucide-react';
import { grey, red } from '@mui/material/colors';
import { formatPrice } from '../../../service/hooks/price';
import { Link } from '@inertiajs/react';

export const BookingForm = () => {
  const [toastOpen, setToastOpen] = useState(false);

  const handleLinkClick = (e) => {
    const guest = calculateTotalGuest(numberOfGuests, numberOfChildren);
    if (guest > capacity) {
      e.preventDefault();
      setToastOpen(true);
    }
  };

 
  const handleCloseToast = () => setToastOpen(false);

  const [
    checkInDate,
    checkOutDate,
    totalDays,
    title,
    subtitle,
    price,
    numberOfGuests,
    numberOfChildren,
    capacity,
  ] = useBookingStore((state) => [
    state.checkInDate,
    state.checkOutDate,
    state.totalDays,
    state.title,
    state.subtitle,
    state.price,
    state.numberOfGuests,
    state.numberOfChildren,
    state.capacity,
  ]);
  const message = `Số lượng người không vượt quá ${capacity} người.`;

  const guest = calculateTotalGuest(numberOfGuests, numberOfChildren);
  const totalPrice = calculateTotalAmount(totalDays, price);

  return (
    <>
      <Stack
        w="100%"
        borderRadius={4}
        border={'1px solid ' + grey[300]}
        p={2}
      >
        <Typography variant="h6">{title}</Typography>
        <Typography variant="subtitle2" pt={1}>
          {subtitle}
        </Typography>
        <Stack direction={'row'} pt={1}>
          <CalendarClock />
          <Typography pl={2}>
            Check-in 2:00 PM | Check-out 12:00 PM
          </Typography>
        </Stack>
        <RoomSearchBar position={'detail'} />
        <Typography variant="h6" pb={1}>
          Tổng số người lớn: {numberOfGuests}
        </Typography>
        <Typography variant="h6" pb={1}>
          Tổng số trẻ em: {numberOfChildren}
        </Typography>
        <Typography variant="h6" pb={1}>
          Total: {formatPrice(totalPrice)}
        </Typography>
        <Link href="/confirmation" as="button" onClick={handleLinkClick}>
          <Button variant="outline">
            Tiếp theo <ArrowRight />
          </Button>
        </Link>
      </Stack>
      <Snackbar
        open={toastOpen}
        onClose={handleCloseToast}
        autoHideDuration={3000}
        message={message}
        sx={{
          "& .MuiSnackbarContent-root": {
            backgroundColor: red[50],
            color: grey[800],
          },
        }}
      />
    </>
  );
};
