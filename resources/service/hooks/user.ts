import { sleepRequest } from './api';
export const logined = async (email: string) => {
    try {
    const user = await sleepRequest(`api/logined/?email=${email}`, {
        method: 'GET'
      });
      return user;
    } catch (error: any) {
      console.error('searchRoomsById Error:', error.message);
      return { error: error.message };
    }
    return {};
} 