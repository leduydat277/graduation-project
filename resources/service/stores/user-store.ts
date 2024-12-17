import { create } from 'zustand';
import { shallow } from 'zustand/shallow';
import { immer } from 'zustand/middleware/immer';
import { createWithEqualityFn } from 'zustand/traditional';
import {
  persist,
  subscribeWithSelector,
  devtools,
  createJSONStorage,
} from 'zustand/middleware';

const initialUser = {
  userId: 0,
  address: '',
  email: '',
  firstName: '',
  lastname: '',
  phone: '',
};

export const userStore = createWithEqualityFn(
  devtools( 
    persist( 
      subscribeWithSelector( 
        immer<any>((set, get) => ({
          ...initialUser,
          resetState: () => set({ ...initialUser }),
          setUserId: (userId: number) => set((state) => { state.userId = userId; }),
          setAddress: (address: string) => set((state) => { state.address = address; }),
          setEmail: (email: string) => set((state) => { state.email = email; }),
          setFirstName: (firstName: string) => set((state) => { state.firstName = firstName; }),
          setLastName: (lastName: string) => set((state) => { state.lastName = lastName; }),
          setPhone: (phone: string) => set((state) => { state.phone = phone; }),
          clear: () => set({ ...initialUser }),
        }))
      ),
      {
        name: 'user-store',
        storage: createJSONStorage(() => localStorage)
      }
    )
  ),
  shallow
);
