import BookingLayout from '@/Layouts/BookingLayout';
import React, { useEffect } from 'react';
import { useBookingStore } from '../../../service/stores/booking-store';
import { DetailContent } from './DetailContent';

function DetailRoom({ room }) {
console.log('room:line7', room);
  const [setPrice, setSubtitle, setIdRoom, setType, setTapacity] = useBookingStore((state) => [
    state.setPrice,
    state.setSubtitle,
    state.setIdRoom,
    state.setType,
    state.setTapacity
  ]);


  useEffect(() => {
    if (room) {

      setPrice(room.price);
      setSubtitle(room.title);
      setIdRoom(room.id); 
      // setType(room.room_type.type);
      setTapacity(room.max_people);
    }
  }, [room, setPrice, setSubtitle, setIdRoom]);

  if (!room) {
    return <div>No room data available</div>;
  }

  const { title, id, description, room_area, price, room_type, max_people, ...rest } = room;

  return (
    <DetailContent
      title={title}
      id={id}
      max_people={max_people}
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
  <BookingLayout  title={`Room Details: ${page.props.room?.title || 'Detail Room'}`}>
    {page}
  </BookingLayout>
);

export default DetailRoom;
