<template>
    <transition name="modal">
        <div class="modal-mask">
            <div class="modal-wrapper">
                <div class="modal-container">

                    <div class="modal-header">
                        <slot name="header">
                            default header
                        </slot>
                    </div>

                    <div class="modal-body">
                        <slot name="body">
                            <select id="event_select" v-model="this.selected">
                                <option v-for="event in events" :value="event.id">{{event.title}}</option>
                            </select>
                        </slot>
                    </div>

                    <div class="modal-footer">
                        <slot name="footer">
                            default footer
                            <button class="modal-default-button" @click="test" ref="#event_select">
                                OK
                            </button>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</template>
<script>
    export default {
        props: [
            'eventId',
            'set_event',
        ],
        data: function() {
            return {
                events: [],
                selected: 17,
            }
        },
        mounted() {
            axios.get('/event')
                .then((response) => {
                    this.events = (response.data && response.data.data) ? response.data.data : [];
                    console.log(this['event-id']);
                    this.selected = this.eventId;
                });
            console.log("Event Selector mounted");
        },
        computed: {
        },
        methods: {
            test (event) {
                this.$emit('close');
                console.log(this.$el.querySelector("#event_select"));
            },
        },
    }
</script>
