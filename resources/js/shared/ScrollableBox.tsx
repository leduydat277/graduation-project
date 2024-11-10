import { Box } from '@mui/material';

export const ScrollableBox = (props) => {
  const { scrollContent, ...rest } = props;
  return (
    <Box
      sx={{
        overflowY: 'auto',  
        overflowX: 'hidden', 
        maxHeight: '100vh',  
        '&::-webkit-scrollbar': {
          display: 'none', 
        },
      }}
      {...rest}
    >
      {scrollContent}
    </Box>
  );
};
