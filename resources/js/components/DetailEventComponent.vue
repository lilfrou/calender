<template>
  <div
    class="modal fade"
    id="detailEvent"
    tabindex="-1"
    role="dialog"
    aria-labelledby="create"
    aria-hidden="true"
  >
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="block block-themed block-transparent mb-0">
          <div class="block-header bg-primary-dark">
            <h3 class="block-title">detail_event</h3>

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
          <form v-on:submit.prevent="update">
            <div class="block-content font-size-sm">
              <div class="form-group">
                <label>title</label>
                <input
                  type="text"
                  name="title"
                  class="form-control"
                  v-model="event.title"
                  required
                />
              </div>
               <div class="form-group">
                <label for="description-1">description</label>
                <textarea
                  class="form-control"
                  id="description-1"
                  rows="3"
                  v-model="event.description"
                  required
                ></textarea>
              </div>
              <div class="form-group">
                <label>start</label>
                <input
                  type="time"
                  name="start_time"
                  id="start_time_event"
                  v-model="start"
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
                      id="minutes-0-0"
                    >
                      <option
                        v-for="(n, minute) in 60"
                        :key="minute"
                        :value="minute"
                        :id="'minutes_0_' + minute"
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
              <div class="form-group">
                <label>join Url</label>
                <textarea
                  :value="event.join_url"
                  class="form-control"
                  name="join_url"
                  rows="4"
                  cols="50"
                  readonly
                >
                </textarea>
              </div>
            </div>
            <div class="block-content block-content-full text-right border-top">
              <button
                type="button"
                class="btn btn-sm btn-outline-secondary"
                data-dismiss="modal"
              >
                close
              </button>
              <button
                id="delete_button"
                type="button"
                class="btn btn-sm btn-outline-danger"
                @click="destroy"
              >
                delete
              </button>
              <button
                id="detail_button"
                type="submit"
                class="btn btn-sm btn-outline-primary"
              >
                update
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
      event: {},
      start: "",
      end: "",
      hours: "",
      minutes: "",
    };
  },
  props: ["user_id", "EventId"],
  methods: {
    changed() {
      if (this.hours === 24) {
        this.minutes = 0;
        $("#minutes-0-0").prop("disabled", true);
        $("#minutes_0_0").prop("disabled", false);
      } else if (this.hours === 0) {
        $("#minutes_0_0").prop("disabled", true);
        $("#minutes-0-0").prop("disabled", false);
        this.minutes = 1;
      } else {
        $("#minutes-0-0").prop("disabled", false);
        $("#minutes_0_0").prop("disabled", false);
      }
    },
    destroy() {
      $("#delete_button")
        .html(
          '<span id="span_delete" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...'
        )
        .attr("disabled", true);
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
      axios

        .post("api/event/destroy", {
          event_id: this.EventId,
          user_id: this.user_id,
        })
        .then(
          (response) => {this.$emit("eventDeleted", response),  Toast.fire({
            icon: "success",
            title: "meeting deleted!",
          })},
        )
        .catch((error) => {
          Toast.fire({
            icon: "error",
            title: "Something went wrong!",
          }),
            console.log(error)

        }).finally(() => {
         $("#span_delete").remove();
          $("#delete_button").html("delete").attr("disabled", false);
           $("#detailEvent").modal("hide")
        });
    },
    getEvent() {
      axios
        .get(`api/event/getEvent/${this.EventId}`)
        .then((response) => (this.event = response.data))
        .catch((error) => console.log(error));
    },
    togglePassword() {
      var x = document.getElementById("password-1");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    },
    update() {
      $("#detail_button")
        .html(
          '<span id="span_detail" class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...'
        )
        .attr("disabled", true);
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
      this.start = this.event.start.split(" ", 1)[0] + "T" + this.start;
      //   this.end = this.event.end.split(" ", 1)[0] + "T" + this.end;

      axios
        .post("api/event/update", {
          id: this.EventId,
          //   user_id: this.event.user_id,
          user_id: this.user_id,
          start: this.start,
          duration: this.hours * 60 + this.minutes,
          title: this.event.title,
          description: this.event.description,
          password: this.event.password,
        })
        .then((response) => {this.$emit("eventUpdate", response), Toast.fire({
                  icon: "success",
                  title: "meeting updated!",
                })})
        .catch((error) => {
          Toast.fire({
            icon: "error",
            title: "Something went wrong!",
          }),
            console.log(error)

        }).finally(() => {
         $("#span_detail").remove();
          $("#detail_button").html("update").attr("disabled", false);
           $("#detailEvent").modal("hide")
        });
    },
  },
  watch: {
    EventId: function (newValue) {
      if (newValue != 0) {
        this.getEvent();
      }
    },
    event: function (newValue) {
      this.start = newValue.start.split(" ")[1];
      this.hours = parseInt(newValue.duration / 60);
      this.minutes = parseInt(newValue.duration % 60);
      this.changed();
    },
  },
};
</script>

