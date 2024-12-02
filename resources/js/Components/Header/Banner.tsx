import React, { useState, useEffect } from 'react';
import { Box } from '@mui/material';

export const Banner = () => {
  const images = [
    "https://vielimousine.com/wp-content/uploads/2023/09/Khach-san-Park-Hyatt.webp",
    "https://wallpapers.com/images/featured/hotel-room-background-qad26bgd35ll4qv6.jpg",
    "https://duopig.com/wp-content/uploads/2015/11/Ch%E1%BB%A5p-h%C3%ACnh-c%C4%83n-h%E1%BB%99-6.jpg",
  ];

  const [currentIndex, setCurrentIndex] = useState(0);

  useEffect(() => {
    const interval = setInterval(() => {
      setCurrentIndex((prevIndex) =>
        prevIndex === images.length - 1 ? 0 : prevIndex + 1
      );
    }, 4000);

    return () => clearInterval(interval); 
  }, [images.length]);

  return (
    <Box
      sx={{
        width: "100%",
        height: "100vh", 
        position: "relative",
        overflow: "hidden", 
      }}
    >

      <Box
        sx={{
          position: "absolute",
          width: "100%",
          height: "100%",
        }}
      >
        <img
          src={images[currentIndex]}
          alt={`Slide ${currentIndex + 1}`}
          style={{
            width: "100%",
            height: "100%",
            objectFit: "cover", 
            transition: "opacity 0.8s ease-in-out",
            imageRendering: "auto", 
          }}
        />
      </Box>
    </Box>
  );
};
