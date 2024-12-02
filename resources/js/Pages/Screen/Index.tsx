
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from './../../shared/Room/RoomSearchBar'
import { BannerImage } from './BannerImage'
import React from 'react';
import { Box, Button, Container, Typography, Paper, Stack } from '@mui/material';
import { grey, pink, blue } from '@mui/material/colors';
import SearchIcon from '@mui/icons-material/Search';
import { Banners } from './Banners';
import { RoomList } from '@/shared/Room/RoomList';
import { Footer } from '@/components/Footer/Footer';
import { Banner } from './Banner';

function ScreenPage() {
  
const onPress = async () => {
  
}
  
  return (
    <>
      <Box sx={{ py: 6 }}>
        <Box sx={{ mb: 10, mx: 5 }}>
          {/* <Banners /> */}
          {/* <Banner /> */}
          <Paper elevation={3} sx={{ padding: '1.5rem', display: 'flex', gap: '1rem', alignItems: 'center', borderRadius: '2rem', justifyContent: 'center', backgroundColor: blue[50], mb: 6 }}>
            <RoomSearchBar style={{
              backgroundColor: grey[50],
              borderRadius: 10,
              paddingX: 20,
            }}
              direction="row"
            />
            <Button
              variant="contained"
              color="primary"
              size="large"
              sx={{ px: 4, py: 1.5, fontWeight: 'bold', textTransform: 'none', borderRadius: '0.5rem' }}
              startIcon={<SearchIcon />}>
              Search
            </Button>
          </Paper>
          <BannerImage />
          <RoomList end={6} start={0} />

        </Box>

      </Box>
      <Footer />
    </>
    
  );
}



/**
 * Persistent Layout (Inertia.js)
 *
 * [Learn more](https://inertiajs.com/pages#persistent-layouts)
 */
ScreenPage.layout = (page: React.ReactNode) => (
  <MainLayout title="Screen" children={page} />
);

export default ScreenPage;