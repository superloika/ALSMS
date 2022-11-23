import Vue from "vue";

import VueRouter from "vue-router";

// OTHER PAGES
import DashboardPage from "./pages/DashboardPage";
// import AboutPage from "./pages/AboutPage";

// ACCOUNT
import AccountPage from "./pages/AccountPage";
import ManageAccounts from "./pages/ManageAccounts";
import AccountsAdd from "./pages/ManageAccounts/AccountsAdd.vue";

// ERROR PAGES
import ErrorPage404 from "./pages/ErrorPages/ErrorPage404";


Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [

        // OTHER PAGES ===============================================
        {
            path: "/dashboard",
            component: DashboardPage,
            meta: {
                name: "Dashboard"
            }
        },
        // {
        //     path: "/about",
        //     component: AboutPage,
        //     meta: {
        //         name: "AboutPage"
        //     }
        // },


        // ACCOUNT =============================================
        {
            path: "/user-accounts",
            component: ManageAccounts,
            meta: {
                name: "User Accounts"
            }
        },
        {
            path: "/account",
            component: AccountPage,
            meta: {
                name: "Account"
            }
        },
        {
            path: "/account/add",
            component: AccountsAdd,
            meta: {
                name: "Add Account"
            }
        },


        // =====================================================
        {
            path: "/:pathMatch(.*)*",
            component: ErrorPage404
        }
    ]
});


router.beforeEach((to, from, next) => {
    next();
    // window.cancelTokenSource.cancel();
});

export default router;
