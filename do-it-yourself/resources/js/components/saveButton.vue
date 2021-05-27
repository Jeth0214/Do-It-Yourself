<template>
  <button
    class="btn btn-primary btn-sm"
    @click="saveIdea"
    v-text="buttonText"
  ></button>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },

  props: ["ideaId", "saves"],
  data: function () {
    return {
      status: this.saves,
    };
  },
  methods: {
    saveIdea() {
      //console.log("Saved");
      axios.post(`/saves/${this.ideaId}`).then(
        (response) => {
          this.status = !this.status;
          console.log(response.data);
          // console.log(this.ideaId);
        },
        (error) => {
          //console.log("Error: ", error);
          if (error.status == 401) {
            window.location = "/login";
          }
        }
      );
    },
  },
  computed: {
    buttonText() {
      return this.status ? "Unsaved" : "Saved";
    },
  },
};
</script>
