
import { Box, Stack, Typography } from '@mui/material';

import { pink } from '@mui/material/colors';
import { CalendarDays, Users } from 'lucide-react';
import { DatePickerWithRange } from '@/components/Reservation/DatePicker';
import { GuestCount } from '../GuestCount';
import { useBookingStore } from './../../../service/stores/booking-store';


export const RoomSearchBar = () => {
  const { typeRoom } = useBookingStore((state) => ({
    typeRoom: state.typeRoom
  }));

  const containerStyle = {
    backgroundColor: pink[50],
    borderRadius: 10,
    paddingX: 20,
  };

  return (
    <Stack direction="row" spacing={4} py={2} sx={containerStyle}>
      <Stack >
        <Stack direction="row" alignItems="center" spacing={1} pb={1}>
          <Typography variant="caption">Checkin - Checkout</Typography>
          <CalendarDays />
        </Stack>
        <DatePickerWithRange type={{ mode: "range", disabled: { before: new Date() } }} />
      </Stack>
      <Stack>
        <Stack direction="row" alignItems="center" spacing={1} pb={1}>
          <Typography variant="caption">Phòng & khách</Typography>
          <Users />
        </Stack>
        <GuestCount py={2} />
      </Stack>
    </Stack>
  );
};

export default RoomSearchBar;
