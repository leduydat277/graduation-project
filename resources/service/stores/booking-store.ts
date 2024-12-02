import { create } from 'zustand';
import { addDays } from 'date-fns';
import { shallow } from 'zustand/shallow';
import { immer } from 'zustand/middleware/immer';
import { createWithEqualityFn } from 'zustand/traditional';
import {
  persist,
  devtools,
  subscribeWithSelector,
  createJSONStorage,
} from 'zustand/middleware';
const calculateTotalDays = (checkInDate, checkOutDate) => {
  if (checkInDate && checkOutDate && checkOutDate > checkInDate) {
    const totalDays = Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24)); 
    console.log('totalDays: ', totalDays);
    return totalDays;
  }
  return 2; 
};


const initialBookingRange = {
  checkInDate: Date.now(), 
  checkOutDate: addDays(new Date(), 1).getTime(), 
  title: '',
  idRoom: 0,
  price: 0,
  subtitle: '',
  totalDays: 0,
  totalPrice: 0,
  numberOfGuests: 1,
  numberOfAdults: 1,
  numberOfChildren: 0,
  note: '',
};


export const useBookingStore = createWithEqualityFn(
  devtools(
    persist(
      subscribeWithSelector(
        immer((set, get) => ({
          ...initialBookingRange,
          resetState: () => set({ ...initialBookingRange }),
          setCheckInDate: (checkInDate) =>
            set((state) => {
              state.checkInDate = checkInDate;
              state.totalDays = calculateTotalDays(checkInDate, state.checkOutDate);
              console.log('Updated totalDays after checkInDate change: ', state.totalDays); 
            }),
          
            setCheckOutDate: (checkOutDate) =>
              set((state) => {
                state.checkOutDate = checkOutDate;
                const totalDays = calculateTotalDays(state.checkInDate, checkOutDate);
                state.totalDays = totalDays; 
                console.log('Updated totalDays after checkOutDate change: ', totalDays); 
              }),
            setTotalDays: (totalDays) =>
              set((state) => {
                state.totalDays = totalDays;
                console.log('Updated totalDays via setTotalDays: ', totalDays); 
              }),
          setPrice: (price) =>
            set((state) => {
              state.price = price;
              if (state.totalDays > 0) {
                state.totalPrice = state.totalDays * price;
              }
            }),

          setIdRoom: (idRoom) => set((state) => { state.idRoom = idRoom; }),
          setTitle: (title) => set((state) => { state.title = title; }),
          setSubtitle: (subtitle) => set((state) => { state.subtitle = subtitle; }),
          setNumberOfGuests: (numberOfGuests) => set((state) => { state.numberOfGuests = numberOfGuests; }),
          setNumberOfChildren: (numberOfChildren) => set((state) => { state.numberOfChildren = numberOfChildren; }),
          setNote: (note) => set((state) => { state.note = note; }),
          clear: () => set({ ...initialBookingRange }),
        }))
      ),
      {
        name: 'booking-store',
        storage: createJSONStorage(() => localStorage),
      }
    )
  ),
  shallow
);
