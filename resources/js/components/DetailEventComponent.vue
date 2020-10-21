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
                            <label>start</label>
                            <input type="time" name="start_time" id="start_time_event" v-model="start" class="form-control"  required>
                        </div>
                         <div class="form-group">
                            <label>end</label>
                            <input type="time" name="end_time" id="end_time_event" v-model="end" class="form-control"  required>
                        </div>
                        <div class="form-group">
                <label>password</label>
                <div class="input-group mb-3">
                  <input
                  id="password-1"
                    type="password"
                    class="form-control"
                    aria-label="Recipient's username"
                    maxlength="10"
                    aria-describedby="basic-addon2"
                    v-model="event.password"
                    required
                  />
                  <div class="input-group-append">
                    <button class="btn btn-sm btn-outline-info" @click="togglePassword" type="button">
                      Show
                    </button>
                  </div>
                </div>
              </div>
               <div class="form-group">
                            <label>join Url</label>
                            <textarea :value="event.join_url"  class="form-control" name="join_url" rows="4" cols="50" readonly>
                            </textarea>
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
        .post('api/event/destroy',{event_id: this.EventId, user_id:this.event.user_id,})
        .then((response) =>  (this.$emit("eventDeleted",response)),$("#detailEvent").modal("hide"),this.$swal({
              title: 'meeting deleted',
              icon: "success",
            }))
        .catch((error) => console.log(error));
      },
      getEvent(){
              axios
        .get(`api/event/getEvent/${this.EventId}`)
        .then((response) =>  this.event=response.data)
        .catch((error) => console.log(error));
      },
       togglePassword(){
         var x = document.getElementById("password-1");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
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
          password: this.event.password
        }) .then((response) => (this.$emit("eventUpdate",response)),$("#detailEvent").modal("hide"),this.$swal({
              title: 'meeting updated',
              icon: "success",
            }))
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

