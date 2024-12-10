import React, { useEffect } from "react";
import { Grid, CircularProgress, Typography, Box } from "@mui/material";
import { RoomItem } from "./RoomItem";
import { usePromiseFn } from "../../../service/hooks/promise";
import { searchRooms } from "../../../service/hooks/room";
import { useBookingStore } from "../../../service/stores/booking-store";

export const ResultContent = (props) => {
    const [checkInDate, checkOutDate, type] = useBookingStore((state) => [state.checkInDate, state.checkOutDate, state.type]);
    const dataRoom = { checkInDate, checkOutDate, type };
    
    const { data, error, loading, execute } = usePromiseFn(searchRooms, [dataRoom]);

    useEffect(() => {
        // Gọi API khi dataRoom thay đổi
        execute(dataRoom);
    }, [dataRoom, execute]);

    const rooms = data?.data || [];

    if (loading) {
        return (
            <Box sx={{ display: 'flex', justifyContent: 'center', alignItems: 'center', height: '100vh' }}>
                <CircularProgress />
            </Box>
        );
    }

    if (error) {
        return (
            <Box sx={{ textAlign: 'center', marginTop: 4 }}>
                <Typography variant="h6" color="error">
                    Đã xảy ra lỗi khi tải dữ liệu. Vui lòng thử lại sau.
                </Typography>
            </Box>
        );
    }

    return (
        <Grid container spacing={{ md: 3 }} columns={{ xs: 4, sm: 8, md: 12 }}>
            {rooms.length > 0 ? (
                rooms.map((item, index) => (
                    <Grid item xs={12} sm={6} md={4} key={index}>
                        <RoomItem {...item} />
                    </Grid>
                ))
            ) : (
                <Box sx={{ textAlign: 'center', marginTop: 4 }}>
                    <Typography variant="h6">Không có phòng nào hiện có.</Typography>
                </Box>
            )}
        </Grid>
    );
};
