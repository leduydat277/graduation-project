import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from './../../shared/RoomSearchBar';
<<<<<<< HEAD

import React from 'react';
import { Box, Button, Container, Grid, Typography, Paper, InputAdornment, TextField, Select, MenuItem, InputLabel, FormControl, Stack, Card, CardMedia, CardContent, Chip } from '@mui/material';
import { blue, grey } from '@mui/material/colors';
import SearchIcon from '@mui/icons-material/Search';
import LocationOnIcon from '@mui/icons-material/LocationOn';
import GroupIcon from '@mui/icons-material/Group';
import CalendarTodayIcon from '@mui/icons-material/CalendarToday';
import LuggageIcon from '@mui/icons-material/Luggage';
import CameraAltIcon from '@mui/icons-material/CameraAlt';
=======
import { RoomItem } from '../../shared/Room/RoomItem';
import { RoomList } from '../../shared/Room/RoomList';
import { Box } from '@mui/material';
import { grey, pink } from '@mui/material/colors';
import '@fontsource/roboto/300.css';
>>>>>>> 175a525762adede9dea5250bff636ac41235b21c


function ScreenPage() {
  return (
    <>
<<<<<<< HEAD
      <Box sx={{ backgroundColor: grey[50], minHeight: '100vh', py: 4 }}>
        <Container sx={{ textAlign: 'center', mb: 4 }}>

          <Box sx={{ display: 'flex' }}>
            <Box className='banner-left' sx={{ textAlign: 'left' }}>
              {/* Phần Hero */}
              <Typography variant="h4" fontWeight="bold" gutterBottom sx={{ color: "#0d0d2b", width: '380px' }}>
                Forget Busy Work, Start Next Vacation
              </Typography>
              <Typography variant="body1" color="text.secondary" mb={3}>
                We provide what you need to enjoy your holiday with family. Time to make another memorable moment.
              </Typography>
              <Button variant="contained" sx={{ backgroundColor: '#3252DF', mb: 4, px: 3, py: 1.5, height: '35px', fontSize: '1rem', fontWeight: 'bold', textTransform: 'none', borderRadius: '0.5rem' }}>
                Show More
              </Button>

              {/* Thống kê */}
              <Stack sx={{ marginTop: '60px' }} direction="row" spacing={5} mb={6}>
                <Box textAlign="left">
                  <Typography variant="h6" fontWeight="bold" sx={{ color: "#0d0d2b" }}><LuggageIcon sx={{ color: 'pink' }}></LuggageIcon></Typography>
                  <Typography variant="body2" color="text.secondary">2500 | <span style={{ color: '#B0B0B0' }}>Users</span></Typography>
                </Box>
                <Box textAlign="left">
                  <Typography variant="h6" fontWeight="bold" sx={{ color: "#0d0d2b" }}><CameraAltIcon sx={{ color: 'pink' }}></CameraAltIcon></Typography>
                  <Typography variant="body2" color="text.secondary">200 | <span style={{ color: '#B0B0B0' }}>Treasure</span></Typography>
                </Box>
                <Box textAlign="left">
                  <Typography variant="h6" fontWeight="bold" sx={{ color: "#0d0d2b" }}><LocationOnIcon sx={{ color: 'pink' }}></LocationOnIcon></Typography>
                  <Typography variant="body2" color="text.secondary">100 |<span style={{ color: '#B0B0B0' }}>Cities</span></Typography>
                </Box>
              </Stack>
            </Box>
            {/* Hình ảnh */}
            <Box sx={{ display: 'flex', justifyContent: 'right', mb: 5 }}>

              <Box
                component="img"
                src="https://cafefcdn.com/2017/c7-1499324815024.jpg" // Thay bằng ảnh từ cơ sở dữ liệu của bạn
                alt="Resort Image"
                sx={{ width: '70%', height: '100%', borderRadius: '1rem', boxShadow: 3, borderTopLeftRadius: '6rem' }}
              />

            </Box>

          </Box>

          {/* Thanh Tìm Kiếm */}
          <Paper elevation={3} sx={{ padding: '1.5rem', display: 'flex', gap: '1rem', alignItems: 'center', borderRadius: '2rem', justifyContent: 'center', backgroundColor: '#EAF1FF', mb: 6 }}>
            <RoomSearchBar />
            <FormControl sx={{ m: 1, minWidth: 120 }} >
              <InputLabel id="demo-select-small-label">Person</InputLabel>
              <Select
                labelId="demo-select-small-label"
                id="demo-select-small"
                // value={age}
                label="Age"
              // onChange={handleChange}
              >
                <MenuItem value={10}>1</MenuItem>
                <MenuItem value={20}>2</MenuItem>
                <MenuItem value={30}>3</MenuItem>
              </Select>
            </FormControl>
            <FormControl variant="outlined" sx={{ m: 1, minWidth: 120, }} size="small">
              <TextField 
                label="Select Location"
                variant="outlined"
                InputProps={{
                  startAdornment: (
                    <InputAdornment position="start">
                      <LocationOnIcon />
                    </InputAdornment>
                  ),
                }}
              />
            </FormControl>
            <Button
              variant="contained"
              color="primary"
              size="large"
              sx={{ px: 4, py: 1.5, fontWeight: 'bold', textTransform: 'none', borderRadius: '0.5rem' }}
              startIcon={<SearchIcon />}
            >
              Search
            </Button>
          </Paper>

          {/* Phần Most Picked */}
          <Typography variant="h5" fontWeight="bold" gutterBottom sx={{ color: "#0d0d2b", textAlign: 'left' }}>
            Most Picked
          </Typography>
          {/* top phòng hay được book */}
          <Box sx={{ display: 'flex', gap: '20px', marginBottom: '50px' }}>
            <Box sx={{width:'50%'}}>
              <Box
                component="img"
                src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/560477645.jpg?k=d72c910a6c825dc65faa7f067469c18da4fa714d330350c53730b29c6cf48b64&o=&hp=1" // Đường dẫn ảnh
                alt="Sample Image"
                sx={{
                  width: '100%',
                  margin: 'auto',
                  p: 2,
                  boxShadow: 3,
                  borderRadius: '1rem',
                  overflow: 'hidden',
                }}
              />
            </Box>
            <Box sx={{ display: 'grid', width: '46%', gridTemplateColumns: 'repeat(2, 2fr)', gap: 2,  }}>
              <Box
                component="img"
                src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/439551017.jpg?k=57b1261d57ffe3485e507dc08e2737c644d9c3426bdf9ad17ae22e3fe9d1a1a0&o=&hp=1" // Đường dẫn ảnh
                alt="Sample Image"
                sx={{
                  margin: 'auto',
                  p: 1,
                  boxShadow: 3,
                  borderRadius: '1rem',
                  overflow: 'hidden',
                }}
              />
              <Box
                component="img"
                src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/247147174.jpg?k=5d2ca1f2863e42469e4f7c91f17406cef7a46c9d438518646a8d8cf3d8ade79c&o=&hp=1" // Đường dẫn ảnh
                alt="Sample Image"
                sx={{
                  margin: 'auto',
                  p: 1,
                  boxShadow: 3,
                  borderRadius: '1rem',
                  overflow: 'hidden',
                }}
              />
              <Box
                component="img"
                src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/339641925.jpg?k=8b16379b5d5ab5580cac94747ead9ab86c8f928457e61d089a888c6127bee4b7&o=&hp=1" // Đường dẫn ảnh
                alt="Sample Image"
                sx={{
                  margin: 'auto',
                  p: 1,
                  boxShadow: 3,
                  borderRadius: '1rem',
                  overflow: 'hidden',
                }}
              />
              <Box
                component="img"
                src="https://cf.bstatic.com/xdata/images/hotel/max1024x768/339641909.jpg?k=a635603ee222c4bc26ad240b881066b8cf8588008093e9828222975074175537&o=&hp=1" // Đường dẫn ảnh
                alt="Sample Image"
                sx={{
                  margin: 'auto',
                  p: 1,
                  boxShadow: 3,
                  borderRadius: '1rem',
                  overflow: 'hidden',
                }}
              />
            </Box>
          </Box>
          <Grid container spacing={3}>
            {['Sangri La', 'Taj Villa', 'Green Villa', 'Wooden Inn', 'Resort 1', 'Resort 2', 'Resort 3', 'Resort 4'].map((title, index) => (
              <Grid item xs={12} sm={6} md={4} lg={3} key={index}>
                <Card sx={{ borderRadius: '1rem', boxShadow: 3, overflow: 'hidden' }}>
                  <CardMedia
                    component="img"
                    height="140"
                    image="/path-to-room-image.jpg" // Thay bằng ảnh từ cơ sở dữ liệu của bạn
                    alt={title}
                  />
                  <CardContent>
                    <Chip label="Most Picked" color="primary" size="small" sx={{ position: 'absolute', top: '8px', left: '8px', fontSize: '0.75rem', fontWeight: 'bold' }} />
                    <Typography variant="body1" fontWeight="bold">{title}</Typography>
                    <Typography variant="body2" color="text.secondary">Starting from $100/night</Typography>
                  </CardContent>
                </Card>
              </Grid>
            ))}
          </Grid>
        </Container>
=======
      <Box sx={{ backgroundColor: pink[200] }} >
      <RoomList />
      
>>>>>>> 175a525762adede9dea5250bff636ac41235b21c
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