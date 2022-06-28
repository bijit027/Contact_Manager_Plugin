import { createApp } from "vue";
//import ElementPlus from "element-plus";
//import 'element-plus/dist/index.css'
// import './main.scss'
import App from "./App.vue";
import router from "./router";

import "../node_modules/@fortawesome/fontawesome-free/css/all.css";

import "../node_modules/bootstrap/dist/css/bootstrap.css";
import "../node_modules/bootstrap/dist/js/bootstrap.bundle";
import "./style.css"; //main css file

createApp(App).use(router).mount("#vwp-admin-app");
