import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import React from 'react';


function DetailRoom() {
  return (
    <>
      <h1>Detail Room</h1>
    </>
  );
}



DetailRoom.layout = (page: React.ReactNode) => (
  <MainLayout title="DetailRoom" children={page} />
);

export default DetailRoom;