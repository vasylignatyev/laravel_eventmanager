<template>
    <form @submit.prevent="submit" enctype="multipart/form-data">
        <div class="form-group">
            <label for="event" class="col-form-label">Event</label>
            <select type="event" class="custom-select" v-model="fields.event_id" required>
                <option v-for="option in eventList" :value="option.id">{{option.title}}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="start_date" class="col-form-label">Start Date</label>
            <input type="date" required v-model="fields.start_date">
        </div>
        <hr>
        <input type="submit" class="btn btn-primary" value="Save">
        <hr>
    </form>
</template>
<script>
    export default {
        props:[
            'schedule',
        ],
        data() {
            return {
                newSchedule: true,
                eventList: [],
                fields: {},
                errors: {},
                success: false,
                loaded: true,
                scheduleModel: {},
            }
        },
        mounted() {
            axios.get("/event/list")
                .then( result => {
                    this.eventList = result.data;
                });
            console.log("mounted");
            if(this.schedule) {
                this.newSchedule = false;
                this.scheduleModel = JSON.parse(this.schedule);
                this.fields.event_id = this.scheduleModel.event_id;
                this.fields.start_date = this.scheduleModel.start_date;
            }
        },
        computed: {
        },
        methods: {
            submit() {
                if (this.loaded) {
                    console.log(this.fields);
                    this.loaded = false;
                    this.success = false;
                    this.errors = {};
                    if(this.newSchedule) {
                        axios.post('/schedule', this.fields).then(response => {
                            this.loaded = true;
                            this.success = true;
                        }).catch(error => {
                            this.loaded = true;
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors || {};
                            }
                        });
                    } else {
                        axios.update('/schedule/' + this.eventId, this.fields).then(response => {
                            this.loaded = true;
                            this.success = true;
                        }).catch(error => {
                            this.loaded = true;
                            if (error.response.status === 422) {
                                this.errors = error.response.data.errors || {};
                            }
                        });
                    }
                }
            },
        },
    }
</script>
