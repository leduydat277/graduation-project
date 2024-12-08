
import React, { useState, useEffect } from "react";
import MainLayout from '@/Layouts/MainLayout';

import { Box, Stack, Link } from "@mui/material";
import { TopHeader } from "@/components/Header/TopHeader";
import { containerProps } from "@/components/Responsive";
import { Profile } from "@/components/Profile/Profile";
import { Banner } from "@/components/Header/Banner";
import { DetailConfirm } from "./DetailConfirm";

const Confirmation = () => {
  const [scrolled, setScrolled] = useState(false);
  const fullWidth = true; 

  const containerProp = fullWidth ? { width: "100%", flex: 1 } : containerProps();

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 0);
    };

    window.addEventListener("scroll", handleScroll);
    return () => window.removeEventListener("scroll", handleScroll);
  }, []);

  return (
    <>
      {/* Header */}
      <Stack
        direction="row"
        alignItems="center"
        pb={2}
        pt={3}
        sx={{
          width: "100%",
          position: "fixed", 
          top: 0,
          zIndex: 1000, 
          backgroundColor: scrolled ? "#092533" : "transparent", 
          transition: "background-color 0.3s ease",
          color: "white",
          ...containerProp,
        }}
      >
        <TopHeader px={4.5} />
      
        <Profile px={2} justifyContent="flex-end" />
      </Stack>

     
     
      <Box
        sx={{
          position: "absolute",
          top: "50%",
          left: "50%",
          transform: "translate(-50%, -50%)",
          textAlign: "center",
          zIndex: 2, 
          width: "100%",
        }}
      >
        <Stack px={2} alignItems="center" backgroundColor="transparent">
        <DetailConfirm />
        </Stack>
      </Box>
    </>
  );
};


Confirmation.layout = (page: React.ReactNode) => (
  <MainLayout title="Confirmation">
    {page}
  </MainLayout>
);

export default Confirmation;
