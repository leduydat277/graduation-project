
import React from 'react';
import { Typography, Box } from "@mui/material";
import HomeBannner5 from '../../../assets/HomeBanner5.jpg';
import {formatPrice} from '../../../service/hooks/price'
import { CarouselCustom } from '@/shared/CarouselCustom';

export const DetailContent = (props) => {
  const { title, description, subtitle='Trải nghiệm sang trọng và thoải mái bậc nhất', image = '', price } = props
    console.log('DetailContent', props)

    const items = [
      { src: "https://via.placeholder.com/600x400?text=Image+1", alt: "Image 1" },
      { src: "https://via.placeholder.com/600x400?text=Image+2", alt: "Image 2" },
      { src: "https://via.placeholder.com/600x400?text=Image+3", alt: "Image 3" },
      { src: "https://via.placeholder.com/600x400?text=Image+4", alt: "Image 4" },
      { src: "https://via.placeholder.com/600x400?text=Image+5", alt: "Image 5" },
    ];
  return (
    <Box sx={{ minHeight: '300px'}}>
                  <CarouselCustom items={items}  />
              <Typography variant="h3" pt={4}> {title}</Typography>
            
              <Typography variant="h5"  pt={3}>{subtitle}</Typography>
              
              <Typography variant="h5"  pt={3}> Giá: {formatPrice(price)}</Typography>
              <Typography pt={2}>Mô tả: {description}</Typography>
             
            </Box>
  );
}