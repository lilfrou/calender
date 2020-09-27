<template ref="miaw">
  <div>
    <div class="bg-body-light" >
      <div class="content content-full">
        <div style="margin-top:20px;"
          class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center"
        >
          <h1 class="flex-sm-fill h3 my-2">
            Calender
            <small
              class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted"
              >#{{ this.user.auth }}</small
            >

            <div v-if="this.user.auth == 'admin'" class="float-right">
              <button
                id="filter-button"
                type="button"
                class="btn btn-outline-primary"
                data-toggle="modal"
                data-target="#filterEvent"
              >
                Filter
              </button>
            </div>
            <filtercomponent @eventFiltred="refresh"></filtercomponent>
            <detailcomponent
                :EventId="EventId"
              @eventDeleted="getEvents"
              @eventUpdate="getEvents"
            />
          </h1>
        </div>
      </div>
    </div>
    <button
      id="add-button"
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#createEvent"
      style="display: none"
    >
      Add
    </button>
    <button
      id="detail-button"
      type="button"
      class="btn btn-primary"
      data-toggle="modal"
      data-target="#detailEvent"
      style="display: none"
    >


      detail
    </button>
    <addEvent-component
      @evnetCreated="getEvents"
      :user_id="user.id"
      :infoSelected="infoSelected"
    ></addEvent-component>
      <Fullcalendar :options="calendarOptions"  style="margin-right:10px;margin-left:10px"/>
  </div>

</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import DayGridPlugin from "@fullcalendar/daygrid";
import TimeGridPlugin from "@fullcalendar/timegrid";
import InteractionPlugin from "@fullcalendar/interaction";
import ListPlugin from "@fullcalendar/list";
import { mapGetters } from "vuex";
import filtercomponent from "./FilterEventComponent.vue";
import detailcomponent from "./DetailEventComponent";

export default {
  components: { Fullcalendar, filtercomponent, detailcomponent },
  //   computed: {
  //     ...mapGetters(["EVENTS"]),
  //   },
  data() {
    return {
        infoSelected:{},
      EventId: 0,
      calendarOptions: {
        plugins: [DayGridPlugin, TimeGridPlugin, InteractionPlugin, ListPlugin],
        initialView: "dayGridMonth",
        locale: "en",
        headerToolbar: {
          left: "title",
          center: "",
          right: "prev today next",
        },
        titleFormat:{ year: 'numeric', month: 'short' },
        // weekends:false,
        showNonCurrentDates: false,
        fixedWeekCount: false,
        selectable: true,
        allDaySlot: false,
        dayMaxEventRows: 4,
        displayEventTime: true,
        longPressDelay:100,
        handleWindowResize:true,
        windowResizeDelay:0,

        // displayEventEnd:true,

        // editable:true,
        events: {},
        select: (selectionInfo) =>{
          this.infoSelected=selectionInfo;
          document.getElementById("add-button").click();

        },
        eventClick:  (eventClickInfo) =>{

             this.EventId= eventClickInfo.event.id;
             document.getElementById("detail-button").click();
        },

      },
    };
  },
  created() {
    this.getEvents();
  },
  props: ["user"],

  methods: {
    getEvents() {
    this.EventId=0;
      axios
        .get(`api/event/login/${this.user.id}`)
        .then((response) => (this.calendarOptions.events = response.data))
        .catch((error) => console.log(error));
    },
    refresh(filtred) {
      this.calendarOptions.events = filtred.data;
    },
  },
};
</script>
