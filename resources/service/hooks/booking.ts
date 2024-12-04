import { sleepRequest } from './api';
export const calculateTotalAmount = (days: number, price: number) => {
   console.log('days: ', days, 'price: ', price)
   const total = days * price;
   return total
}
export const Booking =  async (data: any) => {
 const booking = await sleepRequest('api/booking', {
    method: 'POST',
    data: data
  });
  return booking
}
