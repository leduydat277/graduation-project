import { Box, Typography, Button, Stack } from '@mui/material';
import LuggageIcon from '@mui/icons-material/Luggage';
import CameraAltIcon from '@mui/icons-material/CameraAlt';
import LocationOnIcon from '@mui/icons-material/LocationOn';
import Banner6 from '../../../assets/Banner6.jpg';
import {blue, grey} from '@mui/material/colors';

const stats = [
  { icon: <LuggageIcon sx={{ color:blue[500] }} />, label: 'Users', value: 2500 },
  { icon: <CameraAltIcon sx={{ color: blue[500] }} />, label: 'Treasure', value: 200 },
  { icon: <LocationOnIcon sx={{ color: blue[500] }} />, label: 'Cities', value: 100 },
];

export const Banners = () => {
  return (
    <Box sx={{ display: 'flex', justifyContent: 'space-between' }}>
      <Box className="banner-left" sx={{ textAlign: 'left', maxWidth: 380 }}>
        <Typography variant="h4" fontWeight="bold" gutterBottom sx={{ color: "" }}>
          Forget Busy Work, Start Next Vacation
        </Typography>
        <Typography variant="body1" color="text.secondary" mb={3}>
          We provide what you need to enjoy your holiday with family. Time to make another memorable moment.
        </Typography>
        <Button variant="contained" sx={{ backgroundColor:blue[500] , mb: 4, px: 3, py: 1.5, fontSize: '1rem', fontWeight: 'bold', textTransform: 'none', borderRadius: '0.5rem' }}>
          Show More
        </Button>
        <Stack direction="row" spacing={5} mt={6}>
          {stats.map((stat, index) => (
            <Box key={index} textAlign="left">
              <Typography variant="h6" fontWeight="bold" sx={{ color: grey[500] }} >
                {stat.icon}
              </Typography>
              <Typography variant="body2" color="text.secondary">
                {stat.value} | <span style={{ color: grey[500] }}>{stat.label}</span>
              </Typography>
            </Box>
          ))}
        </Stack>
      </Box>
      <Box sx={{ display: 'flex', justifyContent: 'right', mb: 5 }}>
        <Box
          component="img"
          src={Banner6}
          alt="Resort Image"
          sx={{ width: '70%', height: '100%', borderRadius: '1rem', boxShadow: 3, borderTopLeftRadius: '6rem' }}
        />
      </Box>
    </Box>
  );
};

