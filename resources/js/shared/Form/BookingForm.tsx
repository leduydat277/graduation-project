import { Typography, Stack } from '@mui/material';
import { Button } from '@/components/ui/button';
import { RoomSearchBar } from '../Room/RoomSearchBar';
import { Booking, calculateTotalAmount, calculateTotalGuest } from '../../../service/hooks/booking';
import { useBookingStore } from '../../../service/stores/booking-store';
import { userStore } from '../../../service/stores/user-store';
import { ArrowRight, CalendarClock } from 'lucide-react';
import { grey } from '@mui/material/colors';
import { formatPrice } from '../../../service/hooks/price';
import React from 'react';
import { Link } from '@inertiajs/react';

export const BookingForm = (props) => {
  const [
    checkInDate,
    checkOutDate,
    totalDays,
    setTotalPrice,
    title,
    subtitle,
    price,
    idRoom,
    clear,
    setPrice,
    numberOfAdults,
    numberOfChildren,
    capacity

  ] = useBookingStore(state => [
    state.checkInDate,
    state.checkOutDate,
    state.totalDays,
    state.setTotalPrice,
    state.title,
    state.subtitle,
    state.price,
    state.idRoom,
    state.clear,
    state.setPrice,
    state.numberOfAdults,
    state.numberOfChildren,
    state.capacity
  ]);

  const guest = calculateTotalGuest(numberOfAdults, numberOfChildren);
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
  const validateLogin = () => {
    if (
      checkInDate < checkOutDate &&
      checkInDate > Date.now() &&
      checkOutDate > Date.now()
    ) {
      return true;
    }
    return false;
  };
 


  const totalPrice = calculateTotalAmount(totalDays, price);



 const validateNumberGuest = () => {
    if (
      guest > capacity
    ) {
      console.log('true');
    }
    return false;
    
  }
  const onPress = async () => {
    await Promise.all(ps);
   
    
  };
  ps.push(validateLogin());
  ps.push(validateNumberGuest());

  return (
    <>
      <Stack w="100%" borderRadius={4} border={'1px solid ' + grey[300]} p={2}>
        <Typography variant="h6">{title}</Typography>
        <Typography variant="subtitle2" pt={1}>
          {subtitle}
        </Typography>
        <Stack direction={'row'} pt={1}>
          <CalendarClock />
          <Typography pl={2}> Check-in 2:00 PM | Check-out 12:00 PM</Typography>
        </Stack>
        <RoomSearchBar position={'detail'} />

        <Typography variant="h6" pb={1}>
          Total: {formatPrice(totalPrice)}
        </Typography>
        <Link href="/confirmation" as="button">
        <Button variant="outline">
          Tiếp theo <ArrowRight />
        </Button>
        </Link>
      </Stack>
    </>
  );
};
