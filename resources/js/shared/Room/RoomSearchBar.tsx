
import { Box, Stack, Typography } from '@mui/material';

import { pink } from '@mui/material/colors';
import { CalendarDays, Users } from 'lucide-react';
import { DatePickerWithRange } from '@/components/Reservation/DatePicker';
import { GuestCount } from '../GuestCount';
import { useBookingStore } from './../../../service/stores/booking-store';


export const RoomSearchBar = (props) => {
  const {style, direction, position, ...rest} = props
  const { typeRoom } = useBookingStore((state) => ({
    typeRoom: state.typeRoom
  }));

  return (
    <Stack direction={direction} spacing={4} py={2} sx={style}>
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
        <GuestCount py={2} position={position} />
      </Stack>
    </Stack>
  );
  
};


