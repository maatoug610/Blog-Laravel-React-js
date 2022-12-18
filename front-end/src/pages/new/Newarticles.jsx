import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import axios from "axios";
import Swal from "sweetalert2";
import Navbar from "../../components/navbar/Navbar";
import Sidebar from "../../components/sidebar/Sidebar";
import "./new.scss";
import DriveFolderUploadIcon from "@mui/icons-material/DriveFolderUpload";
import SERVER_NAME from "../../index";

const Newarticles = () => {
  const navigate = useNavigate();
  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");
  const [description, setDescription] = useState("");
  const [isdraft, setIsdraft] = useState("");
  const [ischecked, setIschecked] = useState("");
  const [validationError, setValidationError] = useState({});
  const [image, setImage] = useState("");

  const createArticle = async (e) => {
    e.preventDefault();

    const formData = new FormData();

    formData.append("title", title);
    formData.append("content", content);
    formData.append("description", description);
    formData.append("isdraft", isdraft);
    formData.append("ischecked", ischecked);
    formData.append("image", image);


    await axios
      .post(SERVER_NAME + `article/store`, formData)
      .then(({ data }) => {
        Swal.fire({
          title: "Success",
          icon: "success",
          text: data.message,
        });
        navigate("/articles");
      })
      .catch(({ response }) => {
        if (response.status === 422) {
          setValidationError(response.data.errors);
        } else if (response.data.Error.image != null) {
          Swal.fire({
            title: "OOPS Error",
            text: response.data.Error.image,
            icon: "error",
          });
        } else if (response.data.Error.title != null) {
          Swal.fire({
            title: "OOPS Error",
            text: response.data.Error.title,
            icon: "error",
          });
        } else if (response.data.Error.content != null) {
          Swal.fire({
            title: "OOPS Error",
            text: response.data.Error.content,
            icon: "error",
          });
        } else if (response.data.Error.description != null) {
          Swal.fire({
            title: "OOPS Error",
            text: response.data.Error.description,
            icon: "error",
          });
        } else {
          Swal.fire({
            title: "OOPS Error",
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
          <h1>Create New Article</h1>
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
            <form onSubmit={createArticle}>
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
                <label>Title</label>
                <input
                  type="text"
                  name="title"
                  onChange={(e) => {
                    setTitle(e.target.value);
                  }}
                />
              </div>
              <div className="inputForm">
                <label>Content</label>
                {/* <input
                  type="text"
                  name="content"
                  onChange={(e) => {
                    setContent(e.target.value);
                  }}
                 
                /> */}
                <textarea
                  name="content"
                  onChange={(e) => {
                    setContent(e.target.value);
                  }}
                ></textarea>
              </div>
              <div className="inputForm">
                <label>Description</label>
                <input
                  type="text"
                  name="description"
                  onChange={(e) => {
                    setDescription(e.target.value);
                  }}
                />
              </div>
              <div className="inputForm">
                <label>is Draft</label>
                <input
                  type="checkbox"
                  name="isdraft"
                  onChange={(e) => {
                    setIsdraft(e.target.value);
                  }}
                />
              </div>
              <div className="inputForm">
                <label>is Checked</label>
                <input
                  type="checkbox"
                  name="ischecked"
                  onChange={(e) => {
                    setIschecked(e.target.value);
                  }}
                />
              </div>

              <button>Send</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};
export default Newarticles;
