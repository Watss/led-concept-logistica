<template>
<div>
<div class="col d-flex justify-content-end">
    <button
      type="button"
      class="btn btn-light m-1"
      style="border-radius: 20px"
      @click="openPrint()"
      :disabled="saveDisabled || !(enablePrint) || budget_id === undefined"
    >
      Imprimir
    </button>
    <button
      type="button"
      class="btn btn-light m-1"
      style="border-radius: 20px"
      :disabled="saveDisabled || !(enableCopy)"
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
  <div v-if="statusId" class="col  justify-content-end p-3 bg-light">
    <label for="" class="pb-2 text-bold">Cambiar Estado</label>
    <select name="" id="" class="form-control" :disabled="!is_admin && statusId===2" @change="changeStatus($event)" >
        <option :value="status.id" v-for=" status in statuses " v-bind:key="status.id" :selected="statusId === status.id" >{{status.name}}</option>
    </select>
  </div>
</div>

</template>

<script>
export default {
  props: ["saveDisabled", "enablePrint", "statuses","budget_id", "statusId",'is_admin','enableCopy'],
  methods:{

      changeStatus(event){

          this.$emit('handleChangeStatus',event.target.value)
      },
      openPrint(){
          window.open(`/print-budget/${this.budget_id}`,'_blank');
      }

  }
};


</script>
