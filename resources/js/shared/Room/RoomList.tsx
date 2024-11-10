import React from "react";
import { Stack , Grid} from "@mui/material";
import { RoomItem } from "./RoomItem";
import HomeBannner1 from '../../../assets/HomeBanner1.jpg';


export const RoomList = () => {
    const data = [
        {
            title: "ibis Paris Bastille Opera 11th",
            subtitle: "Vibrant economy hotel, open to everyone",
            type: "VIP",
            status: "Vacant",
            description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
            image: HomeBannner1,
        },
        {
            title: "ibis Paris Bastille Opera 11th",
            subtitle: "Vibrant economy hotel, open to everyone",
            type: "VIP",
            status: "Vacant",
            description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
            image: HomeBannner1,
        },
        {
            title: "ibis Paris Bastille Opera 11th",
            subtitle: "Vibrant economy hotel, open to everyone",
            type: "VIP",
            status: "Vacant",
            description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
            image: HomeBannner1,
        },
        {
            title: "ibis Paris Bastille Opera 11th",
            subtitle: "Vibrant economy hotel, open to everyone",
            type: "VIP",
            status: "Maintenance",
            description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
            image: HomeBannner1,
        },
        {
            title: "ibis Paris Bastille Opera 11th",
            subtitle: "Vibrant economy hotel, open to everyone",
            type: "VIP",
            status: "Maintenance",
            description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
            image: HomeBannner1,
        },
        {
            title: "ibis Paris Bastille Opera 11th",
            subtitle: "Vibrant economy hotel, open to everyone",
            type: "VIP",
            status: "Occupied",
            description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
            image: HomeBannner1,
        },
        {
            title: "ibis Paris Bastille Opera 11th",
            subtitle: "Vibrant economy hotel, open to everyone",
            type: "VIP",
            status: "Occupied",
            description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
            image: HomeBannner1,
        },
        {
            title: "ibis Paris Bastille Opera 11th",
            subtitle: "Vibrant economy hotel, open to everyone",
            type: "VIP",
            status: "Occupied",
            description: "The ibis Paris Bastille Opera hotel is located in the historic center of Paris, near the Seine, with easy metro links to Notre Dame, the Louvre, Champs Elysees, department stores, etc, and just 10 minutes from Gare de Lyon, Gare du Nord and the Bercy business district.",
            image: HomeBannner1,
        },
      
    ];
 data.forEach((item) => console.log(item))

    return (
       
        <Grid container spacing={{ md: 3 }} columns={{ xs: 4, sm: 8, md: 12 }}>
        {data.map((item, index) => (
            <Grid item xs={12} sm={6} md={4} key={index}>
                <RoomItem {...item} />
            </Grid>
        ))}
    </Grid>
    );
};
