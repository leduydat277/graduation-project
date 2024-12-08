import { sleepRequest } from './api';
export const allPayment = async () => {
    try {
    const payments = await sleepRequest(`api/all-payment`, {
        method: 'GET'
      });
      return payments;
    } catch (error: any) {
      console.error('searchRoomsById Error:', error.message);
      return { error: error.message };
    }
    return {};
}  