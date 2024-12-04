import BookingLayout from '@/Layouts/BookingLayout';
import React, { useEffect } from 'react';
import { useBookingStore } from '../../../service/stores/booking-store';
import { DetailContent } from './DetailContent';

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
    <DetailContent
      title={title}
      id={id}
      description={description}
      room_area={room_area}
      price={price}
      room_type={room_type}
      {...rest}
    />
  );
}

// Layout for the DetailRoom page
DetailRoom.layout = (page: React.ReactNode) => (
  <BookingLayout title={`Room Details: ${page.props.room?.title || 'Detail Room'}`}>
    {page}
  </BookingLayout>
);

export default DetailRoom;
