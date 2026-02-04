import React from "react";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { Outlet } from 'react-router-dom';

const LayoutAdmin = () => {
    return (
        <>
            <h1>admin</h1>
            <Navbar/>
            <Outlet/>
            <Footer/>
        </>
    )
}

export default LayoutAdmin