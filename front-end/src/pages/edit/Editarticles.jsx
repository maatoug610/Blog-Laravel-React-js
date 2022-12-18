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

const Editarticles = () => {
  const { userId } = useParams();
  const [articles, setArticles] = useState({
    title: '',
    content: '',
    description: '',
    isdraft: '',
    ischekced: '',
    image: '',

  });
  const [image, setImage] = useState();
  const navigate = useNavigate();

  useEffect(() => {
    fetchArticles();
  }, [userId]);
   
  const fetchArticles = async () => {
    await axios
      .get(SERVER_NAME + "article/" + userId + "/edit")
      .then(({ data }) => {
        setArticles(data.articles);
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
    setArticles((values) => ({ ...values, [name]: value }));
  };

  const updateArticle = async (e) => {
      e.preventDefault() 
   
    await axios
      .put(SERVER_NAME + "article/" + userId, articles)
      .then(({ data }) => {
        Swal.fire({
          icon: "success",
          title: "Success",
        });
        navigate("/articles");
      })
      .catch((error) => {
        
          Swal.fire({
            title: "OPPS",
            text: error.message,
            icon: "error",
          });
        
      });
  };
  console.log(articles);
  return (
    <div className="edit">
      <Sidebar />
      <div className="editComponent">
        <Navbar />
        <div className="top">
          <h1>Edit Article ID {userId}</h1>
        </div>
        <div className="bottom">
          <div className="left">
            <img
              src={
                image
                  ? URL.createObjectURL(image)
                  : "http://localhost:8000/image/" + articles.image
              }
              alt="avatar img"
            />
          </div>
          <div className="right">
            <form onSubmit={updateArticle}>
              <div className="inputForm">
                <label htmlFor="image">
                  Image: <DriveFolderUploadIcon className="icon" />
                </label>
                <input
                  type="file"
                  id="image"
                  name="image"
                  //   onChange={(e) => setarticles({ image: e.target.files[0] })}
                  onChange={(e) => setImage(e.target.files[0])}
                  style={{ display: "none" }}
                />
              </div>
              <div className="inputForm">
                <label>Title</label>
                <input
                  type="text"
                  name="title"
                  value={articles.title}
                  onChange={handleChange}
                />
              </div>
              <div className="inputForm">
                <label>Content</label>
                {/* <input
                  type="text"
                  name="content"
                  value={articles.content}
                  onChange={handleChange}
                /> */}
                 <textarea name="content"
                  onChange={handleChange}
                value={articles.content}>
                </textarea>
              </div>
              <div className="inputForm">
                <label>Description</label>
                <input
                  type="text"
                  name="description"
                  value={articles.description}
                  onChange={handleChange}
                />
              </div>
              <div className="inputForm">
                <label>is Draft</label>
                <input
                  type="checkbox"
                  name="isdraft"
                  // value={articles.isdraft}
                  onChange={handleChange}
                  checked={articles.isdraft}
                />
              </div>
              <div className="inputForm">
                <label>is Checked</label>
                <input
                  type="checkbox"
                  name="ischecked"
                  // value={articles.ischecked}
                  onChange={handleChange}
                  checked={articles.ischecked}
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
export default Editarticles;
