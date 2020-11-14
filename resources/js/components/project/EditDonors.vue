<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Available Donors</th>
                <th>Current Donors</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    <li v-for="donor in this.localAvailableDonors">{{donor.title}}<a href="#" v-on:click="addDonor(donor)">&gt&gt;</a></li>
                </td>
                <td>
                    <li v-for="donor in this.localCurrentDonors"><a href="#" v-on:click="delDonor(donor)">&lt;&lt;</a>{{donor.title}}</li>
                </td>
            </tr>
            </tbody>
        </table>
        <button class="btn-danger" v-on:click="oncancel()">Cancel</button>
        <button class="btn-primary" v-on:click="saveDonors">Save</button>
    </div>
</template>

<script>
export default {
    name: "EditDonors",
    props: {
        project: {
            type: Object,
            require: true,
        },
        currentDonors: {
            type: Array,
            require: true,
        },
        availableDonors: {
            type: Array,
            require: true,
        },
    },
    data: function () {
        return {
            localAvailableDonors: [...this.availableDonors],
            localCurrentDonors: [...this.currentDonors],
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
        addDonor: function (donor) {
            this.localAvailableDonors.splice(this.localAvailableDonors.indexOf(donor), 1);
            this.localCurrentDonors.push(donor);
        },
        delDonor: function (donor) {
            this.localCurrentDonors.splice(this.localCurrentDonors.indexOf(donor), 1);
            this.localAvailableDonors.push(donor);
        },
        donorReducer: function(accumulator, currentValue) {
            accumulator.push(currentValue.id);
            return accumulator;
        },
        saveDonors: function () {
            if (this.loaded) {
                this.loaded = false;
                this.success = false;
                this.errors = {};
                let url = `/project/${this.project.id}/donors`;
                let donors = this.localCurrentDonors.reduce( this.donorReducer, []);
                this.fetch(url, {'donors': donors}, "POST")
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
                    window.location.href = `/project/${this.project.id}`;
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
