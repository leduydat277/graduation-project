
import { Box, Typography, } from '@mui/material';
import HomeBannner1 from '../../../assets/HomeBanner1.jpg';
import HomeBannner2 from '../../../assets/HomeBanner2.jpg';
import HomeBannner3 from '../../../assets/HomeBanner3.jpg';
import HomeBannner4 from '../../../assets/HomeBanner4.jpg';
import HomeBannner5 from '../../../assets/HomeBanner5.jpg';
const Images = [HomeBannner2, HomeBannner3, HomeBannner4, HomeBannner5];
export const BannerImage = (props) => {
return (
    <>
    <Typography variant="h5" fontWeight="bold" gutterBottom sx={{ color: "#0d0d2b", textAlign: 'left' }}>
            Most Picked
          </Typography>
          {/* top phòng hay được book */}
          <Box sx={{ display: 'flex', gap: '20px', marginBottom: '50px' }}>
            <Box sx={{width:'54%'}}>
              <Box
                component="img"
                src={HomeBannner1}
                alt="Sample Image"
                sx={{
                  width: '100%',
                  margin: 'auto',
                  objectFit: 'cover',
                  boxShadow: 3,
                  borderRadius: '1rem',
                  overflow: 'hidden',
                  loading:"lazy",
                }}
              />
            </Box>
            <Box sx={{ display: 'grid', width: '46%', gridTemplateColumns: 'repeat(2, 2fr)', gap: 1,  }}>
                {Images.map((image, index) => (
                  <Box
                    component="img"
                    src={image}
                    alt="Sample Image"
                    sx={{
                    height: '100%',
                    width: '250px',
                    objectFit: 'cover',
                    loading:"lazy",
                    margin: 'auto',
                    boxShadow: 3,
                    borderRadius: '1rem',
                    overflow: 'hidden',
                    }}
                  />
                ))}
            </Box>
          </Box>
    </>
)
}