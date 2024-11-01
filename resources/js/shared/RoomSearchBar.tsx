import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import Button from '@mui/material/Button';
import {Box} from '@mui/material';
import {pink, grey} from '@mui/material/colors';
import { DatePickerWithRange } from '@/components/Reservation/DatePicker';
import { GuestCount } from './GuestCount';

export const  RoomSearchBar = (props) => {
  return (
    <>
     <Box sx={{  backgroundColor: 'rgba(255, 255, 255, 0.7)', py: 2, px: 2, borderRadius: 5, width: '100%', display: 'flex', ZIndex: 1000}} >
    
      
      <DatePickerWithRange  type={{mode: "range", disabled: { before: new Date() } }} />
      <GuestCount />

    </Box>
    </>
  );
}

