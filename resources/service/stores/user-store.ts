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



const initialUser = {
  userId: 0,
  address: '',
  email: '',
  firstName: '',
  lastname: '',
 phone: '',
};


export const userStore = createWithEqualityFn(
    subscribeWithSelector(
        immer<any>((set, get) => ({
          ...initialUser,
          resetState: () => set({ ...initialUser }),
          setUserId: (userId) => set((state) => { state.userId = userId; }),
          setAddress: (address) => set((state) => { state.address = address; }),
          setEmail: (email) => set((state) => { state.email = email; }),
          setFirstName: (firstName) => set((state) => { state.firstName = firstName; }),
          setLastName: (lastName) => set((state) => { state.lastName = lastName; }),
          setPhone: (phone) => set((state) => { state.phone = phone; }),
         
        }))
    )
);

