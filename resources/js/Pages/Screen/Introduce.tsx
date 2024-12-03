import React from "react";
import { Box, Typography, Button } from "@mui/material";

export const Introduce = () => {
    return (
        <>
            <Typography
                variant="subtitle1"
                sx={{
                    fontSize: "1rem",
                    color: "#aaa38b",
                    textTransform: "uppercase",
                    textAlign: "center",
                    marginBottom: "0.5rem",
                }}
            >
                Khách sạn 4 Sao Sleep Hotel
            </Typography>
            <Typography
                variant="h1"
                sx={{
                    fontSize: "1.8rem",
                    fontWeight: "bold",
                    textAlign: "center",
                    color: "#333",
                    marginBottom: "1.5rem",
                }}

            >
                ỐC ĐẢO YÊN BÌNH GIỮA LÒNG HÀ NỘI
            </Typography>
            <Box
                sx={{
                    display: "flex",
                    flexDirection: "column",
                    alignItems: "center",
                    justifyContent: "center",
                    padding: "2rem",
                    backgroundColor: "#f9f9f9",
                    border: "10px solid rgba(134, 112, 80, .24)",
                    marginBottom: '40px'
                }}
            >
                <Box
                    sx={{
                        display: "flex",
                        flexDirection: { xs: "column", md: "row" },
                        gap: "2rem",
                        alignItems: "center",
                        maxWidth: "1200px",
                        width: "100%",

                    }}
                >
                    {/* Hình ảnh */}
                    <Box
                        sx={{
                            flex: "1",
                            border: "2px solid #e8e6e2",
                            borderRadius: "8px",
                            overflow: "hidden",
                        }}
                    >
                        <img
                            src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/29/6a/b0/11/apricot-hotel.jpg?w=1200&h=-1&s=1" // Thay bằng URL hình thật
                            alt="Khách sạn Pistachio"
                            style={{ width: "100%", display: "block" }}
                        />
                    </Box>
                    <Box
                        sx={{
                            flex: "1",
                            color: "#555",
                            display: "flex",
                            flexDirection: "column",
                            gap: "1rem",
                            marginBottom: "80px",
                        }}
                    >
                        <Typography
                            variant="body1"
                            sx={{
                                fontSize: "1rem",
                                lineHeight: "1.8",
                                textAlign: "justify",
                            }}
                        >
                            Không chỉ là một địa điểm lưu trú lý tưởng cho du khách khi đến với
                            “thành phố không ngủ”, SLEEP HOTEL còn được chăm chút như một
                            “tòa trang thư nhỏ” – nơi lưu giữ những giá trị văn hóa độc đáo của
                            thành phố trong sự hòa quyện tinh tế cùng phong cách
                            nghỉ dưỡng thời thượng.
                        </Typography>
                        <Typography
                            variant="body1"
                            sx={{
                                fontSize: "1rem",
                                lineHeight: "1.8",
                                textAlign: "justify",
                            }}
                        >
                            Sleep Hotel như một ốc đảo tại “trái tim” của Hà Nội, trên con
                            đường Lạc Long Quân hướng tới trung tâm thành phố. Khách sạn mang đến tâm
                            hồn thông điệp ôm trọn khung cảnh thiên nhiên Hồ Tây lộng gió. Nơi thích hợp dừng chân
                            sau những chuyến đi chơi đỉnh nọc - kịch trần tại Thủ đô.
                        </Typography>
                        <Button
                            variant="outlined"
                            sx={{
                                alignSelf: "flex-start",
                                padding: "0.5rem 2rem",
                                borderRadius: "24px",
                                textTransform: "none",
                                fontWeight: "bold",
                                borderColor: "#aaa38b",
                                color: "#aaa38b",
                                "&:hover": {
                                    borderColor: "#888",
                                    backgroundColor: "#f4f4f4",
                                },
                            }}
                        >
                            Xem chi tiết
                        </Button>
                    </Box>
                </Box>
            </Box>
        </>

    );
};
