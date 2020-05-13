<template>
    <div>
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
            <div cclass="btn-block">
                <input type="submit" class="btn btn-large btn-lg btn-primary" value="Save">
                <input type="button" @click="del" class="btn btn-lg btn-danger" value="Delete">
            </div>
        </form>
    </div>
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
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
                    this.loaded = false;
                    this.success = false;
                    this.errors = {};
                    let url = null;
                    let method = "POST";
                    if(this.newSchedule) {
                        url = '/schedule';
                    } else {
                        method = 'PUT';
                        url = '/schedule/' + this.scheduleModel.id
                    }
                    this.fetch(url, this.fields,method)
                    .then(date => {
                            this.success = true;
                        })
                    .catch(error=> {
                        if (error.response && error.response.status === 422) {
                            this.errors = error.response.data.errors || {};
                        }
                    })
                    .finally(() => {
                        this.loaded = true;
                    });
                }
            },
            del(event) {
                event.preventDefault();
                if(this.schedule) {
                    console.log("Before");
                    this.fetch('/schedule/' + this.scheduleModel.id, {}, "DELETE");
                    }
            },
            fetch(url, data, method = "POST") {
                const options = {
                    method: method,
                    //credentials: "same-origin",
                    body: JSON.stringify({...data, _token: this.csrf}),
                    //mode: 'no-cors',
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": this.csrf,
                    },
                };
                return fetch(url, options).then(responce => {
                    if( responce.redirected ) {
                        window.location.href = responce.url;
                    }
                    return responce;
                })
                .catch(error => {
                    console.log('catch: ', error);
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
            }
        },
    }
</script>
