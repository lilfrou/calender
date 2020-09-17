<template>
  <div>
    <Fullcalendar :options="calendarOptions" />
    <button
      id="add-button"
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#createEvent"
      style="display: none;"
    >Add</button>
    <addEvent-component @evnetCreated="this.getEvents"></addEvent-component>
  </div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import DayGridPlugin from "@fullcalendar/daygrid";
import TimeGridPlugin from "@fullcalendar/timegrid";
import InteractionPlugin from "@fullcalendar/interaction";
import ListPlugin from "@fullcalendar/list";
import { mapGetters } from "vuex";

export default {
  components: { Fullcalendar },
  //   computed: {
  //     ...mapGetters(["EVENTS"]),
  //   },
  data() {
    return {
      calendarOptions: {
        plugins: [DayGridPlugin, TimeGridPlugin, InteractionPlugin, ListPlugin],
        initialView: "dayGridMonth",
        locale: "en",
        headerToolbar: {
          left: "dayGridMonth timeGridWeek timeGridDay listWeek",
          center: "title",
          right: "prev today next",
        },
        // weekends:false,
        showNonCurrentDates: false,
        fixedWeekCount: false,
        selectable: true,
        events: "",
        select: function (selectionInfo) {
          document.getElementById("add-button").click();
          document.getElementById("start").value=selectionInfo.startStr;
           document.getElementById("end").value=selectionInfo.endStr;
        },
      },

    };
  },
  //   mounted() {
  //     console.log("Component mounted.");
  //   },
  created() {
    this.getEvents();
  },
  methods: {
    getEvents() {
      axios
        .get("api/event/index")
        .then((response) => (this.calendarOptions.events = response.data))
        .catch((error) => console.log(error));
    },

  },
};
</script>
