import { Button } from "@/components/ui/button"
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from "@/components/ui/dialog"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"
import { Box } from "@mui/material"
import { QuantitySelectGuest } from "./QuantitySelectGuest"

export const GuestCount = () => {
  return (
    <Dialog >
      <DialogTrigger asChild>
        <Button variant="outline" 
        sx={{ 
          size: 14,
          fonWeight: 600,
        }}
        >Chọn loại phòng & số người</Button>
      </DialogTrigger>
      <DialogContent >
       <QuantitySelectGuest />
        <DialogFooter>
          <Button type="submit">Xác nhận </Button>
        </DialogFooter>
      </DialogContent>
    </Dialog>
  )
}
