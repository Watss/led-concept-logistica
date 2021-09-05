<template>
  <div>
    <div class="mb-3">
      <input
        @click="selected = false"
        v-if="selected"
        type={{}}
        class="form-control"
        id="exampleFormControlInput1"
        placeholder="placeholder"
      />
      <div v-else @click="selected = true">fsd</div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["type","names","placeholder"],
  data() {
    return {
      name: "",
      selected : false
    };
  },
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
