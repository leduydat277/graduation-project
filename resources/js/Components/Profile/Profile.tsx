import {
    Avatar,
    AvatarFallback,
    AvatarImage,
} from "@/components/ui/avatar";
import { usePage } from "@inertiajs/react";
import { PageProps } from "@/types";
import { ChevronDown } from "lucide-react";
import { Box, Stack, Link, Menu, MenuItem } from "@mui/material";


import React, { useState } from 'react';
import { containerProps } from "../Responsive";

export const Profile = (props:any) => {
    const { fullWidth, pressCart, ...rest } = props
    const { auth } = usePage<PageProps>().props;
    const [menuOpened, setMenuOpened] = useState(false);
    const [anchorEl, setAnchorEl] = React.useState<null | HTMLElement>(null);

    const handleMenu = (event: React.MouseEvent<HTMLElement>) => {
        setMenuOpened(true);
        setAnchorEl(event.currentTarget);
    };

    const handleClose = () => {
        setMenuOpened(false);
        setAnchorEl(null);
    };
    const containerProp = fullWidth ? { with: '100%', flex: 1 } : containerProps()

    return (
        <Box 
      position={'absolute'}
        right={19}
        top={30}
        {...rest}
       
        >
            <Avatar onClick={handleMenu}>
                <AvatarImage src="https://github.com/shadcn.png" alt="@shadcn" />
                {/* <AvatarFallback>CNdfdsfsfdsfsd</AvatarFallback> */}
                <ChevronDown
                    size={20}
                    className="text-gray-800 group-hover:text-indigo-600"
                />
            </Avatar>
            <Menu
                open={menuOpened}
                anchorEl={anchorEl}
                onClose={handleClose}
            >
                <MenuItem onClick={handleClose}>
                    <Link

                        // href={route('users.edit', auth.user.id)}

                        onClick={() => setMenuOpened(false)}
                    >
                        My Profile
                    </Link>
                </MenuItem>
                <MenuItem onClick={handleClose}>
                    {/* <Link
                        href={route('users')}

                        onClick={() => setMenuOpened(false)}
                    >
                        Manage Users
                    </Link> */}
                </MenuItem>
                <MenuItem onClick={handleClose}>
                    {/* <Link href={route('logout')} method="delete">

                        Logout

                    </Link> */}
                </MenuItem>
            </Menu>
        </Box>
    );
};  