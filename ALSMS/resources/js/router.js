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
                    path: "classes",
                    name: "student.classes",
                    component: ()=>import("./pages/Student/Classes"),
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

        // TEACHER ==============================================================================
        {
            path: "/teacher",
            name: "teacher",
            component: { render: h => h('router-view') },
            children: [
                {
                    path: "dashboard",
                    name: "teacher.dashboard",
                    component: ()=>import("./pages/Teacher/Dashboard.vue"),
                },
                {
                    path: "classes",
                    name: "teacher.classes",
                    component: ()=>import("./pages/Teacher/Classes"),
                },
                {
                    path: "classes/:id",
                    name: "teacher.view_class",
                    component: ()=>import("./pages/Teacher/Classes/ViewClass"),
                },
                // {
                //     path: "enrollment",
                //     name: "teacher.enrollment",
                //     component: ()=>import("./pages/Admin/Enrollment"),
                // },
                // {
                //     path: "maintenance",
                //     name: "teacher.maintenance",
                //     component: ()=>import("./pages/Teacher/Maintenance"),
                // },
            ]
        },
        // /TEACHER ==============================================================================

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
                    path: "enrollment",
                    name: "admin.enrollment",
                    component: ()=>import("./pages/Admin/Enrollment"),
                },
                {
                    path: "maintenance",
                    name: "admin.maintenance",
                    component: ()=>import("./pages/Admin/Maintenance"),
                },
                {
                    path: "reports",
                    name: "reports.maintenance",
                    component: ()=>import("./pages/Admin/Reports"),
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
