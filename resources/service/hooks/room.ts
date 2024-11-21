import { sleepRequest } from './api';

export const searchRoomsById = async (roomId: number) => {
    try {
    const roomDetail = await sleepRequest(`api/detail/${roomId}`, {
        method: 'GET'
      });
      return roomDetail;
    } catch (error: any) {
      console.error('searchRoomsById Error:', error.message);
      return { error: error.message };
    }
    return {};
  };

export const allRooms = async () => {
    try {
    const roomDetail = await sleepRequest(`api/all-rooms`, {
        method: 'GET'
      });
      return roomDetail;
    } catch (error: any) {
      console.error('searchRoomsById Error:', error.message);
      return { error: error.message };
    }
    return {};
}  