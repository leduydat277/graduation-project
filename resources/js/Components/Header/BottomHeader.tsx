import { Box, Stack, Typography, Link} from "@mui/material";
import { red } from '@mui/material/colors';
import { Profile } from '../Profile/Profile';

import { TopHeader } from '@/components/Header/TopHeader';
import { containerProps } from '@/components/Responsive';

export const BottomHeader = ({ fullWidth, ...rest }) => {
  const containerProp = fullWidth ? { width: '100%', flex: 1 } : containerProps();

  return (
    <Stack

      direction="row"
      alignItems="center"
      // justifyContent="space-between"
      backgroundColor="white"
      pb={2}
     pt={3}
      sx={{ width: '100%',
        position: 'sticky',
        top: 0,
        zIndex: 1000,
      ...containerProp }}
      {...rest}
    >
      <TopHeader px={4.5} />
      <NavLink/>
      <Profile px={2} justifyContent="flex-end" />
    </Stack>
  );
};

const NavLink = (props) => {

  return (
    <Stack direction="row" gap={2} pl={7}>

<Link href={`/`} variant="h6" sx={{ textDecoration: "none", color: "inherit" }}>
        Home
      </Link>
      <Link href={`/rooms`} variant="h6" sx={{ textDecoration: "none", color: "inherit" }}>
        Rooms
      </Link>
      <Link href={`/about`} variant="h6" sx={{ textDecoration: "none", color: "inherit" }}>
        About
      </Link>
      <Link href={`/policy`} variant="h6" sx={{ textDecoration: "none", color: "inherit" }}>
        Policy
      </Link>
    
 </Stack>
  )
 

};
