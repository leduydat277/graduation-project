import {
    Avatar,
    AvatarImage,
} from "@/components/ui/avatar";
import { usePage } from "@inertiajs/react";
import { PageProps } from "@/types";
import { ChevronDown } from "lucide-react";
import { Box, Stack, Link, Menu, MenuItem } from "@mui/material";
import React, { useState } from 'react';
import { containerProps } from "../Responsive";

export const Profile = (props: any) => {
    const { fullWidth, pressCart, ...rest } = props;
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

    const containerProp = fullWidth ? { with: '100%', flex: 1 } : containerProps();

    return (
        <Box
            position={'absolute'}
            right={19}
            top={30}
            {...rest}
        >
            <Avatar
                onClick={handleMenu}
                sx={{
                    cursor: 'pointer',
                    transition: 'transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out',
                    '&:hover': {
                        transform: 'scale(1.1)',
                        boxShadow: '0 4px 15px rgba(0, 0, 0, 0.2)',
                    },
                }}
            >
                <AvatarImage src="https://github.com/shadcn.png" alt="@shadcn" />
                <ChevronDown
                    size={20}
                    className="text-gray-800 group-hover:text-indigo-600"
                    style={{
                        transition: 'transform 0.3s ease-in-out',
                    }}
                />
            </Avatar>
            <Menu
                open={menuOpened}
                anchorEl={anchorEl}
                onClose={handleClose}
                sx={{
                    '& .MuiPaper-root': {
                        borderRadius: 2,
                        boxShadow: '0 4px 20px rgba(0, 0, 0, 0.15)',
                        backgroundColor: '#fff',
                        border: '1px solid #eee',
                    },
                }}
            >
                <MenuItem onClick={handleClose} sx={{
                    '&:hover': {
                        backgroundColor: '#f4f4f4',
                    },
                }}>
                    <Link
                        onClick={() => setMenuOpened(false)}
                        sx={{
                            textDecoration: 'none',
                            color: 'inherit',
                            fontWeight: 600,
                            fontSize: '16px',
                            transition: 'color 0.3s',
                            '&:hover': {
                                color: '#0077cc',
                            },
                        }}
                    >
                        My Profile
                    </Link>
                </MenuItem>
                <MenuItem onClick={handleClose} sx={{
                    '&:hover': {
                        backgroundColor: '#f4f4f4',
                    },
                }}>
                    {/* <Link
                        href={route('users')}
                        onClick={() => setMenuOpened(false)}
                        sx={{
                            textDecoration: 'none',
                            color: 'inherit',
                            fontWeight: 600,
                            fontSize: '16px',
                        }}
                    >
                        Manage Users
                    </Link> */}
                </MenuItem>
                <MenuItem onClick={handleClose} sx={{
                    '&:hover': {
                        backgroundColor: '#f4f4f4',
                    },
                }}>
                    <Link
                        href={route('payment-history')}
                        sx={{
                            textDecoration: 'none',
                            color: 'inherit',
                            fontWeight: 600,
                            fontSize: '16px',
                            transition: 'color 0.3s',
                            '&:hover': {
                                color: '#0077cc',
                            },
                        }}
                    >
                        Lịch sử thanh toán
                    </Link>
                </MenuItem>
                <MenuItem onClick={handleClose} sx={{
                    '&:hover': {
                        backgroundColor: '#f4f4f4',
                    },
                }}>
                    <Link
                        href={route('logout')}
                        method="delete"
                        sx={{
                            textDecoration: 'none',
                            color: 'inherit',
                            fontWeight: 600,
                            fontSize: '16px',
                            transition: 'color 0.3s',
                            '&:hover': {
                                color: '#0077cc',
                            },
                        }}
                    >
                        Logout
                    </Link>
                </MenuItem>
            </Menu>
        </Box>
    );
};
