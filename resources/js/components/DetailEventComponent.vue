<template>
<div class="modal fade" id="detailEvent" tabindex="-1" role="dialog" aria-labelledby="create" @mouseenter="getEvent" aria-hidden="true">
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

                         <input type="hidden" id="event_id" name="event_id" class="form-control"  required>

                         <input type="hidden" id="start_event" name="start" class="form-control" v-model="event.start" required>

                         <input type="hidden" name="end_event"  id="end_event" class="form-control" v-model="event.end" required>
                         <input type="hidden" id="type_event" name="type" class="form-control"  required>

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
                            <input type="time" name="start_time" id="start_time_event" v-model="start_time_event" class="form-control"  required>
                        </div>
                         <div class="form-group">
                            <label>end</label>
                            <input type="time" name="end_time" id="end_time_event" v-model="end_time_event" class="form-control"  required>
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
$('#detailEvent').on('show.bs.modal', function (e) {
  alert('miaws');
});
export default {

  data() {
    return {
      event:{},
      start_time_event:'',
      end_time_event:'',

    };
  },
  mounted() {
    console.log("Component mounted.");
    console.log(this.user_id);

  },
 props: ["user_id"],
  methods:{
      destroy(){

       var event_id=document.getElementById("event_id").value;
              axios
        .post('api/event/destroy',{event_id: event_id})
        .then((response) =>  (this.$emit("eventDeleted",response)),$("#detailEvent").modal("hide"))
        .catch((error) => console.log(error));
      },
    //   getDetail(){
    //     alert("miaw");
    //   },
      getEvent(){
                  var event_id=document.getElementById("event_id").value;
              axios
        .get(`api/event/getEvent/${event_id}`)
        .then((response) =>  this.event=response.data)
        .catch((error) => console.log(error));
            // var ti=document.getElementById('start_event').value;
            // alert(ti);

      },
      update(){

           if(document.getElementById("type_event").value=='dayGridMonth'){
               this.start_time_event=document.getElementById("start_event").value.split(' ', 1)[0]+'T'+this.start_time_event;
               this.end_time_event=document.getElementById("end_event").value.split(' ', 1)[0]+'T'+this.end_time_event;
           }else{
                this.start_time_event=document.getElementById("start_event").value+'T'+this.start_time_event;
                this.end_time_event=  document.getElementById("end_event").value+'T'+this.end_time_event;
           }
         axios
        .post("api/event/update", {
          id: this.event.id,
          user_id:this.event.user_id,
          start:   this.start_time_event,
          end: this.end_time_event,
          title: this.event.title,
          description: this.event.description,
          location: this.event.location,
          attendees: this.event.attendees,
        }) .then((response) => (this.$emit("eventUpdate",response)),$("#detailEvent").modal("hide"))
        .catch((error) => console.log(error));
      }

  },
  watch:{
      event:function(newValue) {
          console.log(newValue)
        //   if(!this.start_time_event && !this.end_time_event){
          this.start_time_event = newValue.start.split(' ')[1];
          this.end_time_event = newValue.end.split(' ')[1];
        //   }

      }
  }
};
</script>

