
import React, { useEffect } from 'react';
import { Typography, Box } from "@mui/material";
import HomeBannner5 from '../../../assets/HomeBanner5.jpg';
import {formatPrice} from '../../../service/hooks/price'
import { CarouselCustom } from '@/shared/CarouselCustom';
import { useBookingStore } from '../../../service/stores/booking-store';

export const DetailContent = (props) => {
console.log('props', props.image_room)
  const { title, description, subtitle='Trải nghiệm sang trọng và thoải mái bậc nhất', price, image_room } = props
  console.log('image_room', image_room)

  let imageRoomArray = JSON.parse(props.image_room);
  console.log("Sanitized image room:", imageRoomArray);
  const [setPrice] = useBookingStore((state) => [state.setPrice]);
  useEffect(() => {
    setPrice(price);
  }, [price, setPrice]);


  
  return (
    <Box sx={{ minHeight: '300px'}}>
    <CarouselCustom image_room={imageRoomArray} />
              <Typography variant="h3" pt={4}> {title}</Typography>
            
              <Typography variant="h5"  pt={3}>{subtitle}</Typography>
              
              <Typography variant="h5"  pt={3}> Giá: {formatPrice(price)}</Typography>
              <Typography pt={2}>Mô tả: {description}</Typography>
             
            </Box>
  );
}