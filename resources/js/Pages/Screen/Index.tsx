import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from './../../shared/RoomSearchBar';
import { RoomItem } from '../../shared/Room/RoomItem';
import { RoomList } from '../../shared/Room/RoomList';
import { Box } from '@mui/material';
import { grey, pink } from '@mui/material/colors';
import '@fontsource/roboto/300.css';


function ScreenPage() {
  return (
    <>
      <Box sx={{ backgroundColor: pink[200] }} >
      <RoomList />
      
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
