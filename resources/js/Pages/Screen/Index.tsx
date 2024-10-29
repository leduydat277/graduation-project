import { Link } from '@inertiajs/react';
import MainLayout from '@/Layouts/MainLayout';
import { DatePickerWithRange } from '@/Components/Reservation/DatePicker';

function ScreenPage() {
  return (
    <div>
      <DatePickerWithRange />
      <h1>Screen</h1>
    </div>
  );
}

/**
 * Persistent Layout (Inertia.js)
 *
 * [Learn more](https://inertiajs.com/pages#persistent-layouts)
 */
ScreenPage.layout = (page: React.ReactNode) => (
  <MainLayout title="Screen" children={page} />
);

export default ScreenPage;
