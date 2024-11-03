import React from 'react';
import { Button } from '@/components/ui/button';
import { Box, Typography, Stack, FormControl, InputLabel, Select, MenuItem } from '@mui/material';
import { useBookingStore } from "../../service/stores/booking-store";

export const QuantitySelectGuest = () => {
  const [numberOfGuests, numberOfChildren, setNumberOfGuests, setNumberOfChildren] = useBookingStore((state) => 
    [state.numberOfGuests, state.numberOfChildren, state.setNumberOfGuests, state.setNumberOfChildren]);
  
  const upGuests = () => setNumberOfGuests(numberOfGuests + 1);
  const downGuests = () => setNumberOfGuests(Math.max(numberOfGuests - 1, 1));
  const upChildren = () => setNumberOfChildren(numberOfChildren + 1);
  const downChildren = () => setNumberOfChildren(Math.max(numberOfChildren - 1, 0));
  
  return (
    <Stack spacing={2}>
      <Box sx={{ display: 'flex', alignItems: 'center' }}>
        <Button variant="secondary" onClick={upGuests}>+</Button>
        <Typography variant="h6" sx={{ px: 2 }}>{numberOfGuests}</Typography>
        <Button variant="secondary" onClick={downGuests}>-</Button>
      </Box>
      <Box sx={{ display: 'flex', alignItems: 'center' }}>
        <Button variant="secondary" onClick={upChildren}>+</Button>
        <Typography variant="h6" sx={{ px: 2 }}>{numberOfChildren}</Typography>
        <Button variant="secondary" onClick={downChildren}>-</Button>
      </Box>
      <SelectTypeRoom />
    </Stack>
  );
}

export const SelectTypeRoom = () => {
  const [roomType, setRoomType] = React.useState('');

  const handleChange = (event) => {
    setRoomType(event.target.value);
  };

  return (
    <FormControl fullWidth>
      <InputLabel id="select-room-type-label">Chọn loại phòng</InputLabel>
      <Select
        labelId="select-room-type-label"
        value={roomType}
        onChange={handleChange}
      >
        <MenuItem >Phòng Đơn</MenuItem>
      
      </Select>
    </FormControl>
  );
}
