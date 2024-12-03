import React, { useState, useEffect } from "react";
import { Link } from "@inertiajs/react";
import { Box, Typography, Card, CardContent, Snackbar } from "@mui/material";
import { grey } from "@mui/material/colors";
import HomeBannner5 from "../../../assets/HomeBanner5.jpg";
import { useBookingStore } from "../../../service/stores/booking-store";
import { CarouselCustom } from "../CarouselCustom";

export const RoomItem = (props) => {
    const { id, image, title, subtitle, description, type, status, price } = props;

    const [setPrice] = useBookingStore((state) => [state.setPrice]);

    const items = [
        { src: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-1-2000px.jpg", alt: "DELUXE - ROOM" },
        { src: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-2-2000px.jpg", alt: "ECONOMY - ROOM" },
        { src: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-3-2000px.jpg", alt: "EXECUTIVE - ROOM" },
        { src: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-4-2000px.jpg", alt: "FAMILY - ROOM" },
        { src: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-5-2000px.jpg", alt: "KING - ROOM" }
      ];
      

    const [toastOpen, setToastOpen] = useState(false);

    // Chỉ cập nhật giá khi cần
    useEffect(() => {
        setPrice(price);
    }, [price, setPrice]);

    // Xác định trạng thái phòng
    const isUnavailable = status === "Occupied" || status === "Maintenance";
    const message =
        status === "Occupied" ? "Phòng đã được sử dụng!" : status === "Maintenance" ? "Phòng đang sửa chữa!" : "";

    const handleLinkClick = (e) => {
        if (isUnavailable) {
            e.preventDefault();
            setToastOpen(true);
        }
    };

    const handleCloseToast = () => setToastOpen(false);

    return (
        <>
            <Link href={`/detail/${id}`} onClick={handleLinkClick}>
                <Card
                    sx={{
                        width: "100%",
                        maxWidth: 450,
                        backgroundColor: "#fff",
                        borderRadius: 4,
                        transition: "transform 0.2s ease",
                        boxShadow:
                            "rgba(0, 0, 0, 0.1) 0px 10px 20px 3px, rgba(0, 0, 0, 0.04) 0px 10px 10px 0px",
                        transform: isUnavailable ? "none" : "scale(1)",
                        opacity: isUnavailable ? 0.5 : 1,
                        "&:hover": {
                            backgroundColor: isUnavailable ? "#fff" : "#f9f9f9",
                            transform: isUnavailable ? "none" : "scale(1.05)",
                        },
                    }}
                >
                    <CardContent>
                        <CarouselCustom items={items} />
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
