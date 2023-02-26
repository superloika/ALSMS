<template>
    <v-card>
        <v-toolbar class="elevation-0">
            <v-toolbar-title>
                Class Announcements
            </v-toolbar-title>
            <v-spacer></v-spacer>
        </v-toolbar>

        <v-card-text>
            <v-container fluid>
                <v-textarea v-model="message" outlined>

                </v-textarea>
                <v-btn color="primary" @click="save($route.params.id, message)" :disabled="message==''">
                    Post</v-btn>
            </v-container>
            <br>
            <v-data-table :headers="tableHeaders" :items="AnnouncementStore.state.announcements"
                class="elevation-1">
                <template v-slot:[`item.actions`]="{item}">
                    <v-btn icon small color="error" class="ml-2" @click="deleteAnnouncement(item.id)">
                        <v-icon>mdi-delete</v-icon>
                    </v-btn>
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            tableHeaders: [
                {text:"Announcement", value:"message"},
                {text:"Date", value:"created_at"},
                {text:"Actions", value:"actions"},
            ],
            message: '',
        }
    },

    methods: {
        async save(class_id, message) {
            let url = `${this.AppStore.state.siteUrl}announcements/saveAnnouncement`;
            await axios.post(url,{
                    class_id: class_id,
                    message: message,
                }).then(res=>{
                    this.message='';
                    this.AppStore.toast(res.data, 2500,'success');

                }).catch(e=>{
                    if(e.response) {
                        console.log(e.response);
                        if(e.response.status=="409") {
                            this.AppStore.toast(e.response.data, 2500,'error');
                        } else {
                            this.AppStore.toast(e, 2500,'error');
                        }
                    }
                }).finally(()=>{
                    this.AnnouncementStore.getAnnouncements(this.$route.params.id);
                })
                ;
        },

        async deleteAnnouncement(id) {
            if(!confirm('Delete selected announcement?')) return;

            let url = `${this.AppStore.state.siteUrl}announcements/deleteAnnouncement`;
            await axios.post(url,{
                    announcement_id: id
                }).then(res=>{
                    this.AppStore.toast(res.data, 2500,'success');
                }).catch(e=>{
                    this.AppStore.toast(e, 2500,'error');
                }).finally(()=>{
                    this.AnnouncementStore.getAnnouncements(this.$route.params.id);
                })
                ;
            // try {

            // } catch (error) {
            // }
        },
    },

    created() {
    }
}
</script>
