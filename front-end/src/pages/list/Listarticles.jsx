import React, { useEffect, useState } from "react";
import axios from "axios";
import Navbar from "../../components/navbar/Navbar";
import Sidebar from "../../components/sidebar/Sidebar";
import "./list.scss";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import SERVER_NAME from "../../index";
import { Link } from "react-router-dom";
const columns = [
  { field: "id", headerName: "ID", width: 50 },
  {
    field: "image",
    headerName: "Image",
    width: 100,
    renderCell: (params) => {
      return (
        <div className="cellWithImg">
          <img
            className="cellImg"
            src={"http://localhost:8000/image/" + params.row.image}
            alt="avatar"
          />
        </div>
      );
    },
  },
  { field: "title", headerName: "title", width: 130 },
  { field: "content", headerName: "content", width: 200 },
  { field: "description", headerName: "Description", width: 150 },
  { field: "isdraft", headerName: "Draft", width: 90 },
  { field: "ischecked", headerName: "Checked", width: 90 },
  { field: "read_number", headerName: "Read Nb", width: 90 },
  { field: "last_read_at", headerName: "Last read", width: 180 },
  {
    field: "action",
    headerName: "Action",
    width: 200,
    renderCell: (params) => {
      return (
        <div className="cellAction">
          <Link
            to={{ pathname: "/articles/" + params.row.id }}
            style={{ textDecoration: "none" }}
          >
            <div className="viewButton">View</div>
          </Link>
          <Link
            to={{ pathname: "/articles/edit/" + params.row.id }}
            style={{ textDecoration: "none" }}
          >
            <div className="editButton">Edit</div>
          </Link>
          <div className="deleteButton">Delete</div>
        </div>
      );
    },
  },
];

const Listarticles = () => {
  const [articles, setArticles] = useState([]);

  useEffect(() => {
    fetchArticles();
  }, []);

  const fetchArticles = async () => {
    await axios.get(SERVER_NAME + `article/index`).then(({ data }) => {
      setArticles(data);
    });
  };
  return (
    <div className="list">
      <Sidebar />
      <div className="listContainer">
        <Navbar />
        <div className="datatable">
          <div className="datatableTitle">
            Add New Article
            <Link to="/articles/new" className="link">
              Add New
            </Link>
          </div>
          <DataGrid
            className="dataGrid"
            rows={articles}
            columns={columns}
            pageSize={9}
            rowsPerPageOptions={[9]}
            checkboxSelection
          />
        </div>
      </div>
    </div>
  );
};

export default Listarticles;
