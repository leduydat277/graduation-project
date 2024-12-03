import * as React from "react";
import { Card, CardContent } from '@mui/material';
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
  type CarouselApi,
} from "@/components/ui/carousel";

export const CarouselCustom = () => {
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

    const interval = setInterval(() => {
      api.next(); 
    }, 3000);

    return () => {
      clearInterval(interval);
      api.off("select", onSelect);
    };
  }, [api]);

  return (
    <>
      <Carousel setApi={setApi} className="w-5/5 mx-auto relative">
        <CarouselContent>
          {Array.from({ length: 5 }).map((_, index) => (
            <CarouselItem key={index}>
              <Card>
                <CardContent className="flex aspect-square items-center justify-center p-6">
                  <span className="text-4xl font-semibold">{index + 1}</span>
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
}
