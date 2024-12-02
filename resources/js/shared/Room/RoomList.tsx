import React from "react";
import { Stack, Grid, CircularProgress, Typography, Box } from "@mui/material";
import { RoomItem } from "./RoomItem";
import HomeBannner1 from '../../../assets/HomeBanner1.jpg';
import { usePromiseFn } from "../../../service/hooks/promise";
import { allRooms } from "../../../service/hooks/room";
import { rest } from "lodash";

export const RoomList = (props) => {
    const { start, end, ...rest } = props;
    const { data, error, loading } = usePromiseFn(allRooms, []);

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
                rooms.slice(start, end).map((item, index) => (
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
