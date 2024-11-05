import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import Button from '@mui/material/Button';
import { Box } from '@mui/material';

import { pink, grey } from '@mui/material/colors';
import { DatePickerWithRange } from '@/components/Reservation/DatePicker';
import { GuestCount } from './GuestCount';


export const RoomSearchBar = (props) => {
  return (
    <>

      <Box sx={{
        backgroundColor: pink[50],
        borderRadius: 10,

      }}>


        <DatePickerWithRange type={{ mode: "range", disabled: { before: new Date() } }} />

      </Box>
    </>
  );
}

