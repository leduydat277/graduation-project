import BookingLayout from '@/Layouts/BookingLayout';
import React from 'react';
import { useBookingStore } from '../../../service/stores/booking-store';
import { DetailContent } from './DetailContent';

function DetailRoom({ room }) {
  const [setPrice, setSubtitle, setIdRoom] = useBookingStore((state) => [state.setPrice, state.setSubtitle, state.setIdRoom]);
  React.useEffect(() => {
    if (room) {
      setPrice(room.price);
      setSubtitle(room.title);
      setIdRoom(room.id);
    }
  }, [room, setPrice, setSubtitle]);

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
