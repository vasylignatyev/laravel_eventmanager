<template>
    <div>
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>
            <div class="col-md-6">
                <input
                    class="form-control"
                    name="name"
                    type="text"
                    placeholder="Name"
                    autocomplete="name" autofocus
                    required=true
                    v-model="tr.name"
                >
            </div>
        </div>

        <div class="form-group row">
            <label for="second_name" class="col-md-4 col-form-label text-md-right">Second Name</label>
            <div class="col-md-6">
                <input
                    class="form-control"
                    name="second_name"
                    type="text"
                    placeholder="Second Name"
                    autocomplete="second_name" autofocus
                    required=true
                    v-model="tr.second_name"
                >
            </div>
        </div>

        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last Name</label>
            <div class="col-md-6">
                <input
                    class="form-control"
                    name="last_name"
                    type="text"
                    placeholder="Last Name"
                    autocomplete="last_name" autofocus
                    v-model="tr.last_name"
                >
            </div>
        </div>

        <div class="form-group row">
            <label for="position" class="col-md-4 col-form-label text-md-right">Position</label>
            <div class="col-md-6">
                <input
                    class="form-control"
                    name="position"
                    type="text"
                    placeholder="Position"
                    autocomplete="position" autofocus
                    required=true
                    v-model="tr.position"
                >
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
            <div class="col-md-6">
                <input
                    class="form-control"
                    name="email"
                    type="email"
                    placeholder="Email"
                    autocomplete="email" autofocus
                    required=true
                    v-model="tr.email"
                >
            </div>
        </div>

        <div class="form-group row">
            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
            <div class="col-md-6">
                <textarea
                    name="description"
                    placeholder="Description"
                    v-model="tr.description"
                ></textarea>
            </div>

        </div>
        <input type="submit" value="Save" class="btn btn-primary">
    </div>
</template>
<script>
    export default {
        props: {
            trainer: {
                type: Object,
                default: () => ({})
             }
        },
        data() {
            return {
                tr: null,
            }
        },
        mounted() {
            this.tr = JSON.parse(this.trainer);
        },
        computed: {
        },
        methods: {
        },
    }
</script>
