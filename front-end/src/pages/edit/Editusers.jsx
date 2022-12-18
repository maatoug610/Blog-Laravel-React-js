import React from "react";
import "./edit.scss";
import Sidebar from "../../components/sidebar/Sidebar";
import Navbar from "../../components/navbar/Navbar";
import { Navigate, useNavigate, useParams } from "react-router-dom";
import { useState } from "react";
import DriveFolderUploadIcon from "@mui/icons-material/DriveFolderUpload";
import { useEffect } from "react";
import axios from "axios";
import SERVER_NAME from "../../index";
import Swal from "sweetalert2";

const Editusers = () => {
  const { userId } = useParams();
  const navigate = useNavigate();
  const [users, setUsers] = useState([]);
  const [image, setImage] = useState();
  useEffect(() => {
    fetchUsers();
  }, []);

   
  const fetchUsers = async () => {
    await axios
      .get(SERVER_NAME + "user/" + userId + "/edit")
      .then(({ data }) => {
        setUsers({
          name: data.name,
          email: data.email,
          password: data.password,
          image: data.image,
        });
      })
      .catch((error) => {
        Swal.fire({
          icon: "error",
          title: "OOPS Error",
          text: error,
        });
      });
  };

  const handleChange = (event) => {
    const name = event.target.name;
    const value = event.target.value;
    setUsers((values) => ({ ...values, [name]: value }));
  };

  const updateUser = async (e) => {
      e.preventDefault() 
    console.log(users);
    await axios
      .put(SERVER_NAME + "user/" + userId, users)
      .then(({ data }) => {
        Swal.fire({
          icon: "success",
          title: "Success",
        });
        navigate("/users");
      })
      .catch((error) => {
        if (error.response.data.Error.name != null) {
          Swal.fire({
            title: "OPPS",
            text: error.response.data.Error.name,
            icon: "error",
          });
        } else if (error.response.data.Error.email != null) {
          Swal.fire({
            title: "OPPS",
            text: error.response.data.Error.email,
            icon: "error",
          });
        } else if (error.response.data.Error.password != null) {
          Swal.fire({
            title: "OPPS",
            text: error.response.data.Error.password,
            icon: "error",
          });
        } else if (error.response.data.Error.image != null) {
          Swal.fire({
            title: "OPPS",
            text: error.response.data.Error.image,
            icon: "error",
          });
        } else {
          Swal.fire({
            title: "OPPS",
            text: error.message,
            icon: "error",
          });
        }
      });
  };
  console.log(users);
  return (
    <div className="edit">
      <Sidebar />
      <div className="editComponent">
        <Navbar />
        <div className="top">
          <h1>Edit User ID {userId}</h1>
        </div>
        <div className="bottom">
          <div classNam e="left">
            <img
              src={
                image
                  ? URL.createObjectURL(image)
                  : "http://localhost:8000/image/" + users.image
              }
              alt="avatar img"
            />
          </div>
          <div className="right">
            <form onSubmit={updateUser}>
              <div className="inputForm">
                <label htmlFor="image">
                  Image: <DriveFolderUploadIcon className="icon" />
                </label>
                <input
                  type="file"
                  id="image"
                  name="image"
                  //   onChange={(e) => setUsers({ image: e.target.files[0] })}
                  onChange={(e) => setImage(e.target.files[0])}
                  style={{ display: "none" }}
                />
              </div>
              <div className="inputForm">
                <label>User Name</label>
                <input
                  type="text"
                  name="name"
                  value={users.name}
                  onChange={handleChange}
                />
              </div>
              <div className="inputForm">
                <label>User Email</label>
                <input
                  type="email"
                  name="email"
                  value={users.email}
                  onChange={handleChange}
                />
              </div>
              <div className="inputForm">
                <label>User Password</label>
                <input
                  type="password"
                  name="password"
                  value={users.password}
                  onChange={handleChange}
                />
              </div>

              <button>Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};
export default Editusers;
