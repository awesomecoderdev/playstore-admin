import React, { Fragment } from "react";
import ReactDOM from "react-dom/client";
import Product from "./components/Product";

if (document.getElementById("awesomecoderProductMetabox") != null) {
    const root = ReactDOM.createRoot(document.getElementById("awesomecoderProductMetabox"));
    root.render(
      <>
        <Product />
      </>
    );
  }