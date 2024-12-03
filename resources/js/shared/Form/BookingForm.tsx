import { Typography, Stack } from "@mui/material";
import { Button } from "@/components/ui/button"
import { RoomSearchBar } from "../Room/RoomSearchBar";
import { Booking, calculateTotalAmount } from "../../../service/hooks/booking";
import { useBookingStore } from "../../../service/stores/booking-store";
import { userStore } from "../../../service/stores/user-store"
import { CalendarClock } from "lucide-react";
import { grey } from "@mui/material/colors";
import {formatPrice} from '../../../service/hooks/price'

export const BookingForm = (props) => {
  const { type, status, description, ...rest } = props

  const [checkInDate, checkOutDate, totalDays, setTotalPrice, title, subtitle, price, idRoom, clear, setPrice] = useBookingStore((state) => [
    state.checkInDate,
    state.checkOutDate,
    state.totalDays,
    state.setTotalPrice,
    state.title,
    state.subtitle,
    state.price,
    state.idRoom,
    state.clear,
    state.setPrice

  ]);
  console.log('price  : ', price);
  const [userId, address, email, firstName, lastName, phone] = userStore((state) => [
    state.userId,
    state.address,
    state.email,
    state.firstName,
    state.lastName,
    state.phone
  ])
  const ps: any = []
  const validateLogin = () => {
    if (checkInDate < checkOutDate && checkInDate > Date.now() && checkOutDate > Date.now()) {

      return true;
    }
    return false;
  }

  const totalPrice = calculateTotalAmount(totalDays, price)
  // if (totalPrice > 0 && totalDays > 0) {
  //   setTotalPrice(totalPrice)
  // }

  // React.useEffect(() => {

  //   const uid = userStore.getState().userId;
  //   if (!uid) {
  //     const queryString = paramsStringify({
  //       redirect: '/checkout-screen',
  //     });
  //     navigate(`/login?${queryString}`, { replace: true });
  //   }
  // }, [navigate, userStore]);
  ps.push(validateLogin())
  ps.push(clear())




const onPress = async () => {
  await Promise.all(ps)
  console.log('onPress');
  const bookingData = {
  user_id: 5,
  check_in_date: checkInDate,
  check_out_date: checkOutDate,
  first_name: "John",
  last_name: "Doe",
  address: "123 Main St",
  total_price: 1000,
  tien_coc: 100,
  created_at: Date.now(),
  phone: "0123456789",
  email: "johndoe@example.com",
  room_id: idRoom || 5
  }
  try {
    const booking = await Booking(bookingData);

    console.log('Booking successful', booking.paymentUrl);
    if (booking.paymentUrl) {
      window.location.href = booking.paymentUrl;
    }
  } catch (error) {
    console.error('Booking failed:', error);
  }
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

        <Typography variant="h6" pb={1}>Total: {formatPrice(totalPrice)}</Typography>
      <Button onClick={onPress} variant="outline">Thanh Toán</Button>


      </Stack>
    </>
  )
}
