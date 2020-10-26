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
                <p class="error_field" v-if="msg.includes('title')">
                  Title is required
                </p>
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
                <p class="error_field" v-if="msg.includes('description')">
                  Description is required
                </p>
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
                <p class="error_field" v-if="msg.includes('start_time')">
                  Start_time is required
                </p>
              </div>
              <div class="row">
                <div class="col-6">
                  <div class="form-group">
                    <label>hours</label>

                    <select class="form-control" v-model="hours" required v-on:change="changed">
                      <option selected disabled>Select</option>
                      <option v-for="(n, hour) in 25" :key="hour" :value="hour">
                        <p v-if="hour === 0 || hour === 1">{{ hour }} hour</p>
                        <p v-else>{{ hour }} hours</p>
                      </option>
                    </select>
                    <p class="error_field" v-if="msg.includes('hours')">
                      required
                    </p>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label>minutes</label>

                    <select class="form-control" v-model="minutes" required id="minutes-0">
                      <option selected disabled>Select</option>
                      <option
                        v-for="(n, minute) in 60"
                        :key="minute"
                        :value="minute"
                        :id="'minutes_'+minute"
                      >
                        <p v-if="minute === 0 || minute === 1" >
                          {{ minute }} minute
                        </p>
                        <p v-else>{{ minute }} minutes</p>
                      </option>
                    </select>
                    <p class="error_field" v-if="msg.includes('minutes')">
                      required
                    </p>
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
                <p class="error_field" v-if="msg.includes('password')">
                  Password is required
                </p>
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
                type="button"
                class="btn btn-sm btn-outline-primary"
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
      hours: "Select",
      minutes: "Select",
      start: "",
      end: "",
      type: "",
      password: "",
      msg: [],
      validate: true
    };
  },
  props: ["user_id", "infoSelected"],

  methods: {
    reset() {
      this.title = "";
      this.description = "";
      this.start_time = "";
      (this.hours = "Select"), (this.minutes = "Select"), (this.start = "");
      this.end = "";
      this.type = "";
      this.password = "";
      this.msg=[];
      this.validate=false;
    },
    changed(){
        if(this.hours===24){
            this.minutes=0;
            $( "#minutes-0" ).prop( "disabled", true );
            $( "#minutes_0" ).prop( "disabled", false );

        }else if(this.hours===0){
             $( "#minutes-0" ).prop( "disabled", false );
             $( "#minutes_0" ).prop( "disabled", true );
              this.minutes=1;
        }else{
         $( "#minutes-0" ).prop( "disabled", false );
         $( "#minutes_0" ).prop( "disabled", false );
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
    validateText() {
      if (this.msg.includes("title")) {
        this.msg.splice(this.msg.indexOf("title"), 1);
      }
      if (this.title == "") {
        this.msg.push("title");

        return false;
      }
      return true;
    },
    validateDescription() {
      if (this.msg.includes("description")) {
        this.msg.splice(this.msg.indexOf("description"), 1);
      }
      if (this.description == "") {
        this.msg.push("description");

        return false;
      }
      return true;
    },
    validateStart_time() {
      if (this.msg.includes("start_time")) {
        this.msg.splice(this.msg.indexOf("start_time"), 1);
      }
      if (this.start_time == "") {
        this.msg.push("start_time");

        return false;
      }
      return true;
    },

    validateHours() {
      if (this.msg.includes("hours")) {
        this.msg.splice(this.msg.indexOf("hours"), 1);
      }
      if (this.hours == "Select") {
        this.msg.push("hours");

        return false;
      }
      return true;
    },
     validateMinutes() {
      if (this.msg.includes("minutes")) {
        this.msg.splice(this.msg.indexOf("minutes"), 1);
      }
      if (this.minutes == "Select") {
        this.msg.push("minutes");
        return false;
      }
      return true;
    },
     validatePassword() {
      if (this.msg.includes("password")) {
        this.msg.splice(this.msg.indexOf("password"), 1);
      }
      if (this.password == "") {
        this.msg.push("password");
        return false;
      }
      return true;
    },
    checkValidation() {
      var validateText = this.validateText();
      var validateDescription = this.validateDescription();
      var validateStart_time = this.validateStart_time();
      var validateHours = this.validateHours();
      var validateMinutes = this.validateMinutes();
      var validatePassword =this.validatePassword();

      if (
        validateText === false ||
        validateDescription === false ||
        validateStart_time === false ||
        validateHours === false ||
        validateMinutes === false ||
        validatePassword ===false
      ) {
        return false;
      }
      return true;
    },

    create() {
      //   if (this.type == "dayGridMonth") {
      //     this.start += "T" + this.start_time;
      //     this.end += "T" + this.end_time;
      //   } else {
      //     return;
      //   }
      var checkValidation = this.checkValidation();
      if (checkValidation === false) return;
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
        .then(
          (response) => (
            this.$emit("evnetCreated", response), console.log(response.data)
          )
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
    title: function (newValue) {
      if (newValue == "" && this.validate) {
        this.msg.push("title");
      } else if (this.msg.includes("title")) {
        this.msg.splice(this.msg.indexOf("title"), 1);
      }
    },
    description: function (newValue) {
      if (newValue == "" && this.validate) {
        this.msg.push("description");
      } else if (this.msg.includes("description")) {
        this.msg.splice(this.msg.indexOf("description"), 1);
      }
    },
    start_time: function (newValue) {
      if (newValue == "" && this.validate) {
        this.msg.push("start_time");
      } else if (this.msg.includes("start_time")) {
        this.msg.splice(this.msg.indexOf("start_time"), 1);
      }
    },
    hours: function (newValue) {
      if (newValue == "Select" && this.validate) {
        this.msg.push("hours");
      } else if (this.msg.includes("hours")) {
        this.msg.splice(this.msg.indexOf("hours"), 1);
      }
    },
    minutes: function (newValue) {
      if (newValue == "Select" && this.validate) {
        this.msg.push("minutes");
      } else if (this.msg.includes("minutes")) {
        this.msg.splice(this.msg.indexOf("minutes"), 1);
      }
    },
    password: function (newValue) {
      if (newValue == "" && this.validate) {
        this.msg.push("password");
      } else if (this.msg.includes("password")) {
        this.msg.splice(this.msg.indexOf("password"), 1);
      }
    },
  },
};
</script>

<style scoped>
.error_field {
  color: darkred;
}
</style>
