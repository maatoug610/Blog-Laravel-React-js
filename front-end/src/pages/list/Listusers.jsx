import React, { useEffect, useState, Component } from "react";
import axios from "axios";
import Navbar from "../../components/navbar/Navbar";
import Sidebar from "../../components/sidebar/Sidebar";
import "./list.scss";
import { DataGrid, GridColDef, GridValueGetterParams } from "@mui/x-data-grid";
import SERVER_NAME from "../../index";
import { Link } from "react-router-dom";

const columns = [
  { field: "id", headerName: "ID", width: 70 },
  {
    field: "name",
    headerName: "Name",
    width: 200,
    renderCell: (params) => {
      return (
        <div className="cellWithImg">
          <img
            className="cellImg"
            src={"http://localhost:8000/image/" + params.row.image}
            alt="avatar"
          />
          {params.row.name}
        </div>
      );
    },
  },
  // {
  //   field: "userName",
  //   headerName: "User name",
  //   description: "This column has a value getter and is not sortable.",
  //   sortable: false,
  //   width: 130,
  //   valueGetter: (params: GridValueGetterParams) =>
  //     `${params.row.name || ""}${params.row.id || ""}`,
  // },
  { field: "email", headerName: "Email", width: 200 },
  {
    field: "role",
    headerName: "Role",
    // type: "number",
    width: 90,
  },
  {
    field: "status",
    headerName: "Status",
    width: 100,
    renderCell: () => {
      return <div className="cellWithStatus">active</div>;
    },
  },
  { field: "created_at", headerName: "Created at", width: 200 },
  { field: "deleted_at", headerName: "Deleted at", width: 200 },
  {
    field: "action",
    headerName: "Action",
    width: 200,
    renderCell: (params) => {
      return (
        <div className="cellAction">
          <Link
            to={{ pathname: "/users/" + params.row.id }}
            style={{ textDecoration: "none" }}
          >
            <div className="viewButton">View</div>
          </Link>
          <Link
            to={{ pathname: "/users/edit/" + params.row.id }}
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

const Listusers = () => {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    fetchUsers();
  }, []);

  const fetchUsers = async () => {
    await axios.get(SERVER_NAME + `user/index`).then(({ data }) => {
      setUsers(data);
    });
  };

  return (
    <div className="list">
      <Sidebar />
      <div className="listContainer">
        <Navbar />
        <div className="datatable">
          <div className="datatableTitle">
            Add New User
            <Link to="/users/new" className="link">
              Add New
            </Link>
          </div>
          <DataGrid
            className="dataGrid"
            rows={users}
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

export default Listusers;
