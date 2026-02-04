import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

const AuthUser = () => {
    const navigate = useNavigate(); //se usa para redirigir y brincar entre rutas facilmente

    const getToken = () => {
        const tokenString = sessionStorage.getItem('token')//se usa getitem para optener un valor almacenado en el navegador, como el token
        const token = JSON.parse(tokenString) //Parsea el token a json
        return token; //retorna el token
    }   

    const getUser = () => {
        const userString = sessionStorage.getItem('user') //optiene el usuario
        const user = JSON.parse(userString) //convierte json
        return user; //lo retorna
    }   

    const getRol = () => { //lo mimo que las dos funciones anteriores pero ahora con rol
        const rolString = sessionStorage.getItem('rol')
        const rol = JSON.parse(rolString)
        return rol;
    }   

    //El estado inicial de cada una de las siguientes variables
    //sera la obtenida del navegador por las funciones get

    const [token, setToken] = useState(getToken());
    const [user, setUser] = useState(getUser());
    const [rol, setRol] = useState(getRol());

    const saveToken = (user, token, rol) => {
        sessionStorage.setItem('user',JSON.stringify(user))
        sessionStorage.setItem('token',JSON.stringify(token))
        sessionStorage.setItem('rol',JSON.stringify(rol))

        setUser(user)
        setToken(token)
        setRol(rol)
    }

    return (
        <div>AuthUser</div>
    )
}

export default AuthUser