import BookingLayout from '@/Layouts/BookingLayout';
import React from 'react';
import { useBookingStore } from '../../../service/stores/booking-store';
import { DetailContent } from './DetailContent';
import { Box, Stack, Link } from "@mui/material";
import { TopHeader } from '@/components/Header/TopHeader';

function DetailRoom({ room }) {
  console.log('detail room line 7 ', room);
  const [setPrice, setSubtitle, setIdRoom] = useBookingStore((state) => [state.setPrice, state.setSubtitle, state.setIdRoom]);

  // if (room) {
  //    setPrice(room.price);
  //   }

  // React.useEffect(() => {
  //   if (room) {
  //     setPrice(room.price);
  //     setSubtitle(room.title);
  //     setIdRoom(room.id);
  //   }
  // }, [room.id]);
  // console.log('detail room line 15 ', room);

  if (!room) {
    return <div>No room data available</div>;
  }

  const { title, id, description, room_area, price, room_type, ...rest } = room;

  return (
    <>
      <Box
        sx={{
          position: "fixed",
          top: 0,
          width: "100%",
          zIndex: 1000,
          backgroundColor: "#092533",
          boxShadow: "0 2px 5px rgba(0, 0, 0, 0.1)",
          padding: 0,
          margin: 0,
        }}
      >
        <Stack
          direction="row"
          gap={4}
          pl={7}
          sx={{
            padding: "20px 0",
            borderBottom: "1px solid #eee",
            // backgroundColor: "#f8f9fa",
          }}
        >
          <Link
            href={`/`}
            variant="h6"
            sx={{
              textDecoration: "none",
              color: "#f8f9fa",
              fontWeight: "bold",
              transition: "color 0.3s ease",
              "&:hover": {
                color: "#007bff",
              },
            }}
          >
            Home
          </Link>
          <Link
            href="/rooms"
            variant="h6"
            sx={{
              textDecoration: "none",
              color: "#f8f9fa",
              fontWeight: "bold",
              transition: "color 0.3s ease",
              "&:hover": {
                color: "#007bff",
              },
            }}
          >
            Rooms
          </Link>
          <Link
            href="/about"
            variant="h6"
            sx={{
              textDecoration: "none",
              color: "#f8f9fa",
              fontWeight: "bold",
              transition: "color 0.3s ease",
              "&:hover": {
                color: "#007bff",
              },
            }}
          >
            About
          </Link>
          <Link
            href="/policy"
            variant="h6"
            sx={{
              textDecoration: "none",
              color: "#f8f9fa",
              fontWeight: "bold",
              transition: "color 0.3s ease",
              "&:hover": {
                color: "#007bff",
              },
            }}
          >
            Policy
          </Link>
        </Stack>
      </Box>
      <DetailContent
        title={title}
        id={id}
        description={description}
        room_area={room_area}
        price={price}
        room_type={room_type}
        {...rest}
      />
    </>

  );
}

// Layout for the DetailRoom page
DetailRoom.layout = (page: React.ReactNode) => (
  <BookingLayout title={`Room Details: ${page.props.room?.title || 'Detail Room'}`}>
    {page}
  </BookingLayout>
);

export default DetailRoom;
