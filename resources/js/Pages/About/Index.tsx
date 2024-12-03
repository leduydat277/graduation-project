
import MainLayout from '@/Layouts/MainLayout';
import { RoomSearchBar } from '../../shared/Room/RoomSearchBar'
import React, { useState } from 'react';
import { Box, Typography, List, ListItem, ListItemText } from '@mui/material';
import { grey, pink, blue } from '@mui/material/colors';
import SearchIcon from '@mui/icons-material/Search';
import { RoomList } from '@/shared/Room/RoomList';
import { Footer } from '@/components/Footer/Footer';

const SidebarContent = {
  about: "Về Sleep Hotel\nĐược thành lập vào năm 1996 ở Amsterdam, Sleep Hotel đã phát triển thành một trong những công ty hàng đầu thế giới trong lĩnh vực du lịch số...",
  legal: "Pháp lý\nNội dung pháp lý liên quan đến Sleep Hotel bao gồm các điều khoản và điều kiện sử dụng dịch vụ, chính sách bảo mật và các quy định về bảo vệ quyền lợi người dùng...",
  globalOffices: "Văn phòng toàn cầu\nSleep Hotelcó văn phòng ở nhiều quốc gia trên toàn thế giới, nhằm phục vụ tốt hơn cho khách hàng và đối tác ở từng khu vực...",
  technology: "Công nghệ\nSleep Hotel áp dụng các công nghệ hiện đại để tối ưu trải nghiệm người dùng. Chúng tôi sử dụng trí tuệ nhân tạo (AI) và học máy (ML) để cung cấp các đề xuất phù hợp...",
  community: "Cộng đồng\nSleep Hotel không chỉ kết nối du khách mà còn hỗ trợ cộng đồng và phát triển bền vững thông qua nhiều hoạt động từ thiện và bảo vệ môi trường...",
};

const SidebarImages = {
  about: "https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2023/5/29/1198274/Swimming-Pool-1.jpg",
  legal: "https://duonggiahotel.vn/wp-content/uploads/2023/01/4048e2d8302ae874b13b.jpg",
  globalOffices: "https://images.trvl-media.com/lodging/35000000/34570000/34566600/34566522/f518ba3c.jpg?impolicy=fcrop&w=1200&h=800&p=1&q=medium",
  technology: "https://media-cdn-v2.laodong.vn/Storage/NewsPortal/2023/3/21/1170122/329113621_5800712350.jpg",
  community: "https://ticotravel.com.vn/wp-content/uploads/2022/03/LA-VELA-SAIGON-HOTEL-10-1.jpg",
};

function AboutPage() {
  const [selectedContent, setSelectedContent] = useState("about");

  const handleListItemClick = (contentKey: any) => {
    setSelectedContent(contentKey);
  };

  return (
    <>
       <Box display="flex" sx={{ width: '80%', marginTop: '90px', margin: 'auto', marginBottom: '40px' }}>
        {/* Sidebar */}
        <Box sx={{ 
          marginTop: '60px',
          width: '250px', 
          borderRight: '1px solid #ddd',
          paddingRight: '10px'
        }}>
          <List>
            {Object.keys(SidebarContent).map((contentKey) => (
              <ListItem
                button
                key={contentKey}
                onClick={() => handleListItemClick(contentKey)}
                sx={{
                  cursor: 'pointer',
                  color: selectedContent === contentKey ? 'lightblue' : 'text.primary',
                  '&:hover': {
                    color: selectedContent === contentKey ? 'lightblue' : '#f0f0f0',
                  },
                  transition: 'color 0.3s ease-in-out',  // Thêm hiệu ứng mượt mà
                }}
              >
                <ListItemText primary={
                  <Typography
                    variant="body1"
                    color={selectedContent === contentKey ? 'primary' : 'textPrimary'}
                  >
                    {contentKey === "about" ? "Về Sleep Hotel" :
                     contentKey === "legal" ? "Pháp lý" :
                     contentKey === "globalOffices" ? "Văn phòng toàn cầu" :
                     contentKey === "technology" ? "Công nghệ" :
                     "Cộng đồng"}
                  </Typography>
                } />
              </ListItem>
            ))}
          </List>
        </Box>

        {/* Main Content Area */}
        <Box sx={{
          padding: '20px',
          flexGrow: 1,
          minWidth: 0, 
          maxWidth: 'calc(100% - 250px)',
          overflow: 'hidden', 
          transition: 'all 0.3s ease-in-out',
          marginTop: '50px'
        }}>
          {/* Tiêu đề */}
          <Typography variant="h4" gutterBottom>
            {selectedContent === "about" ? "Về Sleep Hotel" : 
             selectedContent === "legal" ? "Pháp lý" : 
             selectedContent === "globalOffices" ? "Văn phòng toàn cầu" :
             selectedContent === "technology" ? "Công nghệ" : 
             "Cộng đồng"}
          </Typography>

          {/* Hình ảnh */}
          <Box sx={{ mb: 2 }}>
            <img 
              src={SidebarImages[selectedContent]} 
              alt={selectedContent} 
              style={{ width: '100%', height: 'auto', borderRadius: '8px' }}
            />
          </Box>

          {/* Nội dung */}
          <Typography variant="body1" sx={{ whiteSpace: 'pre-line' }}>
            {SidebarContent[selectedContent]}
          </Typography>
        </Box>
      </Box>
      <Footer />
    </>

  );
}

AboutPage.layout = (page: React.ReactNode) => (
  <MainLayout title="About" children={page} />
);

export default AboutPage;