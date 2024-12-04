import React from "react";
import { Typography, Stack, Link } from "@mui/material";

export const ContentSuccess = () => {
  const divider = (
    <Stack direction="column">
      <Typography>|</Typography>
      <Typography>|</Typography>
      <Typography>|</Typography>
    </Stack>
  );

  return (
    <>
      <Stack
        width={'84%'}
        height={300}
        mt={2}
        mb={8}
        px={5}
        borderRadius={6}
        backgroundColor={'#f2f2f2'}
        alignItems={'center'}
        sx={{
          boxShadow: "rgba(0, 0, 0, 0.1) 0px 0px 40px 6px, rgba(0, 0, 0, 0.04) 0px 0px 10px 0px",
        }}
      >
        <Typography pt={4}>
          We are pleased to inform you that your reservation request has been received and confirmed.
        </Typography>
        <Typography pt={3}>Your booking is confirmed. Thank You!</Typography>
        <Typography pt={1} variant="h5">Booking Details</Typography>
        <Stack direction="row" gap={4} pt={1}>
          <Stack direction="column">
            <Typography>Booking Id</Typography>
            <Typography>83472</Typography>
          </Stack>
          {divider}
          <Stack direction="column">
            <Typography>Check-in</Typography>
            <Typography>20-10-2025</Typography>
          </Stack>
          {divider}
          <Stack direction="column">
            <Typography>Check-out</Typography>
            <Typography>24-10-2025</Typography>
          </Stack>
          {divider}
          <Stack direction="column">
            <Typography>Total</Typography>
            <Typography>3.000.000 vnđ</Typography>
          </Stack>
          {divider}
          <Stack direction="column">
            <Typography>Status</Typography>
            <Typography>Confirmed</Typography>
          </Stack>
        </Stack>

        
        <Typography pt={3} >Note: <Link> <a href="/policy">Cancellation Policy</a></Link></Typography>
      </Stack>
    </>
  );
};
