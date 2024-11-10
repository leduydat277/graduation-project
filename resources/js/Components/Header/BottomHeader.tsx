import { Link, Box, Stack } from "@mui/material";
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
      justifyContent="space-between"
      gap={2}
      sx={{ width: '100%', ...containerProp }}
      {...rest}
    >
      <TopHeader px={2} />
      <NavLink />
      <Profile px={2} />
    </Stack>
  );
};

const NavLink = () => (
  <Stack direction="row" gap={4} sx={{ marginLeft: '500px', fontFamily: 'Times New Roman', fontSize: '20px'}}>
    <Link sx={{textDecoration: 'none', color: 'black'}} href="#basics">Home</Link>
    <Link sx={{textDecoration: 'none', color: 'black'}} href="#basics">Rooms</Link>
    <Link sx={{textDecoration: 'none', color: 'black'}} href="#basics">About</Link>
    <Link sx={{textDecoration: 'none', color: 'black'}} href="#basics">Contact</Link>
  </Stack>
);
