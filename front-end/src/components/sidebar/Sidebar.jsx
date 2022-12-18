import React, { useContext } from "react";
import "./sidebar.scss";
import DashboardIcon from "@mui/icons-material/Dashboard";
import PeopleAltOutlinedIcon from "@mui/icons-material/PeopleAltOutlined";
import LockOutlinedIcon from "@mui/icons-material/LockOutlined";
import MenuBookOutlinedIcon from "@mui/icons-material/MenuBookOutlined";
import CategoryOutlinedIcon from "@mui/icons-material/CategoryOutlined";
import StoreIcon from "@mui/icons-material/Store";
import InsertChartRoundedIcon from "@mui/icons-material/InsertChartRounded";
import NotificationsNoneRoundedIcon from "@mui/icons-material/NotificationsNoneRounded";
import AccountCircleOutlinedIcon from "@mui/icons-material/AccountCircleOutlined";
import ExitToAppOutlinedIcon from "@mui/icons-material/ExitToAppOutlined";
import { Link } from "react-router-dom";
import { DarkModeContext } from "../../context/darkModeContext";

const Sidebar = () => {
  const { dispatch } = useContext(DarkModeContext)
    return (
      <div className="sidebar">
        <div className="top">
          <Link to="/" style={{ textDecoration: "none" }}>
            <span className="logo">Maatoug Admin</span>
          </Link>
        </div>
        <hr />
        <div className="center">
          <ul>
            <p className="title">MAIN</p>
            <li>
              <DashboardIcon className="icon" />
              <span>Dashboard</span>
            </li>

            <p className="title">LISTS</p>
            <Link to="/users" style={{ textDecoration: "none" }}>
              <li>
                <PeopleAltOutlinedIcon className="icon" />
                <span>Users</span>
              </li>
            </Link>
            <Link to="/role" style={{ textDecoration: "none" }}>
              <li>
                <LockOutlinedIcon className="icon" />
                <span>Roles</span>
              </li>
            </Link>

            <Link to="/articles" style={{ textDecoration: "none" }}>
              <li>
                <MenuBookOutlinedIcon className="icon" />
                <span>Articles</span>
              </li>
            </Link>

            <Link to="/applications" style={{ textDecoration: "none" }}>
              <li>
                <CategoryOutlinedIcon className="icon" />
                <span>Applications</span>
              </li>
            </Link>

            <Link to="/products" style={{ textDecoration: "none" }}>
              <li>
                <StoreIcon className="icon" />
                <span>Products</span>
              </li>
            </Link>

            <p className="title">USEFUL</p>
            <Link to="/stats" style={{ textDecoration: "none" }}>
              <li>
                <InsertChartRoundedIcon className="icon" />
                <span>Stats</span>
              </li>
            </Link>

            <Link to="/notification" style={{ textDecoration: "none" }}>
              <li>
                <NotificationsNoneRoundedIcon className="icon" />
                <span>Notifications</span>
              </li>
            </Link>

            <p className="title">USER</p>
            <Link to="/profile" style={{ textDecoration: "none" }}>
              <li>
                <AccountCircleOutlinedIcon className="icon" />
                <span>Profile</span>
              </li>
            </Link>

            <Link to="/logout" style={{ textDecoration: "none" }}>
            <li>
              <ExitToAppOutlinedIcon className="icon" />
              <span>Logout</span>
              </li>
              </Link>

            <p className="title">Color page</p>
          </ul>
        </div>

        <div className="bottom">
          <div className="optionColor" onClick={()=> dispatch({type:"LIGHT"})}></div>
          <div className="optionColor" onClick={()=> dispatch({type:"DARK"})}></div>
          <div className="optionColor"></div>
        </div>
      </div>
    );
  }


export default Sidebar;
