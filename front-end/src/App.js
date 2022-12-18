import React, { useContext } from "react";
import '../src/style/dark.scss';
import { BrowserRouter , Routes, Route } from 'react-router-dom';
import Home from "./pages/home/Home";
import Listarticles from "./pages/list/Listarticles";
import Listusers from "./pages/list/Listusers";
import Login from "./pages/login/Login";
import Newusers from "./pages/new/Newusers";
import Singlearticles from "./pages/single/Singlearticles";
import Singleusers from "./pages/single/Singleusers";
import { DarkModeContext } from "./context/darkModeContext";
import Newarticles from "./pages/new/Newarticles";
import Editusers from "./pages/edit/Editusers";
import Editarticles from "./pages/edit/Editarticles";

function App() {
  const { darkMode } = useContext(DarkModeContext)
  
  return (
    <div className={darkMode ? "app dark" : "app"}>
      <BrowserRouter>
        <Routes>

          <Route path="/" element={<Home />} />
          <Route path="login" element={<Login />} />

          <Route path="users">
            <Route index element={<Listusers />} />
            <Route path=":userId" element={<Singleusers />} />
            <Route path="new" element={<Newusers />} />
            <Route path="edit/:userId" element={<Editusers/>} />
          </Route>

          <Route path="articles">
            <Route index element={<Listarticles/>} />
            <Route path=":userId" element={<Singlearticles />} />
            <Route path="new" element={<Newarticles />} />
            <Route path="edit/:userId" element={<Editarticles/>} />
          </Route>

        </Routes>
      </BrowserRouter>
    </div>
  );
}

export default App;