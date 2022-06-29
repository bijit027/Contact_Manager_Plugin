import { createWebHashHistory, createRouter } from "vue-router";
import Home from "../pages/home.vue";
import ContactManager from "../pages/contactManager.vue";
import AddContact from "../pages/addContact";
import EditContact from "../pages/editContact";
import ViewContact from "../pages/viewContact.vue";
import PageNotFound from "../pages/pageNotFound.vue";

const routes = [
  {
    path: "/",
    name: "Home",
    redirect: "/contacts",
    component: Home,
  },
  {
    path: "/contacts/",
    name: "ContactManager",
    component: ContactManager,
  },
  {
    path: "/contacts/add",
    name: "AddContact",
    component: AddContact,
  },
  {
    path: "/contacts/edit/:contactId",
    name: "EditContact",
    component: EditContact,
  },
  {
    path: "/contacts/view/:contactId",
    name: "ViewContact",
    component: ViewContact,
  },

  {
    path: "/:pathMatch(.*)*",
    name: "PageNotFound",
    component: PageNotFound,
  },
];

const router = createRouter({
  history: createWebHashHistory(),
  routes,
});

export default router;
