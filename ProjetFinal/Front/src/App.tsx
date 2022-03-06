import React, { useEffect, useState } from "react";
import logo from "./logo.svg";
import "./App.css";
import Home from "./components/Home";
import Product from "./components/Product";
import Cart from "./components/Cart";

export const endpoint = "http://localhost:8000/api";
export type Product = {
  id: number;
  name: string;
  price: string;
  quantity: number;
  image: string;
};

function App() {
  const [route, setRoute] = useState<{
    route: "home" | "product" | "cart";
    data?: any;
  }>({ route: "home" });

  return (
    <div className="App">
      {route.route === "home" && <Home setRoute={setRoute} />}
      {route.route === "product" && (
        <Product setRoute={setRoute} data={route.data} />
      )}
      {route.route === "cart" && <Cart setRoute={setRoute} />}
    </div>
  );
}

export default App;
