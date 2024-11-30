import React from "react";
import { Stack } from "@mui/material";
import MainLayout from '@/Layouts/MainLayout';
import { BannerSuccess } from "./BannerSuccess";
import { ContentSuccess } from "./ContentSuccess";
function CheckOutScreen() {
    return (
        <>
        <Stack px={2} alignItems={'center'}>

        <BannerSuccess/>
        <ContentSuccess/>
      
         </Stack>

        </>
    );
}


CheckOutScreen.layout = (page: React.ReactNode) => (
    <MainLayout title={`CheckOutScreen`}>
      {page}
    </MainLayout>
  );
  

export default CheckOutScreen;