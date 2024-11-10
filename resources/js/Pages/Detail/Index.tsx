
import BookingLayout from '@/Layouts/BookingLayout';
import React from 'react';
import HomeBannner1 from '../../../assets/HomeBanner1.jpg';
import { useBookingStore } from '../../../service/stores/booking-store';
import { DetailContent } from './DetailContent';
function DetailRoom() {

  const data = {
    id: 1,
    title: "Paris Bastille Opera 11th",
    subtitle: "Vibrant economy hotel, open to everyone",
    type: "VIP",
    price: 30000,
    status: "Active",
    description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
    image: HomeBannner1
  }
  const { title, subtitle, type, price, status, description, image } = data
  const [setTitle, setSubtitle] = useBookingStore((state) => [state.setTitle, state.setSubtitle]);
  setTitle(title)
  setSubtitle(subtitle)
  return (
    <>
<DetailContent {...data} />
    </>
  );
}
DetailRoom.layout = (page: React.ReactNode) => (
  <BookingLayout title="DetailRoom" children={page} />
);

export default DetailRoom;
