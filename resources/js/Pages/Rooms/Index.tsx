import React from "react";
import { Stack } from "@mui/material";
import MainLayout from '@/Layouts/MainLayout';
import { RoomList } from "@/shared/Room/RoomList";

function Rooms() {
    return (
        <>
        <Stack px={2}>

      
        <RoomList /> 
         </Stack>

        </>
    );
}


Rooms.layout = (page: React.ReactNode) => (
    <MainLayout title={`Rooms`}>
      {page}
    </MainLayout>
  );
  

export default Rooms;