import { Head } from '@inertiajs/react';




import { BottomHeader } from '@/components/Header/BottomHeader';


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
    </>
  );
}
