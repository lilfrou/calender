<template>
<div class="modal fade" id="detailEvent" tabindex="-1" role="dialog" aria-labelledby="create"  aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">

                    <h3 class="block-title">detail_event</h3>

                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form>
                    <div class="block-content font-size-sm">

                         <div class="form-group">
                            <label>title</label>
                            <input type="text" name="title"  class="form-control" v-model="event.title" required>
                        </div>
                         <div class="form-group">
                            <label>description</label>
                            <input type="text" name="description"  class="form-control"  v-model="event.description" required>
                        </div>
                         <div class="form-group">
                            <label>location</label>
                            <input type="text" name="location"  class="form-control" v-model="event.location" required>
                        </div>
                         <div class="form-group">
                            <label>start</label>
                            <input type="time" name="start_time" id="start_time_event" v-model="start" class="form-control"  required>
                        </div>
                         <div class="form-group">
                            <label>end</label>
                            <input type="time" name="end_time" id="end_time_event" v-model="end" class="form-control"  required>
                        </div>
                         <div class="form-group">
                            <label>attendees</label>
                            <input type="number" name="attendees"  class="form-control" v-model="event.attendees" required>
                        </div>

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                        <button type="button" class="btn btn-danger" @click="destroy">delete</button>
                        <button type="button" class="btn btn-primary" @click="update">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</template>

<script>

export default {

  data() {
    return {
      event:{},
      start:'',
      end:'',

    };
  },
 props: ["user_id","EventId"],
  methods:{
      destroy(){
              axios
        .post('api/event/destroy',{event_id: this.EventId})
        .then((response) =>  (this.$emit("eventDeleted",response)),$("#detailEvent").modal("hide"))
        .catch((error) => console.log(error));
      },
      getEvent(){
              axios
        .get(`api/event/getEvent/${this.EventId}`)
        .then((response) =>  this.event=response.data)
        .catch((error) => console.log(error));
      },
      update(){

               this.start=this.event.start.split(' ', 1)[0]+'T'+this.start;
               this.end=this.event.end.split(' ', 1)[0]+'T'+this.end;

         axios
        .post("api/event/update", {
          id: this.EventId,
          user_id:this.event.user_id,
          start: this.start,
          end: this.end,
          title: this.event.title,
          description: this.event.description,
          location: this.event.location,
          attendees: this.event.attendees,
        }) .then((response) => (this.$emit("eventUpdate",response)),$("#detailEvent").modal("hide"))
        .catch((error) => console.log(error));
      }

  },
    watch:{
      EventId:function(newValue) {
          if(newValue!=0){
          this.getEvent();
          }
      },
       event:function(newValue) {
          this.start = newValue.start.split(' ')[1];
          this.end = newValue.end.split(' ')[1];

      }
  }
};
</script>

