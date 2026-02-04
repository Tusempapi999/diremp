import React from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { Outlet } from 'react-router-dom';

const LayoutClient = () => {
    return (
        <>
            <h1>client</h1>
            <Navbar/>
            <Outlet/>
            <Footer/>
        </>
    )
}

export default LayoutClient