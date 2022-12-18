import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import { DarkModeContextProvider } from "./context/darkModeContext";

//declare global var :
const SERVER_NAME = "http://localhost:8000/api/";


const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <DarkModeContextProvider>
      <App />
      </DarkModeContextProvider>
  </React.StrictMode>
);

export default SERVER_NAME;

