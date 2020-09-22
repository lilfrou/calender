<template>
<div class="modal fade" id="filterEvent" tabindex="-1" role="dialog" aria-labelledby="create" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">

                    <h3 class="block-title">filter_event</h3>

                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <form>
                    <div class="block-content font-size-sm">

                         <div class="form-group">
                            <label>USER_LIST</label>
                            <select name="user_id" id="user_id" class="form-control" required>
                                <option value="" selected disabled>please_select</option>
                                <option v-for="user in users" :key="user.id" :value="user.id">
                                    <p v-if="user.auth=='admin'">all</p>
                                    <p v-else>{{user.name}}</p>
                                    </option>
                            </select>
                        </div>

                    </div>
                    <div class="block-content block-content-full text-right border-top">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">close</button>
                        <button type="button" class="btn btn-primary" @click="filter">filter</button>
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
        users:{},
        selectedUSer:''
    };
  },
  mounted() {
    console.log("Component mounted.");
     axios
        .get('api/event/getUsers')
        .then((response) => this.users=response.data)
        .catch((error) => console.log(error));

  },
  methods:{
      filter(){
          var user_id=document.getElementById('user_id').value;
          this.selectedUSer= user_id;
           axios
        .get(`api/event/index/${this.selectedUSer}`)
        .then((response) =>  this.$emit("eventFiltred",response),$("#filterEvent").modal("hide"))
        .catch((error) => console.log(error));

      }


  }
};
</script>

