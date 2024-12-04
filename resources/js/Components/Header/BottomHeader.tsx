import React, { useState, useEffect } from "react";
import { Box, Stack, Link } from "@mui/material";
import { Banner } from "./Banner";
import { Profile } from "../Profile/Profile";
import { TopHeader } from "@/components/Header/TopHeader";
import { containerProps } from "@/components/Responsive";

export const BottomHeader = ({ fullWidth, ...rest }) => {
  const containerProp = fullWidth ? { width: "100%", flex: 1 } : containerProps();
  const [scrolled, setScrolled] = useState(false);

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
        {...rest}
      >
        <TopHeader px={4.5} />
        <NavLink scrolled={scrolled} />
        <Profile px={2} justifyContent="flex-end" />
      </Stack>

      {/* Banner */}
      {/* <Banner /> */}
      <Box>
        <Box
          sx={{
            position: "absolute",
            top: "50%",
            left: "50%",
            transform: "translate(-50%, -50%)",
            textAlign: "center",
            color: "white",
            zIndex: 1,
          }}
        >

        </Box>
        <Box
          sx={{
            position: "absolute",
            top: 0,
            left: 0,
            width: "100%",
            height: "100%",
            // background: "rgba(0, 0, 0, 0.5)",
            zIndex: 0,
          }}
        />
      </Box>
    </>
  );
};

const NavLink = ({ scrolled }) => {
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
  )


};
