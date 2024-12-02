import React, { useState } from "react";
import { Box, Typography, IconButton } from "@mui/material";
import ArrowBackIosIcon from "@mui/icons-material/ArrowBackIos";
import ArrowForwardIosIcon from "@mui/icons-material/ArrowForwardIos";

const slides = [
    {
        image: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-1-2000px.jpg",
        title: "DELUXE - ROOM",
        description:
            "Sở hữu diện tích 38m2, phòng Superior hướng thị xã ấm cúng nhưng không kém phần trang nhã với 1 giường lớn, ghế sofa phòng khách, tivi, bàn làm việc kết hợp trang điểm, tủ quần áo, phòng tắm hiện đại...",
    },
    {
        image: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-1-2000px.jpg",
        title: "ECONOMY - ROOM",
        description:
            "Phòng Deluxe rộng 42m2 với view hướng núi tuyệt đẹp, được trang bị đầy đủ tiện nghi hiện đại, đem lại cảm giác thoải mái nhất cho du khách.",
    },
    {
        image: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-1-2000px.jpg",
        title: "EXECUTIVE - ROOM",
        description:
            "Phòng Suite rộng rãi với diện tích 50m2, hướng vườn yên bình, là lựa chọn lý tưởng cho kỳ nghỉ dưỡng của bạn.",
    },
    {
        image: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-1-2000px.jpg",
        title: "FAMILY - ROOM",
        description:
            "Phòng Suite rộng rãi với diện tích 50m2, hướng vườn yên bình, là lựa chọn lý tưởng cho kỳ nghỉ dưỡng của bạn.",
    },
    {
        image: "https://image-tc.galaxy.tf/wijpeg-afu0zj5rhmyyirzditj3g96mk/deluxe-room-king-1-2000px.jpg",
        title: "KING - ROOM",
        description:
            "Phòng Suite rộng rãi với diện tích 50m2, hướng vườn yên bình, là lựa chọn lý tưởng cho kỳ nghỉ dưỡng của bạn.",
    },
];

export const ListTypeRoom = () => {
    const [currentSlide, setCurrentSlide] = useState(0);

    const handlePrev = () => {
        setCurrentSlide((prev) =>
            prev === 0 ? slides.length - 1 : prev - 1
        );
    };

    const handleNext = () => {
        setCurrentSlide((prev) =>
            prev === slides.length - 1 ? 0 : prev + 1
        );
    };

    return (
        <>
            <Typography
                variant="subtitle1"
                sx={{
                    marginTop: '50px',
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
                DANH SÁCH LOẠI PHÒNG
            </Typography>
            <Box
                sx={{
                    border: "10px solid rgba(134, 112, 80, .24)",
                    marginTop: "30px",
                    padding: "2rem",
                    backgroundColor: "#f9f9f9",
                    textAlign: "center",
                }}
            >


                {/* Slide */}
                <Box
                    sx={{

                        position: "relative",
                        maxWidth: "1200px",
                        margin: "0 auto",
                        overflow: "hidden",
                        borderRadius: "8px",
                    }}
                >
                    {/* Nút điều hướng trái */}
                    <IconButton
                        onClick={handlePrev}
                        sx={{
                            position: "absolute",
                            left: "7rem",
                            top: "50%",
                            transform: "translateY(-50%)",
                            zIndex: 10,
                            // backgroundColor: "rgba(0, 0, 0, 0.5)",
                            color: "#fff",
                            "&:hover": {
                                backgroundColor: "rgba(0, 0, 0, 0.7)",
                            },
                        }}
                    >
                        <ArrowBackIosIcon />
                    </IconButton>

                    {/* Hình ảnh slide */}
                    <Box
                        sx={{
                            display: "flex",
                            transform: `translateX(-${currentSlide * 100}%)`,
                            // transition: "transform 0.5s ease-in-out",
                        }}
                    >
                        {slides.map((slide, index) => (
                            <Box
                                key={index}
                                sx={{
                                    flex: "0 0 100%",
                                    position: "relative",
                                }}
                            >
                                <img
                                    src={slide.image}
                                    alt={slide.title}
                                    style={{
                                        margin: 'auto',
                                        width: "85%",
                                        display: "block",
                                        borderRadius: "8px",
                                    }}
                                />
                                {/* Mô tả phòng */}
                                <Box
                                    sx={{
                                        position: "absolute",
                                        top: "50%",
                                        left: "50%",
                                        transform: "translate(-50%, -50%)",
                                        backgroundColor: "rgba(0, 0, 0, 0.1)",
                                        color: "#fff",
                                        padding: "1.5rem",
                                        borderRadius: "8px",
                                        textAlign: "center",
                                        maxWidth: "70%",
                                    }}
                                >
                                    <Typography
                                        variant="h6"
                                        sx={{
                                            fontWeight: "bold",
                                            fontSize: "1.5rem",
                                            marginBottom: "1rem",
                                        }}
                                    >
                                        {slide.title}
                                    </Typography>
                                    <Typography variant="body2" sx={{ fontSize: "1rem" }}>
                                        {slide.description}
                                    </Typography>
                                </Box>
                            </Box>
                        ))}
                    </Box>

                    {/* Nút điều hướng phải */}
                    <IconButton
                        onClick={handleNext}
                        sx={{
                            position: "absolute",
                            right: "7rem",
                            top: "50%",
                            transform: "translateY(-50%)",
                            zIndex: 10,
                            // backgroundColor: "rgba(0, 0, 0, 0.5)",
                            color: "#fff",
                            "&:hover": {
                                backgroundColor: "rgba(0, 0, 0, 0.7)",
                            },
                        }}
                    >
                        <ArrowForwardIosIcon />
                    </IconButton>
                </Box>
            </Box>
        </>
    );
};
