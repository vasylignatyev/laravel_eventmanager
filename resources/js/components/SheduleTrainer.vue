<template>
    <div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="trainer in trainers">
                <td>
                    <span class="pr-2">{{trainer.name}}</span><span>{{trainer.second_name}}</span>
                </td>
                <td>
                    <span>{{trainer.pivot.role}}</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
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
        },
        data() {
            return {
            }
        },
        mounted() {
        },
        computed: {
        },
        methods: {
        },
    }
</script>
