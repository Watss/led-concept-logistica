<template>
<div>
<div class="col d-flex justify-content-end">
    <button
      type="button"
      class="btn btn-light m-1"
      style="border-radius: 20px"
      :disabled="saveDisabled || !(enablePrint)"
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
  <div class="col  justify-content-end p-3 bg-light">
    <label for="" class="pb-2 text-bold">Cambiar Estado</label>
    <select name="" id="" class="form-control">
        <option :value="status.id" v-for=" status in statuses " v-bind:key="status.id" :selected="statusId === status.id">{{status.name}}</option>
    </select>
  </div>
</div>

</template>

<script>
export default {
  props: ["saveDisabled", "enablePrint", "statuses", "statusId"],
};
</script>
