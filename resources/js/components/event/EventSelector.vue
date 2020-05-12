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
                            <select id="event_select" v-model="selectModel" @change="chang">
                                <option v-for="event in events" :value="event">{{event.title}}</option>
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
            'selectedEvent',
        ],
        data() {
            return {
                events: null,
                selectModel: null,
                currentEventId: null,
            }
        },
        mounted() {
            axios.get('/event/list')
                .then((response) => {
                    const events = (response.data) ? response.data : [];
                    return(events);
                })
                .then((ev => {
                    this.events = ev;
                    this.selectModel = ev.find( ev => ev.id == this.eventId );
                }));
            this.currentEventId = parseInt(this.eventId);
            this.$parent.eventId = this.currentEventId;
        },
        computed: {
        },
        methods: {
            test (event) {
                const eventSelect = this.$el.querySelector("#event_select");
                const current = $(this.$parent.current);
                current.text(this.selectModel.title).attr('event-id', this.selectModel.id)
                this.$emit('close');
            },
            chang (event) {
                this.currentEventId = this.selectModel.id;
                this.$parent.eventId = this.currentEventId;
                console.log("Changed: ", event.target, this.selectModel.id);
            }
        },
    }
</script>
