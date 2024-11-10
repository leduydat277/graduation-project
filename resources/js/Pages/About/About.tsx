
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from './../../shared/Room/RoomSearchBar'
import React from 'react';
import { Box, Button, Container, Typography, Paper, Stack } from '@mui/material';
import { grey, pink, blue } from '@mui/material/colors';
import SearchIcon from '@mui/icons-material/Search';
import { RoomList } from '@/shared/Room/RoomList';

import { AlignCenter } from 'lucide-react';
import { Footer } from '@/Components/Footer/Footer';



function AboutPage() {
  return (
    <>
      ???????
      <Footer />
    </>
    
  );
}



/**
 * Persistent Layout (Inertia.js)
 *
 * [Learn more](https://inertiajs.com/pages#persistent-layouts)
 */
AboutPage.layout = (page: React.ReactNode) => (
  <MainLayout title="About" children={page} />
);

export default AboutPage;