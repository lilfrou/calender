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
                            <label>attendees</label>
                            <input type="number" name="attendees"  class="form-control" v-model="attendees" required>
                        </div>

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
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
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
  methods:{
      create(){
         axios
        .post("api/event/create", {
          start:  document.getElementById("start").value,
          end:  document.getElementById("end").value,
          title: this.title,
          description: this.description,
          location: this.location,
          attendees: this.attendees,
        }) .then((response) => (this.$emit("evnetCreated",response)),$("#createEvent").modal("hide"))
        .catch((error) => console.log(error))
         .finally(
            () => (this.title = ""),
            (this.description = ""),
            (this.location = ""),
            (this.attendees = ""),
             (document.getElementById("start").value = ""),
              ( document.getElementById("end").value= "")
          );
      }
  }
};
</script>

