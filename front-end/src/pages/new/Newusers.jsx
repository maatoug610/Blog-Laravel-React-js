import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";
import Navbar from "../../components/navbar/Navbar";
import Sidebar from "../../components/sidebar/Sidebar";
import "./new.scss";
import DriveFolderUploadIcon from "@mui/icons-material/DriveFolderUpload";
import SERVER_NAME from "../../index";
import PieC from "../../components/pieChart/PieC";

const Newusers = () => {
  const navigate = useNavigate();
  const [name, setName] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [image, setImage] = useState("");
  const [validationError, setValidationError] = useState({});

  const createUser = async (e) => {
    e.preventDefault();

    const formData = new FormData();
    
    formData.append("name", name);
    formData.append("email", email);
    formData.append("password", password);
    formData.append("image", image);

  
    await axios
      .post(SERVER_NAME + `user/store`, formData)
      .then(({ data }) => {

        Swal.fire({
          icon: "success",
          text: data.message,
        });
        navigate("/users");
      })
      .catch(({ response }) => {
        if (response.status === 422) {
          setValidationError(response.data.errors);
        } else if (response.data.Error.name != null) {
          Swal.fire({
            title: "OPPS",
            text: response.data.Error.name,
            icon: "error",
          });
        }
        else if (response.data.Error.email != null) {
          Swal.fire({
            title: "OPPS",
            text: response.data.Error.email,
            icon: "error",
          });
        }
        else if (response.data.Error.password != null) {
          Swal.fire({
            title: "OPPS",
            text: response.data.Error.password,
            icon: "error",
          });
        }
        else if (response.data.Error.image != null) {
          Swal.fire({
            title: "OPPS",
            text: response.data.Error.image,
            icon: "error",
          });
        }
        else {
          Swal.fire({
            title: "OPPS",
            text: response.data.message,
            icon: "error",
          });
        }
      });
  };
  
  return (
    <div className="new">
      <Sidebar />
      <div className="newContainer">
        <Navbar />
        <div className="top">
          <h1>Create New User</h1>
          {Object.keys(validationError).length > 0 && (
            <div className="row">
              <div className="col-12">
                <div className="alert alert-danger">
                  <ul className="mb-0">
                    {Object.entries(validationError).map(([key, value]) => (
                      <li key={key}>{value}</li>
                    ))}
                  </ul>
                </div>
              </div>
            </div>
          )}
        </div>
        <div className="bottom">
          <div className="left">
            <img
              src={
                image
                  ? URL.createObjectURL(image)
                  : "https://us.123rf.com/450wm/bestvectorstock/bestvectorstock1808/bestvectorstock180806895/107283376-digital-photo-camera-icon-vector-isolated-on-white-background-for-your-web-and-mobile-app-design-dig.jpg?ver=6"
              }
              alt="avatar img"
            />
          </div>
          <div className="right">
            <form onSubmit={createUser}>
              <div className="inputForm">
                <label htmlFor="image">
                  Image: <DriveFolderUploadIcon className="icon" />
                </label>
                <input
                  type="file"
                  id="image"
                  onChange={(e) => setImage(e.target.files[0])}
                  name="image"
                  style={{ display: "none" }}
                 
                />
              </div>
              <div className="inputForm">
                <label>User name</label>
                <input
                  type="text"
                  placeholder="khalil maatoug"
                  name="name"
                  onChange={(e) => {
                    setName(e.target.value);
                  }}
                />
              </div>
              <div className="inputForm">
                <label>User Email</label>
                <input
                  type="email"
                  placeholder="user45@gmail.com"
                  name="email"
                  onChange={(e) => {
                    setEmail(e.target.value);
                  }}
                />
              </div>
              <div className="inputForm">
                <label>User password</label>
                <input
                  type="password"
                  placeholder="******"
                  min={8}
                  name="password"
                  onChange={(e) => {
                    setPassword(e.target.value);
                  }}
                />
              </div>

              <button>Send</button>
            </form>
          </div>
        </div>
        <PieC/>
      </div>
    </div>
  );
};
export default Newusers;
