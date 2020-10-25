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
                <span v-if="msg.title">{{ msg.title }}</span>
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
                <label for="start_time">start</label>
                <input
                  type="time"
                  name="start_time"
                  id="start_time"
                  v-model="start_time"
                  class="form-control"
                  required
                />
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>hours</label>

                    <select class="form-control" v-model="hours" required>
                      <option selected disabled>Empty</option>
                      <option v-for="(n, hour) in 25" :key="hour" :value="hour">
                        <p v-if="hour === 0 || hour === 1">{{ hour }} hour</p>
                        <p v-else>{{ hour }} hours</p>
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>minutes</label>

                    <select class="form-control" v-model="minutes" required>
                      <option selected disabled>Empty</option>
                      <option
                        v-for="(n, minute) in 60"
                        :key="minute"
                        :value="minute"
                      >
                        <p v-if="minute === 0 || minute === 1">
                          {{ minute }} minute
                        </p>
                        <p v-else>{{ minute }} minutes</p>
                      </option>
                    </select>
                  </div>
                </div>
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
                    <button
                      class="btn btn-sm btn-outline-info"
                      @click="togglePassword"
                      type="button"
                    >
                      Show
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
              <button
                type="button"
                class="btn  btn-sm btn-outline-secondary"
                @click="reset"
                data-dismiss="modal"
              >
                close
              </button>
              <button
               id="create_button"
                type="button"
                class="btn  btn-sm btn-outline-primary"
                @click="create"
              >
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
      hours: "Empty",
      minutes: "Empty",
      start: "",
      end: "",
      type: "",
      password: "",
      msg: [],
    };
  },
  props: ["user_id", "infoSelected"],
  methods: {
    reset() {
      this.title = "";
      this.description = "";
      this.start_time = "";
      (this.hours = "Empty"), (this.minutes = "Empty"), (this.start = "");
      this.end = "";
      this.type = "";
      this.password = "";
    },
    togglePassword() {
      var x = document.getElementById("password-0");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    },
    validateTitle(value) {
      console.log(value);
      if (this.title.length!=1) {
      this.msg["title"] = "";

      } else {
          this.msg["title"] = "Title is required";
        return;

      }
    },

    create() {
      //   if (this.type == "dayGridMonth") {
      //     this.start += "T" + this.start_time;
      //     this.end += "T" + this.end_time;
      //   } else {
      //     return;
      //   }
     this.validateTitle("null");
     $('#create_button').html('<span id="span_create" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').attr("disabled", true);
      axios
        .post("api/event/createmeeting", {
          user_id: this.user_id,
          duration: this.hours * 60 + this.minutes,
          start: this.start + "T" + this.start_time,
          //   end: this.end,
          title: this.title,
          description: this.description,
          password: this.password,
        })
        .then(
          (response) => (
            this.$emit("evnetCreated", response), console.log(response.data)
          ),
        )
        .catch((error) => console.log(error))
        .finally(() => this.reset());
    },
  },
  watch: {
    infoSelected: function (newValue) {
      this.start = newValue.startStr;
      //   this.end = newValue.startStr;
      this.type = newValue.view.type;
    },
    title(value) {
      // binding this to the data value in the email input

      this.validateTitle(value);
    },
  },
};
</script>

<style scoped>
span {
  padding-top: 0px;
  margin-top: 0px;
  font-size: 12px; color:red;
}
</style>
