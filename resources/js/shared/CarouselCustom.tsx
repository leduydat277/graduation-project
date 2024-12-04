import * as React from "react";
import { Card, CardContent } from "@mui/material";
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
  type CarouselApi,
} from "@/components/ui/carousel";
import { rest } from "lodash";


const baseUrl = "http://127.0.0.1:8000/storage/";
// const imagePaths = [
//   "upload/rooms/KyngHOdKsq5gLV5GJFj0xIZfpUObG9PpPBCdfMIT.jpg",
//   "upload/rooms/cMt910F0IsoET8hjKRn47zXwayJJna727sVI28xv.jpg",
//   "upload/rooms/aJLs8e2YLAeIdJoKdOshmuqsP7NTAuCi6S7gW4g2.jpg",
//   "upload/rooms/iXNGeIfRfKuiPk5z5dfgpDx8uPyRlUv3ezbzKBkw.jpg",
//   "upload/rooms/uI1tI9eiheJFzegmkfaOtAxacfxzQYpEXHnChvpo.jpg",
// ];

export const CarouselCustom = ({ image_room }) => {

  console.log("image_room type:", typeof image_room)

if (Array.isArray(image_room) && image_room.every(item => typeof item === "string")) {
  const sanitizedImageRoom = image_room.map((path: string) => {
    return path.replace(/\\/g, "/");
  });
  console.log("Sanitized image paths:", sanitizedImageRoom);
} else {
  console.error("image_room không phải là mảng hoặc chứa phần tử không phải chuỗi.");
}
  const [api, setApi] = React.useState<CarouselApi | null>(null);
  const [current, setCurrent] = React.useState(0);
  const [count, setCount] = React.useState(0);

  React.useEffect(() => {
    if (!api) return;

    setCount(api.scrollSnapList().length);
    setCurrent(api.selectedScrollSnap() + 1);
    const onSelect = () => {
      setCurrent(api.selectedScrollSnap() + 1);
    };
    api.on("select", onSelect);

    // const interval = setInterval(() => {
    //   api.next();
    // }, 3000);

    return () => {
      clearInterval(interval);
      api.off("select", onSelect);
    };
  }, [api]);

  return (
    <>
      <Carousel setApi={setApi} className="w-5/5 mx-auto relative">
        <CarouselContent>
          {image_room.map((src, index) => (
            <CarouselItem key={index}>
              <Card>
                <CardContent className="flex aspect-square items-center justify-center p-0">
                  <img
                    src={`${baseUrl}${src}`}
                    alt={`Room ${index + 1}`}
                    className="object-cover w-full h-full rounded"
                  />
                </CardContent>
              </Card>
            </CarouselItem>
          ))}
        </CarouselContent>

        {/* Các nút điều hướng đặt ở trên ảnh */}
        <div className="absolute top-1/2 left-0 right-0 flex justify-between px-4">
          <CarouselPrevious />
          <CarouselNext />
        </div>
      </Carousel>

      <div className="py-2 text-center text-sm text-muted-foreground">
        {current} / {count}
      </div>
    </>
  );
};
