import { Link, Box, Stack, Typography } from "@mui/material";
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
      sx={{
        color: 'white',
        width: '100%',
       backgroundColor: '#092533',
        position: 'sticky',
        top: 0,
        zIndex: 1000,
        ...containerProp
      }}
      {...rest}
    >
      <TopHeader px={4.5} />
      <NavLink />
      <Profile px={2} justifyContent="flex-end" />
    </Stack>
  );
};

const NavLink = (props) => {

  return (
    <Stack direction="row" gap={2} pl={7}>
      <Typography variant="h6">Home</Typography>
      <Typography variant="h6">Rooms</Typography>
      <Typography variant="h6">About</Typography>
      <Typography variant="h6">Policy</Typography>
    </Stack>
  )


};
