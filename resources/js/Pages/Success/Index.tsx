import React, { useState, useEffect } from "react";
import MainLayout from '@/Layouts/MainLayout';
import { BannerSuccess } from "./BannerSuccess";
import { ContentSuccess } from "./ContentSuccess";
import { Box, Stack, Link } from "@mui/material";
import { TopHeader } from "@/components/Header/TopHeader";
import { containerProps } from "@/components/Responsive";
import { Profile } from "@/components/Profile/Profile";
import { Banner } from "@/components/Header/Banner";

const CheckOutScreen = () => {
  const [scrolled, setScrolled] = useState(false);
  const fullWidth = true; // Hoặc điều kiện để xác định fullWidth

  const containerProp = fullWidth ? { width: "100%", flex: 1 } : containerProps();

  useEffect(() => {
    const handleScroll = () => {
      setScrolled(window.scrollY > 0); // Theo dõi trạng thái cuộn
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
          position: "fixed", // Header cố định
          top: 0,
          zIndex: 1000, // Luôn đè lên banner
          backgroundColor: scrolled ? "#092533" : "transparent", // Đổi nền khi cuộn
          transition: "background-color 0.3s ease",
          color: "white",
          ...containerProp,
        }}
      >
        <TopHeader px={4.5} />
        <NavLink scrolled={scrolled} />
        <Profile px={2} justifyContent="flex-end" />
      </Stack>

     
     
      <Box
        sx={{
          position: "absolute",
          top: "50%",
          left: "50%",
          transform: "translate(-50%, -50%)", // Căn giữa theo cả chiều dọc và chiều ngang
          textAlign: "center",
          zIndex: 2, // Đảm bảo Content nằm trên Banner
          width: "100%",
        }}
      >
        <Stack px={2} alignItems="center" backgroundColor="transparent">
          <BannerSuccess />
          <ContentSuccess />
        </Stack>
      </Box>
    </>
  );
};

// NavLink Component
export const NavLink = ({ scrolled }) => {
  return (
    <Stack direction="row" gap={2} pl={7}>
      <Link href={`/`} variant="h6" sx={{ textDecoration: "none", color: "inherit" }}>
        Home
      </Link>
      <Link
        href="/rooms"
        variant="h6"
        sx={{
          textDecoration: "none",
          color: scrolled ? "white" : "#fff",
          transition: "color 0.3s ease",
        }}
      >
        Rooms
      </Link>
      <Link
        href="/about"
        variant="h6"
        sx={{
          textDecoration: "none",
          color: scrolled ? "white" : "#fff",
          transition: "color 0.3s ease",
        }}
      >
        About
      </Link>
      <Link
        href="/policy"
        variant="h6"
        sx={{
          textDecoration: "none",
          color: scrolled ? "white" : "#fff",
          transition: "color 0.3s ease",
        }}
      >
        Policy
      </Link>
    </Stack>
  );
};

CheckOutScreen.layout = (page: React.ReactNode) => (
  <MainLayout title="CheckOutScreen">
    {page}
  </MainLayout>
);

export default CheckOutScreen;
