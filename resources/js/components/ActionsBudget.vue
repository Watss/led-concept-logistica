<template>
  <div class="col d-flex justify-content-end">
    <button
      type="button"
      class="btn btn-light m-1"
      style="border-radius: 20px"
      :disabled="saveDisabled"
    >
      Imprimir
    </button>
    <button
      type="button"
      class="btn btn-light m-1"
      style="border-radius: 20px"
      :disabled="saveDisabled"
      @click="$emit('copy')"
    >
      Duplicar
    </button>
    <button
      @click="$emit('save')"
      type="button"
      class="btn btn-primary m-1 text-white"
      style="border-radius: 20px"
      :disabled="saveDisabled"
    >
      Guardar
    </button>
  </div>
</template>

<script>
export default {
  props: ["saveDisabled"],
};
</script>
