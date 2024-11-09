import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import React from 'react';
import { Stack, Grid, Typography, Box } from "@mui/material";
import { pink } from '@mui/material/colors';
import { BookingForm } from '../../shared/Form/BooKingForm'
import { ScrollableBox } from '../../shared/ScrollableBox'

import HomeBannner1 from '../../../assets/HomeBanner1.jpg';


function DetailRoom() {
  const data = {
    title: "ibis Paris Bastille Opera 11th",
    subtitle: "Vibrant economy hotel, open to everyone",
    type: "VIP",
    price: 30000,
    status: "Active",
    description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
    image: HomeBannner1
  }

  const { title, subtitle, type, price, status, description, image } = data
  return (
    <>
      <Grid container rowSpacing={1} columnSpacing={{ xs: 1, sm: 2, md: 3 }} sx={{  px:3}}>
        <Grid item xs={6} sm={8.5} >
          <ScrollableBox scrollContent={
            <Box sx={{ minHeight: '300px'}}>
              <Box
                component="img"
                src={image}
                borderRadius = {4}
                alt="Sample Image"
                sx={{
                  height: '100%',
                  width: '100%',
                  objectFit: 'cover',
                  loading: "lazy",
                  
              
                }}
              />
              <Typography variant="h3"> {title}</Typography>
              <Typography>{subtitle}</Typography>
              <Typography>{description}</Typography>
             
            </Box>
          } />
        </Grid>
        <Grid item xs={6} sm={3.5} >
          <BookingForm {...data} />
        </Grid>
      </Grid>
    </>
  );
}

DetailRoom.layout = (page: React.ReactNode) => (
  <MainLayout title="DetailRoom" children={page} />
);

export default DetailRoom;
