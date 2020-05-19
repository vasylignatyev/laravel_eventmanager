<template>
    <form 
        @submit.prevent="submit"
        novalidate="true"
    >
        <div class="alert alert-danger" v-if="errors.length">
          <b>Errors:</b>
          <strong v-for="error in errors">
            {{ error }}
          </strong>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="trainer in fields">
                <td>
                <select v-model="trainer.id">
                    <option v-for="row in trainerList" :value="row.id" :key="row.id">
                       <span class="pr-2">{{row.name}}</span><span>{{row.second_name}}</span>
                    </option>
                </select>
                </td>
                <td>
                    <input type="text" name="role" required v-model="trainer.pivot.role" />
                </td>
                <td>
                    <a href="#" class="glyphicon glyphicon-minus" title="Delete" :trainer_id="trainer.id" @click="del"></a>
                </td>
            </tr>
            </tbody>
        </table>
        <a href="#" class="glyphicon glyphicon-plus" title="Add" @click="add"></a>
        <hr>
        <input type="submit" class="btn btn-lg btn-primary" value="Save"/> 
    </form>
</template>
<script>
    export default {
        props: {
            trainers: {
                type: Array,
                default: [],
             },
            event: {
                type: Object,
                default: {},
            },
            editable: {
                type: Boolean,
                default: false,
            },
            trainerList: {
                type: Array,
                default: () => ([]),
            },
            scheduleId: {
                default: null,
            }
        },
        mounted() {
            this.trainers.forEach(trainer => this.fields.push(trainer));
        },
        data() {
            return {
                fields:[],
                errors:[],
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        },
        computed: {
        },
        methods: {
            del(event) {
                const child = $(event.target).parent().parent();
                const index = child.index();
                this.fields.splice(index, 1);
            },
            add(event) {
                const trainer = {...this.trainerList[0], pivot:{role:null}};
                this.fields.push(JSON.parse(JSON.stringify(trainer)));
            },
            submit(event) {
                this.errors = [];

                const trainer_ids = this.fields.reduce((acc, curr) => 
                {
                    acc.push(curr.id);
                    return acc;
                }, []);

                if(trainer_ids.length !== [...new Set(trainer_ids)].length) {
                    this.errors.push("Trainers duplication");
                }

                if (this.errors.length) {
                  console.error(this.errors);
                  return true;
                }
                const data = this.fields.reduce((acc, curr) => {
                    acc.push({
                        trainer_id: curr.id,
                        role: curr.pivot.role,
                    });
                    return acc;
                }, []);
                
                this.fetch("/api/set-trainer/"+this.scheduleId, {trainers: data}, "PUT");
                console.log(this.scheduleId);
                window.location.href = '/schedule/' + this.scheduleId;
                
            },
            fetch(url, data, method = "POST") {
                const options = {
                    method: method,
                    body: JSON.stringify(data),
                    headers: {"Content-Type": "application/json"},
                };
                return fetch(url, options)
                    .then( (response) => {
                        return response.json();
                    })
                    .then((data) => {
                        console.log(data);
                    })
                    .catch((error) => {
                        console.error(error);
                    });
            },
        },
    }
</script>
