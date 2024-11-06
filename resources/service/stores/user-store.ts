import { create } from 'zustand';
import { addDays, differenceInDays } from "date-fns";
import { shallow } from 'zustand/shallow'
import { immer } from 'zustand/middleware/immer'
import { createWithEqualityFn } from 'zustand/traditional'
import {
  persist,
  subscribeWithSelector,
  devtools,
  createJSONStorage,
} from 'zustand/middleware'



const initialDateRange = {
  checkIn: new Date(),
  checkOut: addDays(new Date(), 1),
 
};


export const useBookingStore = createWithEqualityFn(
    subscribeWithSelector(
        immer<any>((set, get) => ({
            
        }))
    )
);

export default useBookingStore;
