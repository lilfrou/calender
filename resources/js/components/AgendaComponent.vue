<template>
  <div>
    <Fullcalendar :options="calendarOptions" />
  </div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import DayGridPlugin from "@fullcalendar/daygrid";
import TimeGridPlugin from "@fullcalendar/timegrid";
import InteractionPlugin from "@fullcalendar/interaction";
import ListPlugin from "@fullcalendar/list";

export default {
  components: { Fullcalendar },
  data() {
    return {
         calendarOptions: {
      plugins: [
        DayGridPlugin,
        TimeGridPlugin,
        InteractionPlugin,
        ListPlugin,
      ],
       initialView: 'dayGridMonth'
    }
    }
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
