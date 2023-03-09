<template>


    <AccountsEdit></AccountsEdit>
</template>

<script>
export default {
    components: {
        AccountsEdit: () => import("../ManageAccounts/AccountsEdit.vue")
    },

    computed: {
        userInitial() {
            let name = this.AuthUser.name;
            return name[0].toString().toUpperCase();
        }
    },
    created() {
        this.ManageAccounts.editAccount(this.AuthUser)
    },
    mounted() {
        console.log("Account page mounted.");
    },

    // beforeRouteEnter (to, from, next) {
    //     if(window.AuthUser.user_type === 'super_admin') {
    //         next();
    //     } else {
    //         alert('Access denied!');
    //         next(from);
    //     }
    // }
};
</script>
