
import BookingLayout from '@/Layouts/BookingLayout';
import React from 'react';

function CheckOut() {
return (

    <div>
        <h1>Checkout</h1>
    </div>
)
  
}
CheckOut.layout = (page: React.ReactNode) => (
  <BookingLayout title="CheckOut" children={page} />
);

export default CheckOut;
