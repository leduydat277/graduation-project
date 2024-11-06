import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from './../../shared/RoomSearchBar';

import { Box } from '@mui/material';
import { grey, pink } from '@mui/material/colors';


function ScreenPage() {
  return (
    <>

      <Box sx={{ backgroundColor: pink[200] }} >
        <RoomSearchBar />
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
