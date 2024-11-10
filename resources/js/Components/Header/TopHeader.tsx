import { useState } from 'react';
import { Link } from '@inertiajs/react';
import Logo from '@/components/Logo/Logo';
import MainMenu from '@/components/Menu/MainMenu';
import { Typography } from '@mui/material';
import { Menu } from 'lucide-react';

import {containerProps} from '@/components/Responsive';

export const TopHeader =  (props) => {
  const { fullWidth, ...rest } = props


  return (
    <Typography variant="h4" {...rest}>Sleep Hotel</Typography>
  );
};
