import { Typography, Stack} from "@mui/material";
import React from "react";
export const BannerSuccess = () => {
    return (
        <Stack 
        width={'84%'}
        height={130}
        justifyContent={'center'}
        mt={10}
        borderRadius={6}
        sx={{
            boxShadow: "rgba(0, 0, 0, 0.1) 0px 0px 40px 6px, rgba(0, 0, 0, 0.04) 0px 0px 10px 0px"

        }}>
     <Typography variant="h3" component="div" textAlign={'center'}>
            Booking Confirmed
     </Typography>
     </Stack>
   
    )
}