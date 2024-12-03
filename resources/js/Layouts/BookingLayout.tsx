import { Head } from '@inertiajs/react';
import '@fontsource/roboto/400.css';
import { Stack, Grid, Typography, Box } from "@mui/material";

import { BottomHeader } from '@/components/Header/BottomHeader';
import { ScrollableBox } from '@/shared/ScrollableBox';
import { BookingForm } from '@/shared/Form/BookingForm';


interface BookingLayoutProps {
  title?: string;
  children: React.ReactNode;
}

export default function BookingLayout({ title, children }: BookingLayoutProps) {
  return (
    <>
      <Head title={title} />
      {/* <BottomHeader /> */}
      <Grid container rowSpacing={1} columnSpacing={{ xs: 1, sm: 2, md: 3 }} sx={{  px:3, pt:7}}>
        <Grid item xs={6} sm={8.5} >
          <ScrollableBox scrollContent={
            <Box sx={{ minHeight: '300px'}}>
              {children}
             
            </Box>
          } />
        </Grid>
        <Grid item xs={6} sm={3.5} >
          <BookingForm/>
        </Grid>
      </Grid>
     
    </>
  );
}
