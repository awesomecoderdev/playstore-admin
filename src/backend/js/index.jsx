import React, { Fragment } from "react";
import ReactDOM from "react-dom/client";
import App from "./App";

if (document.getElementById("wpbody") != null) {
  const root = ReactDOM.createRoot(document.getElementById("wpbody"));
  root.render(
    <App />
  );
}