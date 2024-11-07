import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from './../../shared/RoomSearchBar';

import React from 'react';


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