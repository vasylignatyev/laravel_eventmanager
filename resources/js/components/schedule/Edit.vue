<script>
    export default {
        props: [
            'trainer',
            'schedule',
        ],
        data() {
            return {
                showModal: false,
                scheduleModel: [],
            }
        },
        mounted() {
            this.scheduleModel = JSON.parse(this.schedule);
        },
        computed: {
        },
        methods: {
            set_event(event)
            {
                console.log('set_event');
                this.showModal = !this.showModal;
                this.eventId = $(event.target).attr('event-id');
                this.current = event.target;
            },
            delete(event) {
                const scheduleId = $(event.target).attr('schedule-id');
                axios.delete("/schedule/" + scheduleId);
            },
            add(event) {
                axios.get("/schedule/create")
                .then( resp => console.log(resp));
            },
        },
    }
</script>
