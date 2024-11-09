import { Typography, Stack } from "@mui/material";
import { RoomSearchBar } from "../Room/RoomSearchBar";
import { calculateTotalAmount } from "../../../service/hooks/booking";
import { useBookingStore } from "../../../service/stores/booking-store";
import { CalendarClock } from "lucide-react";
import { grey } from "@mui/material/colors";
export const BookingForm = (props) => {
  const { title, subtitle, type, price, status, description, ...rest } = props
  const [checkInDate, checkOutDate, totalDays, setTotalPrice] = useBookingStore((state) => [
    state.checkInDate,
    state.checkOutDate,
    state.totalDays,
    state.setTotalPrice
  ]);


  const totalPrice = calculateTotalAmount(totalDays, price)
  if (totalPrice > 0 && totalDays > 0) {
    setTotalPrice(totalPrice)
  }
  return (
    <>
      <Stack
        w="100%"
        borderRadius = {4}
        border={"1px solid " + grey[300]}
        p={2}
      >
        <Typography variant="h6">{title}</Typography>
        <Typography variant="subtitle2" pt={1}>{subtitle}</Typography>
        <Stack direction={"row"} pt={1}>
          <CalendarClock />
          <Typography pl={2}> Check-in 2:00 PM | Check-out 12:00 PM</Typography>
        </Stack>
        <RoomSearchBar position={'detail'} />
        <Typography variant="h6">Total: {totalPrice}</Typography>
      </Stack>
    </>
  )
}