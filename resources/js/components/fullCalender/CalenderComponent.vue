<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <form @submit.prevent>
                    <div class="form-group">
                        <label for="event_name">Event Name</label>
                        <input
                            type="text"
                            id="event_name"
                            class="form-control"
                            v-model="newEvent.event_name"
                        />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input
                                    type="date"
                                    id="start_date"
                                    class="form-control"
                                    v-model="newEvent.start_date"
                                />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input
                                    type="date"
                                    id="end_date"
                                    class="form-control"
                                    v-model="newEvent.end_date"
                                />
                            </div>
                        </div>
                        <div class="col-md-6 mb-4" v-if="addingMode">
                            <button
                                type="submit"
                                class="btn btn-sm btn-primary"
                                @click="addNewEvent"
                            >
                                Save Event
                            </button>
                        </div>
                        <template v-else>
                            <div class="col-md-6 mb-4">
                                <button
                                    class="btn btn-sm btn-success"
                                    @click="updateEvent"
                                >
                                    Update
                                </button>
                                <button
                                    class="btn btn-sm btn-danger"
                                    @click.prevent="deleteEvent"
                                >
                                    Delete
                                </button>
                                <button
                                    class="btn btn-sm btn-secondary"
                                    @click="addingMode = !addingMode"
                                >
                                    Cancel
                                </button>
                            </div>
                        </template>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <!-- <Fullcalendar @eventClick="showEvent" :plugins="calendarPlugins" :events="events"/> -->
                <FullCalendar :options="calendarOptions" />
            </div>
        </div>
    </div>
</template>

<script>
import FullCalendar from "@fullcalendar/vue3";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

export default {
    name: "CalenderComponent",
    data() {
        return {
            newEvent: {
                event_name: "",
                start_date: "",
                end_date: "",
            },
            calendarOptions: {
                plugins: [dayGridPlugin, interactionPlugin],
                initialView: "dayGridMonth",
                events: [],
                dateClick: this.handleDateClick,
                eventClick: this.showEvent,
                selectable: true,
            },
            addingMode: true,
            indexToUpdate: "",
        };
    },
    components: {
        FullCalendar, // make the <FullCalendar> tag available
    },
    created() {
        this.getEvents();
    },
    methods: {
        async addNewEvent() {
            await axios
                .post("/api/full-calendar", {
                    ...this.newEvent,
                })
                .then((data) => {
                    console.log(data);
                    this.getEvents(); // update our list of events
                    this.resetForm(); // clear newEvent properties (e.g. title, start_date and end_date)
                })
                .catch((err) =>
                    console.log("Unable to add new event!", err.response.data)
                );
        },
        deleteEvent() {
            var self = this;
            axios
                .delete("/api/full-calendar/" + self.indexToUpdate)
                .then((resp) => {
                    self.resetForm();
                    self.getEvents();
                    self.addingMode = !self.addingMode;
                    self.indexToUpdate = "";
                })
                .catch((err) =>
                    console.log("Unable to delete event!", err.response.data)
                );
        },
        updateEvent() {
            let self = this;
            axios
                .put("/api/full-calendar/" + self.indexToUpdate, {
                    ...self.newEvent,
                })
                .then((resp) => {
                    self.resetForm();
                    self.getEvents();
                    self.addingMode = !self.addingMode;
                    self.indexToUpdate = "";
                })
                .catch((err) =>
                    console.log("Unable to update event!", err.response.data)
                );
        },
        showEvent(arg) {
            this.addingMode = false;
            const { id, title, start, end } = this.calendarOptions.events.find(
                (event) => event.id === +arg.event.id
            );
            this.indexToUpdate = id;
            this.newEvent = {
                event_name: title,
                start_date: start,
                end_date: end,
            };
        },
        handleDateClick: function (arg) {
            console.log(arg, arg.dateStr);
        },

        getEvents() {
            axios
                .get("/api/full-calendar")
                .then((resp) => (this.calendarOptions.events = resp.data.data))
                .catch((err) => console.log(err.response.data));
        },
        resetForm() {
            Object.keys(this.newEvent).forEach((key) => {
                this.newEvent[key] = "";
            });
        },
    },
};
</script>

<style lang="scss" scoped></style>
