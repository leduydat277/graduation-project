import React from 'react';
import { Button } from '@/components/ui/button';
import { Box, Typography, Stack, FormControl, InputLabel, MenuItem } from '@mui/material';
import { useBookingStore } from "../../service/stores/booking-store";
import {TypeRoomsOptions} from './../../service/utils/containts'
import {
  Select,
  SelectContent,
  SelectGroup,
  SelectItem,
  SelectLabel,
  SelectTrigger,
  SelectValue,
} from "@/components/ui/select"

export const QuantitySelectGuest = () => {
  const { numberOfGuests, numberOfChildren, setNumberOfGuests, setNumberOfChildren } = useBookingStore(
    (state) => ({
      numberOfGuests: state.numberOfGuests,
      numberOfChildren: state.numberOfChildren,
      setNumberOfGuests: state.setNumberOfGuests,
      setNumberOfChildren: state.setNumberOfChildren
    })
  );

  const upGuests = () => setNumberOfGuests(numberOfGuests + 1);
  const downGuests = () => setNumberOfGuests(Math.max(numberOfGuests - 1, 1));
  const upChildren = () => setNumberOfChildren(numberOfChildren + 1);
  const downChildren = () => setNumberOfChildren(Math.max(numberOfChildren - 1, 0));

  return (
    <Stack spacing={2}>
      <Stack spacing={1} direction="row" alignItems="center">
        <Typography variant="body1" sx={{ pr: 3 }}>Số người lớn: </Typography>
        <Stack direction="row" alignItems="center" spacing={1}>
          <Button variant="secondary" onClick={downGuests}>-</Button>
          <Typography variant="h6">{numberOfGuests}</Typography>
          <Button variant="secondary" onClick={upGuests}>+</Button>
        </Stack>
      </Stack>
      <Stack spacing={1} direction="row" alignItems="center">
        <Typography variant="body1" sx={{ pr: 5.7 }}>Số trẻ em: </Typography>
        <Stack direction="row" alignItems="center" spacing={1}>
          <Button variant="secondary" onClick={downChildren}>-</Button>
          <Typography variant="h6">{numberOfChildren}</Typography>
          <Button variant="secondary" onClick={upChildren}>+</Button>
        </Stack>
      </Stack>
      <SelectTypeRoom />
    </Stack>
  );
};


export const SelectTypeRoom = () => {
  const [setTypeRoom] = useBookingStore((state) => [state.setTypeRoom]);

  const changeRoomType = (value) => {
    console.log(value);
    setTypeRoom(value);
  };

  return (
    <Stack spacing={1} direction="row" alignItems="center">
    <Typography sx={{ pr: 4 }}>Loại phòng: </Typography>
    <Select onValueChange={changeRoomType}>
      <SelectTrigger className="w-[180px]">
        <SelectValue placeholder="Chọn loại phòng" />
      </SelectTrigger>
      <SelectContent>
        <SelectGroup>
          {TypeRoomsOptions.map((option, index) => (
            <SelectItem key={index} value={option.code}>
              {option.name}
            </SelectItem>
          ))}
        </SelectGroup>
      </SelectContent>
    </Select>
    </Stack>
  );
};


