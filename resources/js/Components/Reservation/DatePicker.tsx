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

    const newFrom = rangeDate?.from
      ? Date.UTC(rangeDate.from.getFullYear(), rangeDate.from.getMonth(), rangeDate.from.getDate())
      : null;

    const newTo = rangeDate?.to
      ? Date.UTC(rangeDate.to.getFullYear(), rangeDate.to.getMonth(), rangeDate.to.getDate())
      : null;

    setDate({ from: newFrom, to: newTo });


    if (newFrom) {
      setCheckInDate(newFrom);
      console.log('Updated checkInDate:', newFrom);
    }

    if (newTo) {
      setCheckOutDate(newTo);
      console.log('Updated checkOutDate:', newTo);
    }
  };



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
