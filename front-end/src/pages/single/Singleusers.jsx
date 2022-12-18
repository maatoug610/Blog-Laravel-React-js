import React, { useEffect, useState } from "react";
import Sidebar from "../../components/sidebar/Sidebar";
import Navbar from "../../components/navbar/Navbar";
import Chart from "../../components/chart/Chart";
import "./single.scss";
import axios from "axios";
import Swal from "sweetalert2";
import SERVER_NAME from "../../index";
import { useParams } from "react-router-dom";
import { Link } from "react-router-dom";

const Singleusers = () =>  {
  const [users, setUsers] = useState([]);
  const {userId} = useParams(); //userId : is the same in <App/> <Route path=":userId" element={..}/>

 
  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = async () => {
    await axios
      .get(SERVER_NAME + "user/" + userId)
      .then(({ data }) => {
        setUsers(data);
      })
      .catch((err) => {
        Swal.fire({
          text: err,
          icon: "error",
        });
      });
  };

  return (
    <div className="single">
      <Sidebar />
      <div className="singleContainer">
        <Navbar />
        <div className="top">
          <div className="left">
            <Link to={{pathname:"/users/edit/" + userId}}>
              <div className="editButton">Edit</div>
              </Link>
            <h1 className="title">Information {userId}</h1>
            <div className="item">
              <img
                src={"http://localhost:8000/image/" + users.image}
                alt=""
                className="itemImg"
              />
              <div className="details">
                <h1 className="itemTitle">{users.name}</h1>
                <div className="detailItem">
                  <span className="itemKey">Email: </span>
                  <span className="itemValue">{users.email}</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">Role: </span>
                  <span className="itemValue">Admin</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">Status: </span>
                  <span className="itemValue">active</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">Created at: </span>
                  <span className="itemValue">{users.created_at}</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="bottom">
          <Chart aspect={5 / 1} title="Users Analyst" />
        </div>
      </div>
    </div>
  );
};

export default Singleusers;
