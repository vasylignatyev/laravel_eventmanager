<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Available Projects</th>
                <th>Current Projects</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <li v-for="project in this.localAvailableProjects">{{project.title}}<a href="#" v-on:click="addProject(project)">&gt&gt;</a></li>
                </td>
                <td>
                    <li v-for="project in this.localCurrentProjects"><a href="#" v-on:click="delProject(project)">&lt;&lt;</a>{{project.title}}</li>
                </td>
            </tr>
            </tbody>
        </table>
        <button class="btn-danger" v-on:click="oncancel()">Cancel</button>
        <button class="btn-primary" v-on:click="saveProjects">Save</button>
    </div>
</template>

<script>
export default {
    name: "EditProjects",
    props: {
        donor: {
            type: Object,
            require: true,
        },
        currentProjects: {
            type: Array,
            require: true,
        },
        availableProjects: {
            type: Array,
            require: true,
        },
    },
    data: function () {
        return {
            localAvailableProjects: [...this.availableProjects],
            localCurrentProjects: [...this.currentProjects],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            errors: {},
            success: false,
            loaded: true,
        };
    },
    mounted () {
        console.log('mounted function');
    },
    methods: {
        addProject: function (project) {
            this.localAvailableProjects.splice(this.localAvailableProjects.indexOf(project), 1);
            this.localCurrentProjects.push(project);
        },
        delProject: function (project) {
            this.localCurrentProjects.splice(this.localCurrentProjects.indexOf(project), 1);
            this.localAvailableProjects.push(project);
        },
        reducer: function(accumulator, currentValue) {
            accumulator.push(currentValue.id);
            return accumulator;
        },
        saveProjects: function () {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                let url = `/donor/${this.donor.id}/projects`;
                let projects = this.localCurrentProjects.reduce( this.reducer, []);
                this.fetch(url, {'projects': projects}, "POST")
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
                console.log(responce);
                //if( responce.redirected ) {
                    window.location.href = `/donor/${this.donor.id}`;
                //}
                return responce;
            })
                .catch(error => {
                    console.log('catch: ', error);
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });
        },
    },
}
</script>

<style scoped>

</style>
