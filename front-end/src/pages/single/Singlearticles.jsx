import React, { useState } from "react";
import Sidebar from "../../components/sidebar/Sidebar";
import Navbar from "../../components/navbar/Navbar";
import Chart from "../../components/chart/Chart";
import "./single.scss";
import SERVER_NAME from "../../index";
import { useParams } from "react-router-dom";
import { useEffect } from "react";
import axios from "axios";
import Swal from "sweetalert2";
import { Link } from "react-router-dom";

const Singlearticles = () => {
  
  const [articles, setArticles] = useState([]);
  const { userId } = useParams();
  
  useEffect(() => {
    fetchArticle();
  }, [])
  
  const fetchArticle = async () => {

    await axios.get(SERVER_NAME + "article/" + userId).then(({ data }) => {
      setArticles(data);
    }).catch((error) => {
      Swal.fire({
        text: error,
        icon: "error",
      });
    });
  }

  return (
    <div className="single">
      <Sidebar />
      <div className="singleContainer">
        <Navbar />
        <div className="top">
          <div className="left">
            <Link 
              to={{ pathname: "/articles/edit/" + userId }}>
              <div className="editButton">Edit</div>
              </Link>
            <h1 className="title">Information of {articles.title}</h1>
            <div className="item">
              <img
                src={"http://localhost:8000/image/" + articles.image}
                alt=""
                className="itemImg"
              />
              <div className="details">
                <h1 className="itemTitle">{ articles.title }</h1>
                <div className="detailItem">
                  <span className="itemKey">Content: </span>
                  <span className="itemValue">{ articles.content }</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">Description: </span>
                  <span className="itemValue">{ articles.description }</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">is Draft: </span>
                  <span className="itemValue">{ articles.isdraft }</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">is Checked: </span>
                  <span className="itemValue">{ articles.ischecked }</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">Read Number: </span>
                  <span className="itemValue">{ articles.read_number }</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">Last read at: </span>
                  <span className="itemValue">{ articles.last_read_at }</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">Created by: </span>
                  <span className="itemValue">{ articles.created_by }</span>
                </div>
                <div className="detailItem">
                  <span className="itemKey">Updated by: </span>
                  <span className="itemValue">{ articles.updated_by ? articles.updated_by : "NULL" }</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="bottom">
          <Chart aspect={5 / 1} title="Article Analyst" />
        </div>
      </div>
    </div>
  );
};

export default Singlearticles;
