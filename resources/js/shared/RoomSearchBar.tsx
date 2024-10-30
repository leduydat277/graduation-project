import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import Button from '@mui/material/Button';
import {Box} from '@mui/material';
import {pink} from '@mui/material/colors';
import { DatePickerWithRange } from '@/Components/Reservation/DatePicker';

export const  RoomSearchBar = (props) => {
  return (
    <>
    <Box sx={{backgroundColor: pink[50], 
        borderRadius: 10,
    }}>
    
      
      <DatePickerWithRange  type={{mode: "range", disabled: { before: new Date() } }} />
    </Box>
    </>
  );
}

