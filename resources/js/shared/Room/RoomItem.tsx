import React from "react";
import { Link } from "@inertiajs/react";

import { Box, Typography, Card, CardContent, Snackbar } from "@mui/material";
import { useState } from "react";
import {pink, grey} from "@mui/material/colors";

export const RoomItem = (props) => {
    const { image, title, subtitle, description, type, status, ...rest } = props;
    const [toastOpen, setToastOpen] = useState(false);

    const handleLinkClick = (e) => {
        if (status === "Occupied" || status === "Maintenance") {
            e.preventDefault();
            setToastOpen(true);
        }
    };
    let message = "";
    if (status === "Occupied") {
        message = "Phòng đã được sử dụng!";
    } else if (status === "Maintenance") {
        message = "Phòng đang sửa chữa!";
    }

    const handleCloseToast = () => {
        setToastOpen(false);
    };

    return (
        <>
            <Link href="#" onClick={handleLinkClick}>
                <Card
                    sx={{
                        width: "100%",
                        maxWidth: 450,
                        backgroundColor: "#fff",
                        borderRadius: 4,
                        transition: "transform 0.2s ease",
                        boxShadow: "rgba(0, 0, 0, 0.1) 0px 10px 20px 3px, rgba(0, 0, 0, 0.04) 0px 10px 10px 0px",
                        transform: status === "Occupied" || status === "Maintenance" ? "none" : "scale(1)",
                        opacity: status === "Occupied" || status === "Maintenance" ? 0.5 : 1,
                        "&:hover": {
                            backgroundColor: status === "Occupied" || status === "Maintenance" ? "#fff" : "#f9f9f9",
                            transform: status === "Occupied" || status === "Maintenance" ? "none" : "scale(1.05)",
                        },
                    }}
                >
                    <CardContent>
                        <Box
                            component="img"
                            src={image}
                            borderRadius={4}
                            alt="Sample Image"
                            sx={{
                                height: "100%",
                                width: "100%",
                                objectFit: "cover",
                                loading: "lazy",
                            }}
                        />
                        <Typography variant="h5" component="div" pt={2}>
                            {title}
                        </Typography>
                        <Typography variant="subtitle1" color="text.secondary">
                            {subtitle}
                        </Typography>
                        <Typography variant="body2" color="text.secondary" sx={{ mt: 1 }}>
                            {description}
                        </Typography>
                    </CardContent>
                </Card>
            </Link>

            <Snackbar
              
                open={toastOpen}
                onClose={handleCloseToast}
                autoHideDuration={3000}
                message={message}
                sx={{
                    "& .MuiSnackbarContent-root": {
                        backgroundColor: grey[50],
                        color: grey[800],
                    },
                }}
            />
        </>
    );
};
