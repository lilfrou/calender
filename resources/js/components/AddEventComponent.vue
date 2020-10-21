<template>
  <div
    class="modal fade"
    id="createEvent"
    tabindex="-1"
    role="dialog"
    aria-labelledby="create"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="block block-themed block-transparent mb-0">
          <div class="block-header bg-primary-dark">
            <h3 class="block-title">add_event</h3>

            <div class="block-options">
              <button
                type="button"
                class="btn-block-option"
                data-dismiss="modal"
                aria-label="Close"
              >
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <form>
            <div class="block-content font-size-sm">
              <div class="form-group">
                <label>title</label>
                <input
                  type="text"
                  name="title"
                  class="form-control"
                  v-model="title"
                  required
                />
              </div>
              <div class="form-group">
                <label>description</label>
                <input
                  type="text"
                  name="description"
                  class="form-control"
                  v-model="description"
                  required
                />
              </div>

              <div class="form-group">
                <label>start</label>
                <input
                  type="time"
                  name="start_time"
                  id="start_time"
                  v-model="start_time"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group">
                <label>end</label>
                <input
                  type="time"
                  name="end_time"
                  id="end_time"
                  v-model="end_time"
                  class="form-control"
                  required
                />
              </div>
              <div class="form-group">
                <label>password</label>
                <div class="input-group mb-3">
                  <input
                  id="password-0"
                    type="password"
                    class="form-control"
                    aria-label="Recipient's username"
                    maxlength="10"
                    aria-describedby="basic-addon2"
                    v-model="password"
                    required
                  />
                  <div class="input-group-append">
                    <button class="btn btn-sm btn-outline-info" @click="togglePassword" type="button">
                      Show
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
              <button
                type="button"
                class="btn btn-secondary"
                @click="reset"
                data-dismiss="modal"
              >
                close
              </button>
              <button type="button" class="btn btn-primary" @click="create">
                create
              </button>
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
      start_time: "",
      end_time: "",
      start: "",
      end: "",
      type: "",
      password: "",
    };
  },
  props: ["user_id", "infoSelected"],
  methods: {
    reset() {
      this.title = "";
      this.description = "";
      this.start_time = "";
      this.end_time = "";
      this.start = "";
      this.end = "";
      this.type = "";
      this.password = "";
    },
    togglePassword(){
         var x = document.getElementById("password-0");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
    },
    create() {
      if (this.type == "dayGridMonth") {
        this.start += "T" + this.start_time;
        this.end += "T" + this.end_time;
      } else {
        return;
      }
      axios
        .post("api/event/createmeeting", {
          user_id: this.user_id,
          start: this.start,
          end: this.end,
          title: this.title,
          description: this.description,
          password: this.password,
        })
        .then(
          (response) => (
            this.$emit("evnetCreated", response),
            console.log(response.data)
          ),
          $("#createEvent").modal("hide"),
           this.$swal({
              title: 'meeting created',
              width: "250px",
              icon: "success",
            })
        )
        .catch((error) => console.log(error))
        .finally(() => this.reset());
    },
  },
  watch: {
    infoSelected: function (newValue) {
      this.start = newValue.startStr;
      this.end = newValue.startStr;
      this.type = newValue.view.type;
    },
  },
};
</script>

