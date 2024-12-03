
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from './../../shared/Room/RoomSearchBar'
import { BannerImage } from './BannerImage'
import React from 'react';
import { Box, Button, Container, Typography, Paper, Stack } from '@mui/material';
import { grey, pink, blue } from '@mui/material/colors';
import SearchIcon from '@mui/icons-material/Search';
import { Banners } from './Banners';
import { RoomList } from '@/shared/Room/RoomList';
// import { Footer } from '@/components/Footer/Footer';
import { Introduce } from './Introduce';
import { ListTypeRoom } from './ListTypeRooms';

function ScreenPage() {
  
const onPress = async () => {
  
}
  
  return (
    <>
      <Box sx={{ pt: 6, pb: 3, position: 'relative' }}>
        <Box sx={{ mb: 10, mx: 5 }}>
          {/* <Banners /> */}
          {/* <Banner /> */}
          <Paper elevation={3}
           sx={{  display: 'flex', 
           gap: '1rem', alignItems: 'center', borderRadius: 
           '2rem', justifyContent: 'center', 
           backgroundColor: 'white', mb: 6 , position: 'absolute', top: '-130px', left: '160px'}}>
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
              sx={{ right: '100px', fontWeight: 'bold', textTransform: 'none', borderRadius: '0.5rem' }}
              startIcon={<SearchIcon />}>
              Search
            </Button>
          </Paper>
          <Introduce />
          {/* <BannerImage /> */}
          <Typography
                variant="subtitle1"
                sx={{
                    fontSize: "1rem",
                    color: "#aaa38b",
                    textTransform: "uppercase",
                    textAlign: "center",
                    marginBottom: "0.5rem",
                }}
            >
                Khách sạn 4 Sao Sleep Hotel
            </Typography>
            <Typography
                variant="h1"
                sx={{
                    fontSize: "1.8rem",
                    fontWeight: "bold",
                    textAlign: "center",
                    color: "#333",
                    marginBottom: "1.5rem",
                }}

            >
                NỔI BẬT
            </Typography>
          <RoomList end={6} start={0} />
          <ListTypeRoom />
        </Box>

      </Box>

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