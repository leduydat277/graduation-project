
import React from 'react';
import { Typography, Box } from "@mui/material";
import HomeBannner5 from '../../../assets/HomeBanner5.jpg';

export const DetailContent = (props) => {
  const { title, description, subtitle = 'fake subtitle', image = '' } = props
    console.log('DetailContent', props)
  return (
    <Box sx={{ minHeight: '300px'}}>
              <Box
                component="img"
                src={HomeBannner5}
                borderRadius = {4}
                alt="Sample Image"
                sx={{
                  height: '100%',
                  width: '100%',
                  objectFit: 'cover',
                  loading: "lazy",
                }}
              />
              <Typography variant="h3" pt={4}> {title}</Typography>
              <Typography variant="h5"  pt={3}>{subtitle}</Typography>
              <Typography pt={2}>{description}</Typography>
             
            </Box>
  );
}