"use client"

import * as React from "react"
import { addDays, format } from "date-fns"
import { Calendar as CalendarIcon } from "lucide-react"
import { DateRange } from "react-day-picker"

import { cn } from "@/lib/utils"
import { Button } from "@/components/ui/button"
import { Calendar } from "@/components/ui/calendar"
import {
  Popover,
  PopoverContent,
  PopoverTrigger,
} from "@/components/ui/popover"

export function DatePickerWithRange({
  className,
  type,
  ...props
}: React.HTMLAttributes<HTMLDivElement>) {
  const [date, setDate] = React.useState<{from: number | null; to: number | null}>({
    from: +new Date(),
    to: +addDays(new Date(2022, 0, 20), 20),
  })



  return (
    <div className={cn("grid gap-2", className)}>
      <Popover>
        <PopoverTrigger asChild>
          <Button
            id="date"
            variant={"outline"}
            className={cn(
              "w-[300px] justify-start text-left font-normal",
              !date && "text-muted-foreground"
            )}
          >
            <CalendarIcon />
            {date?.from ? (
              date.to ? (
                <>
                  {format(date.from, "LLL dd, y")} -{" "}
                  {format(date.to, "LLL dd, y")}
                </>
              ) : (
                format(date.from, "LLL dd, y")
              )
            ) : (
              <span>Pick a date</span>
            )}
          </Button>
        </PopoverTrigger>
        <PopoverContent className="w-auto p-0" align="start">
          <Calendar
          onChange={(rangeDate: { from: Date | null; to: Date | null }) => {
            console.log('OnchangeDate2', rangeDate?.to)
          }}
          
           {...type}
            initialFocus
            mode="range"
            defaultMonth={date?.from}
            selected={{from: date.from? new Date(date.from) : null, to: date.to ? new Date(date.to) : null}}
            onSelect={(rangeDate) => {
              console.log('OnchangeDate', rangeDate?.to)
              setDate({from: +rangeDate?.from || null, to: +rangeDate?.to || null})
            }}
            
            numberOfMonths={2}
          />
        </PopoverContent>
      </Popover>
    </div>
  )
}
