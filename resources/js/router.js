import Vue from "vue";
import VueRouter from "vue-router";

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

        // STUDENT ===========================================================================
        {
            path: "/student",
            name: "student",
            component: { render: h => h('router-view') },
            children: [
                {
                    path: "dashboard",
                    name: "student.dashboard",
                    component: ()=>import("./pages/Student/Dashboard.vue"),
                },
                {
                    path: "programs",
                    name: "student.programs",
                    component: ()=>import("./pages/Student/Programs"),
                },
                {
                    path: "announcements",
                    name: "student.announcements",
                    component: ()=>import("./pages/Student/Announcements"),
                },
                {
                    path: "profile",
                    name: "student.profile",
                    component: ()=>import("./pages/Student/Profile"),
                },
            ]
        },
        // /STUDENT ===========================================================================

        // ADMIN ==============================================================================
        {
            path: "/admin",
            name: "admin",
            component: { render: h => h('router-view') },
            children: [
                {
                    path: "dashboard",
                    name: "admin.dashboard",
                    component: ()=>import("./pages/Admin/Dashboard.vue"),
                },
                {
                    path: "maintenance",
                    name: "admin.maintenance",
                    component: ()=>import("./pages/Admin/Maintenance"),
                },
            ]
        },
        // /ADMIN ==============================================================================

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
    const name = to.matched[0].name;

    // if name = either 'student', 'admin', or '' then it needs checking
    if(name !== undefined) {
        if(name !== window.AuthUser.user_type) {
            return false;
        }
    }
    next();
});

export default router;
