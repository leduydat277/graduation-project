import BookingLayout from '@/Layouts/BookingLayout';
import React, { useEffect } from 'react';
import { useBookingStore } from '../../../service/stores/booking-store';
import { DetailContent } from './DetailContent';
import { Box, Stack, Link } from "@mui/material";
import { TopHeader } from '@/components/Header/TopHeader';
import { Footer } from '@/components/Footer/Footer';
import { BottomHeader } from '@/components/Header/BottomHeader';

function DetailRoom({ room }) {
  console.log('detail room line 7 ', room);

  const [setPrice, setSubtitle, setIdRoom] = useBookingStore((state) => [
    state.setPrice,
    state.setSubtitle,
    state.setIdRoom
  ]);

  // Chỉ khi có room, bạn mới cần gọi setIdRoom, setPrice và setSubtitle
  useEffect(() => {
    if (room) {
      setPrice(room.price); // Cập nhật giá phòng
      setSubtitle(room.title); // Cập nhật tiêu đề
      setIdRoom(room.id); // Cập nhật id phòng
    }
  }, [room, setPrice, setSubtitle, setIdRoom]); // Đảm bảo chạy lại mỗi khi room thay đổi

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
          left: 0,
           marginBottom: '30px'
          
        }}
      >
        <Stack
          direction="row"
          gap={4}
          pl={7}
          sx={{
            height: '70px',

            borderBottom: "1px solid #eee",
            display: "flex",
            alignItems: "center",
           
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
      {/* <BottomHeader /> */}
      
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
  <>
  <BookingLayout title={`Room Details: ${page.props.room?.title || 'Detail Room'}`}>
    {page}
  </BookingLayout>
  
  <Footer />
  </>
);

export default DetailRoom;
