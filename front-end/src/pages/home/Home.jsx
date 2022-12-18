import React, { Component } from "react";
import "./home.scss";
import Navbar from "../../components/navbar/Navbar";
import Sidebar from "../../components/sidebar/Sidebar";
import Widget from "../../components/widget/Widget";
import Chart from "../../components/chart/Chart";

class Home extends Component {
  state = {};
  render() {
    return (
      <div className="home">
        <Sidebar />
        <div className="homeContainer">
          <Navbar />
          <div className="widgets">
            <Widget title="Users" counter="40" percentage="50" />
            <Widget title="Articles" counter="100" percentage="25"/>
            <Widget title="Applications" counter="55" percentage="30"/>
            <Widget title="Aroducts" counter="243" percentage="10"/>
          </div>
          <div className="charts">
          <Chart aspect={5 / 1} title="Dashboard Analyst" />
          </div>
        </div>
      </div>
    );
  }
}

export default Home;
