import { create } from 'zustand';
import { addDays } from 'date-fns';
import { shallow } from 'zustand/shallow';
import { immer } from 'zustand/middleware/immer';
import { createWithEqualityFn } from 'zustand/traditional';

import {
  persist,
  devtools,
  subscribeWithSelector,
  createJSONStorage
} from 'zustand/middleware';

const initialBookingRange = {
  checkInDate: new Date(),
  checkOutDate: addDays(new Date(), 1),
  typeRoom: 'normal',
  title: '',
  idRoom: 0,
  price: 0,
  subtitle: '',
  totalDays: 1,
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
        immer <any>((set, get) => ({
          ...initialBookingRange,
          resetState: () => set({ ...initialBookingRange }),
          setIsOpen: (isOpen) => set((state) => { state.isOpen = isOpen; }),
          setCheckInDate: (checkInDate) => set((state) => { 
            state.checkInDate = checkInDate; 
            state.totalDays = state.checkOutDate ? Math.floor((state.checkOutDate - checkInDate) / (1000 * 60 * 60 * 24)) : 0;
          }),
          setCheckOutDate: (checkOutDate) => set((state) => { 
            state.checkOutDate = checkOutDate; 
            state.totalDays = state.checkInDate ? Math.floor((checkOutDate - state.checkInDate) / (1000 * 60 * 60 * 24)) : 0;
          }),
          setIdRoom: (idRoom) => set((state) => { state.idRoom = idRoom; }),
          setTitle: (title) => set((state) => { state.title = title; }),
          setSubtitle: (subtitle) => set((state) => { state.subtitle = subtitle; }),
          setTotalPrice: (totalPrice) => set((state) => { state.totalPrice = totalPrice; }),
          setPrice: (price) => set((state) => { state.price = price; }),
          setNumberOfGuests: (numberOfGuests) => set((state) => { state.numberOfGuests = numberOfGuests; }),
          setNumberOfChildren: (numberOfChildren) => set((state) => { state.numberOfChildren = numberOfChildren; }),
          setNote: (note) => set((state) => { state.note = note; }),
          clear: () => set({ ...initialBookingRange }),
        }))
      ),
      {
        name: 'booking-store',
        storage:createJSONStorage(() => localStorage),
      }
    )
  ),
  shallow
);
