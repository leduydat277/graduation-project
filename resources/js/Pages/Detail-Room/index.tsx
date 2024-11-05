import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from './../../shared/RoomSearchBar';

import React from 'react';
import { Box, Button, Container, Grid, Typography, Paper, InputAdornment, TextField, Select, MenuItem, InputLabel, FormControl, Stack, Card, CardMedia, CardContent, Chip } from '@mui/material';
import { blue, grey } from '@mui/material/colors';
import SearchIcon from '@mui/icons-material/Search';
import LocationOnIcon from '@mui/icons-material/LocationOn';
import GroupIcon from '@mui/icons-material/Group';
import CalendarTodayIcon from '@mui/icons-material/CalendarToday';
import LuggageIcon from '@mui/icons-material/Luggage';
import CameraAltIcon from '@mui/icons-material/CameraAlt';


function DetailRoom() {
  return (
    <>
      <Box>
        ???????
      </Box>
    </>
  );
}



/**
 * Persistent Layout (Inertia.js)
 *
 * [Learn more](https://inertiajs.com/pages#persistent-layouts)
 */
DetailRoom.layout = (page: React.ReactNode) => (
  <MainLayout title="DetailRoom" children={page} />
);

export default DetailRoom;