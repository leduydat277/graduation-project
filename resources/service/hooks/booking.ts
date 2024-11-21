import { sleepRequest } from './api';
export const calculateTotalAmount = (days: number, price: number) => {
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