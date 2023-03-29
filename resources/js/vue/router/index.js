import { createRouter, createWebHistory } from "vue-router";
import LoginView from "../../../views/loginView.vue";

const routes = [
  {
    path: "/",
    name: "login",
    component: LoginView,
  },
  {
    path: "/appointment",
    name: "appointment",
    component: () =>
      import(/* webpackChunkName: "about" */ "../../../views/appointmentView.vue"),
    // meta: {
    //   authRequired: true,
    // },
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;