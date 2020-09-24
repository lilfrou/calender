<template>
<div class="modal fade" id="createEvent" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">

                    <h3 class="block-title">add_event</h3>

                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form>
                    <div class="block-content font-size-sm">


                            <input type="hidden" id="start" name="start" class="form-control"  required>

                          <input type="hidden" name="end"  id="end" class="form-control"  required>
                         <input type="hidden" id="type" name="type" class="form-control"  required>

                         <div class="form-group">
                            <label>title</label>
                            <input type="text" name="title"  class="form-control" v-model="title" required>
                        </div>
                         <div class="form-group">
                            <label>description</label>
                            <input type="text" name="description"  class="form-control"  v-model="description" required>
                        </div>
                         <div class="form-group">
                            <label>location</label>
                            <input type="text" name="location"  class="form-control" v-model="location" required>
                        </div>
                         <div class="form-group">
                            <label>start</label>
                            <input type="time" name="start_time" id="start_time"  v-model="start_time" class="form-control"  required>
                        </div>
                         <div class="form-group">
                            <label>end</label>
                            <input type="time" name="end_time" id="end_time" v-model="end_time" class="form-control"  required>
                        </div>
                         <div class="form-group">
                            <label>attendees</label>
                            <input type="number" name="attendees"  class="form-control" v-model="attendees" required>
                        </div>

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-secondary" @click="reset" data-dismiss="modal">close</button>
                        <button type="button" class="btn btn-primary" @click="create">create</button>
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
      title: "",
      description: "",
      location: "",
      attendees: "",
      start_time:"",
      end_time:"",
      start:"",
      end:"",
      type:"",
    };
  },
  mounted() {
    console.log("Component mounted.");
    console.log(this.user_id);

  },
 props: ["user_id"],
  methods:{
      reset(){
          this.title="";
          this.description="";
          this.location="";
          this.attendees="";
          document.getElementById("start").value = "";
          document.getElementById("end").value= "";
          this.start_time="";
          this.end_time="";
          this.start="";
          this.end="";
          this.type="";

      },
      create(){


           if(document.getElementById("type").value=='dayGridMonth'){
               this.start=document.getElementById("start").value+'T'+this.start_time;
               this.end=  document.getElementById("start").value+'T'+this.end_time;
           }else{
               this.start=document.getElementById("start").value+'T'+this.start_time;
               this.end=  document.getElementById("end").value+'T'+this.end_time;
           }
         axios
        .post("api/event/create", {
          user_id:this.user_id,
          start:  this.start,
          end: this.end,
          title: this.title,
          description: this.description,
          location: this.location,
          attendees: this.attendees,
        }) .then((response) => (this.$emit("evnetCreated",response)),$("#createEvent").modal("hide"))
        .catch((error) => console.log(error))
         .finally(
            () => this.reset()
          );
      }

  }
};
</script>

