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
import { rest } from "lodash"

export const GuestCount = (props) => {
  const {position, ...rest} = props
  return (
    <Dialog >
      <DialogTrigger asChild>
        <Button variant="outline" 
        sx={{ 
          size: 14,
          fonWeight: 600,
        }}
        >Type room & Number guest</Button>
      </DialogTrigger>
      <DialogContent position={position}>
       <QuantitySelectGuest />
      </DialogContent>
    </Dialog>
  )
}
