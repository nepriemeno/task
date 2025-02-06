import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/",
        component: () => import("./List.vue"),
    },
    {
        path: "/:id",
        component: () => import("./Page.vue"),
    },
];

export default createRouter({
    history: createWebHistory(),
    routes,
});
