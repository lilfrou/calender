<template>
  <div
    class="modal fade"
    id="createEvent"
    tabindex="-1"
    role="dialog"
    aria-labelledby="create"
    aria-hidden="true"
    ref="createEvent"
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
                @click="reset"
              >
                <i class="fa fa-fw fa-times"></i>
              </button>
            </div>
          </div>
          <form v-on:submit.prevent="create">
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
                <label for="description-0">description</label>
                <textarea
                  class="form-control"
                  id="description-0"
                  rows="3"
                  v-model="description"
                  required
                ></textarea>
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

                    <select
                      class="form-control"
                      v-model="hours"
                      required
                      v-on:change="changed"
                    >
                      <option selected disabled value="">Select</option>
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

                    <select
                      class="form-control"
                      v-model="minutes"
                      required
                      id="minutes-0"
                    >
                      <option selected disabled value="">Select</option>
                      <option
                        v-for="(n, minute) in 60"
                        :key="minute"
                        :value="minute"
                        :id="'minutes_' + minute"
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
                class="btn btn-sm btn-outline-secondary"
                @click="reset"
                data-dismiss="modal"
              >
                close
              </button>
              <button
                id="create_button"
                type="submit"
                class="btn btn-sm btn-outline-primary"
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
      hours: "",
      minutes: "",
      start: "",
      end: "",
      type: "",
      password: "",
      meeting_detail: [],
    };
  },
  props: ["user_id", "infoSelected"],

  methods: {
    reset() {
      this.title = "";
      this.description = "";
      this.start_time = "";
      (this.hours = ""), (this.minutes = ""), (this.start = "");
      this.end = "";
      this.type = "";
      this.password = "";
      this.meeting_detail = [];
    },
    changed() {
      if (this.hours === 24) {
        this.minutes = 0;
        $("#minutes-0").prop("disabled", true);
        $("#minutes_0").prop("disabled", false);
      } else if (this.hours === 0) {
        $("#minutes-0").prop("disabled", false);
        $("#minutes_0").prop("disabled", true);
        this.minutes = 1;
      } else {
        $("#minutes-0").prop("disabled", false);
        $("#minutes_0").prop("disabled", false);
      }
    },
    togglePassword() {
      var x = document.getElementById("password-0");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    },
    create() {
      //   if (this.type == "dayGridMonth") {
      //     this.start += "T" + this.start_time;
      //     this.end += "T" + this.end_time;
      //   } else {
      //     return;
      //   }
      const Toast = this.$swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", this.$swal.stopTimer);
          toast.addEventListener("mouseleave", this.$swal.resumeTimer);
        },
      });
      $("#create_button")
        .html(
          '<span id="span_create" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...'
        )
        .attr("disabled", true);
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
        .then((response) => {
          this.$emit("evnetCreated", response),
            (this.meeting_detail = [
              response.data.meeting.host_email +
                " is inviting you to a scheduled Zoom meeting.",
              "topic: " + response.data.meeting.topic + ".",
              "Time: " + response.data.meeting.start_time + ".",
              "Join Zoom Meeting .",
              response.data.meeting.join_url + " .",
              "Passcode :" + response.data.meeting.password,
            ]),
            this.$swal({
              title: "meeting created",
              text: this.meeting_detail.join("\n\n"),
              confirmButtonText: "Copy invitation",
              icon: "success",
              preConfirm: function () {
                return new Promise(function (resolve) {
                  if (true) {
                    var el = document.getElementById("swal2-content")
                      .textContent;
                    resolve([
                      navigator.clipboard.writeText(el).then(
                        function () {
                          console.log(
                            "Async: Copying to clipboard was successful!"
                          );
                          Toast.fire({
                            icon: "success",
                            title: "Copied",
                          });
                        },
                        function (err) {
                          console.error("Async: Could not copy text: ", err);
                        }
                      ),
                    ]);
                  }
                });
              },
            });
        })
        .catch((error) => {
          Toast.fire({
            icon: "error",
            title: "Something went wrong!",
          }),
            console.log(error);
        })
        .finally(() => {
          this.reset(),
            $("#span_create").remove(),
            $("#create_button").html("create").attr("disabled", false),
            $("#createEvent").modal("hide");
        });
    },
  },
  watch: {
    infoSelected: function (newValue) {
      this.start = newValue.startStr;
      //   this.end = newValue.startStr;
      this.type = newValue.view.type;
    },
  },
};
</script>

<style scoped>
.error_field {
  color: darkred;
}
</style>
