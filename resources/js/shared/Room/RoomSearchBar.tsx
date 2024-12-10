import { Box, Stack, Typography } from '@mui/material';
import { pink } from '@mui/material/colors';
import { Bath, CalendarDays, Users } from 'lucide-react';
import { DatePickerWithRange } from '@/components/Reservation/DatePicker';
import { GuestCount } from '../GuestCount';
import { useBookingStore } from './../../../service/stores/booking-store';
import { SelectTypeRoom } from '../QuantitySelectGuest';

export const RoomSearchBar = (props) => {
  const { style, direction, position, flag, ...rest } = props;
  console.log(flag, 'flag');
  const { typeRoom } = useBookingStore((state) => ({
    typeRoom: state.typeRoom
  }));

  return (
    <Stack direction={direction} spacing={4} py={2} sx={style}>
      <Stack>
        <Stack direction="row" alignItems="center" spacing={1} pb={1}>
          <Typography variant="caption">Checkin - Checkout</Typography>
          <CalendarDays />
        </Stack>
        <DatePickerWithRange type={{ mode: 'range', disabled: { before: new Date() } }} />
      </Stack>
      {flag === false ? (
        <Stack>
          <Stack direction="row" alignItems="center" spacing={1} pb={1}>
            <Typography variant="caption">Type Room</Typography>
            <Bath />
          </Stack>
          <SelectTypeRoom />
        </Stack>
      ) : (
        <Stack>
          <Stack direction="row" alignItems="center" spacing={1} pb={1}>
            <Typography variant="caption">Room & Guest</Typography>
            <Users />
          </Stack>
          <GuestCount py={2} position={position} />
        </Stack>
      )}
    </Stack>
  );
};
