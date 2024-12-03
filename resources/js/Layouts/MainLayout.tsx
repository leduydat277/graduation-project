import { Head } from '@inertiajs/react';
import '@fontsource/roboto/400.css';



import { BottomHeader } from '@/components/Header/BottomHeader';
// import { FooterSection } from './../components/Footer/Footer';


interface MainLayoutProps {
  title?: string;
  children: React.ReactNode;
}

export default function MainLayout({ title, children }: MainLayoutProps) {
  return (
    <>
      <Head title={title} />
      <BottomHeader />
      {children}
      {/* <FooterSection/> */}
    </>
  );
}
