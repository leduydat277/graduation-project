import React, { useState, useEffect } from "react";
import { Link } from "@inertiajs/react";
import { Box, Typography, Card, CardContent, Snackbar } from "@mui/material";
import { grey } from "@mui/material/colors";
import { useBookingStore } from "../../../service/stores/booking-store";
import { CarouselCustom } from "../CarouselCustom";

export const RoomItem = (props) => {
  const { id, title, subtitle="", description, status, price, image_room } = props;
  console.log('image_room', image_room)

  const [setPrice] = useBookingStore((state) => [state.setPrice]);
  const [toastOpen, setToastOpen] = useState(false);

  // let imageRoomArray = JSON.parse(image_room);

  // console.log("Sanitized image room:", imageRoomArray);

  useEffect(() => {
    setPrice(price);
  }, [price, setPrice]);

 

  const isUnavailable = status === "Occupied" || status === "Maintenance";
  const message =
    status === "Occupied"
      ? "Phòng đã được sử dụng!"
      : status === "Maintenance"
      ? "Phòng đang sửa chữa!"
      : "";

  const handleLinkClick = (e) => {
    if (isUnavailable) {
      e.preventDefault();
      setToastOpen(true);
    }
  };

  const handleCloseToast = () => setToastOpen(false);

  return (
    <>
      <Link href={`/detail/${id}`} onClick={handleLinkClick}>
        <Card
          sx={{
            width: "100%",
            maxWidth: 450,
            backgroundColor: "#fff",
            borderRadius: 4,
            transition: "transform 0.2s ease",
            boxShadow: "rgba(0, 0, 0, 0.1) 0px 10px 20px 3px, rgba(0, 0, 0, 0.04) 0px 10px 10px 0px",
            transform: isUnavailable ? "none" : "scale(1)",
            opacity: isUnavailable ? 0.5 : 1,
            "&:hover": {
              backgroundColor: isUnavailable ? "#fff" : "#f9f9f9",
              transform: isUnavailable ? "none" : "scale(1.05)",
            },
          }}
        >
          <CardContent>
            <CarouselCustom image_room={image_room} />
            <Typography variant="h5" component="div" pt={2}>
              {title}
            </Typography>
            <Typography variant="subtitle1" color="text.secondary">
              {subtitle}
            </Typography>
            <Typography variant="body2" color="text.secondary" sx={{ mt: 1 }}>
              {description}
            </Typography>
          </CardContent>
        </Card>
      </Link>

      <Snackbar
        open={toastOpen}
        onClose={handleCloseToast}
        autoHideDuration={3000}
        message={message}
        sx={{
          "& .MuiSnackbarContent-root": {
            backgroundColor: grey[50],
            color: grey[800],
          },
        }}
      />
    </>
  );
};
