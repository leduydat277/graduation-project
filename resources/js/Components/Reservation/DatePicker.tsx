'use client';

import * as React from 'react';
import { addDays, format } from 'date-fns';
import { Calendar as CalendarIcon } from 'lucide-react';
import { DateRange } from 'react-day-picker';
import { cn } from '@/lib/utils';
import { Button } from '@/components/ui/button';
import { Calendar } from '@/components/ui/calendar';
import {
  Popover,
  PopoverContent,
  PopoverTrigger
} from '@/components/ui/popover';
import { useBookingStore } from './../../../service/stores/booking-store';

export function DatePickerWithRange({
  className,
  type,
  ...props
}: React.HTMLAttributes<HTMLDivElement>) {
  const [date, setDate] = React.useState<{
    from: number | null;
    to: number | null;
  }>({
    from: +new Date(),
    to: +addDays(new Date(), 20)
  });

  const [
    setCheckInDate,
    setCheckOutDate,
    checkInDate,
    checkOutDate,
    setTotalPrice
  ] = useBookingStore(state => [
    state.setCheckInDate,
    state.setCheckOutDate,
    state.checkInDate,
    state.checkOutDate,
    state.setTotalPrice
  ]);

  const handleDateChange = (rangeDate: DateRange | undefined) => {
    // Chuyển đổi từ ngày sang timestamp, sử dụng Date.UTC để tránh lỗi múi giờ
    const newFrom = rangeDate?.from
      ? Date.UTC(rangeDate.from.getFullYear(), rangeDate.from.getMonth(), rangeDate.from.getDate()) // Giữ giờ là 00:00:00 UTC
      : null;

    const newTo = rangeDate?.to
      ? Date.UTC(rangeDate.to.getFullYear(), rangeDate.to.getMonth(), rangeDate.to.getDate()) // Giữ giờ là 00:00:00 UTC
      : null;

    setDate({ from: newFrom, to: newTo });

    // Gửi timestamp vào booking store
    if (newFrom) {
      setCheckInDate(newFrom); // Cập nhật check-in date với timestamp
      console.log('Updated checkInDate:', newFrom);
    }

    if (newTo) {
      setCheckOutDate(newTo); // Cập nhật check-out date với timestamp
      console.log('Updated checkOutDate:', newTo);
    }
  };


  // React.useEffect(() => {
  //   // Ensure that after setting dates, the totalDays and totalPrice are calculated correctly.
  //   if (checkInDate && checkOutDate) {
  //     const days = Math.ceil((checkOutDate - checkInDate) / (1000 * 60 * 60 * 24));
  //     setTotalPrice(days * 1000);  // Giả sử giá mỗi đêm là 1000 (bạn có thể thay đổi giá trị này)
  //   }
  // }, [checkInDate, checkOutDate, setTotalPrice]); // React to changes in checkInDate and checkOutDate

  return (
    <div className={cn('grid gap-2', className)}>
      <Popover>
        <PopoverTrigger asChild>
          <Button
            id="date"
            variant="outline"
            className={cn(
              'w-[300px] justify-start text-left font-normal',
              !date && 'text-muted-foreground'
            )}
          >
            <CalendarIcon />
            {date?.from ? (
              date.to ? (
                <>
                  {format(date.from, 'LLL dd, y')} -{' '}
                  {format(date.to, 'LLL dd, y')}
                </>
              ) : (
                format(date.from, 'LLL dd, y')
              )
            ) : (
              <span>Pick a date</span>
            )}
          </Button>
        </PopoverTrigger>
        <PopoverContent className="w-auto p-0" align="start">
          <Calendar
            {...type}
            initialFocus
            mode="range"
            defaultMonth={date?.from ? new Date(date.from) : undefined}
            selected={{
              from: date.from ? new Date(date.from) : null,
              to: date.to ? new Date(date.to) : null
            }}
            onSelect={handleDateChange}
            numberOfMonths={2}
          />
        </PopoverContent>
      </Popover>
    </div>
  );
}
