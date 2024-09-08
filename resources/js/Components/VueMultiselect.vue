<template>
    <div>
      <VueMultiselect
        v-model="selected"
        :options="options">
      </VueMultiselect>
    </div>
  </template>

  <script>
  import VueMultiselect from 'vue-multiselect';

  export default {
    components: { VueMultiselect },
    data () {
      return {
        selected: null,
        options: [1,2,3],
      }
    },



  }
  </script>

  <style src="vue-multiselect/dist/vue-multiselect.css"></style>
