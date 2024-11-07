import React from "react";
import { Box, Typography, Card, CardMedia, CardContent } from "@mui/material";

export const RoomItem = (props) => {
    console.log(props);
    const { image, title, subtitle, description, type, ...rest } = props;

    return (
        <Card sx={{
            width: '100%', 
            maxWidth: 450, 
            backgroundColor: '#fff', 
            borderRadius: 4, 
            transition: 'transform 0.2s ease',
            boxShadow: 'rgba(0, 0, 0, 0.1) 0px 10px 20px 3px, rgba(0, 0, 0, 0.04) 0px 10px 10px 0px',
            '&:hover': {
                backgroundColor: '#f9f9f9',
                transform: 'scale(1.05)',
            },
        }}>
            <CardContent>
                <Typography variant="h5" component="div">
                    {title}
                </Typography>
                <Typography variant="subtitle1" color="text.secondary">
                    {subtitle}
                </Typography>
                <Typography variant="subtitle2" color="primary" sx={{ mt: 1 }}>
                    {type}
                </Typography>
                <Typography variant="body2" color="text.secondary" sx={{ mt: 1 }}>
                    {description}
                </Typography>
            </CardContent>
        </Card>
    );
};
