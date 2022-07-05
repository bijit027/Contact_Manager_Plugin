import { createApp } from "vue";
import app from "./app.vue";
import router from "./router";
import "./style.css";
createApp(app).use(router).mount("#vwp-admin-app");
