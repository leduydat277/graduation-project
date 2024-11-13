
import React from 'react';
import { Typography, Box } from "@mui/material";

export const DetailContent = (props) => {
    const { title, subtitle, description, image } = props
  return (
    <Box sx={{ minHeight: '300px'}}>
              <Box
                component="img"
                src={image}
                borderRadius = {4}
                alt="Sample Image"
                sx={{
                  height: '100%',
                  width: '100%',
                  objectFit: 'cover',
                  loading: "lazy",
                }}
              />
              <Typography variant="h3" pt={4}> {title}</Typography>
              <Typography variant="h5"  pt={3}>{subtitle}</Typography>
              <Typography pt={2}>{description}</Typography>
             
            </Box>
  );
}