import { Stack } from "@mui/material"
import { Profile } from "../Profile/Profile"
import { NavLink2 } from "./BottomHeader"
import { TopHeader } from "./TopHeader"
import { useState } from "react"

export const Header = (props) => {
    const [scrolled, setScrolled] = useState(false);
    const { fullWidth, ...rest } = props
    return (
        <>
    <Stack
        direction="row"
        alignItems="center"
        pb={2}
        pt={3}
        
      >
        <TopHeader px={4.5} />
        <NavLink2  />
        <Profile px={2} justifyContent="flex-end" />
      </Stack>
        </>
    )
}