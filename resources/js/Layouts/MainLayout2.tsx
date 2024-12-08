import { Head } from '@inertiajs/react';
import '@fontsource/roboto/400.css';



import { BottomHeader } from '@/components/Header/BottomHeader';
import { Header } from '@/components/Header/Header';
import { useState } from 'react';
import { Stack } from '@mui/material';
// import { FooterSection } from './../components/Footer/Footer';


interface MainLayoutProps {
  title?: string;
  children: React.ReactNode;
}

export default function MainLayout2({ title, children }: MainLayoutProps) {
 
  return (
    <>
      <Head title={title} />
     <Header pb={10} />
     <Stack pt={4}>
      {children}
      </Stack>
      {/* <FooterSection/> */}
    </> 
  );
}
