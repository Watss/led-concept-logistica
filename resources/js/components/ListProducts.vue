<template>
  <div>
    <v-data-table :headers="headers" :items="products" hide-default-footer>
      <template v-slot:item.img="props">
        <div class="m-1">
          <div v-if="props.item.img">
            <img
              width="60"
              height="60"
              :src="'../' + props.item.img"
              alt=""
              style="border-radius: 5px"
            />
          </div>
          <div v-else>
            <div class="bg-secondary no-image">
              <div class="text-no-imagen">
                <div>Sin Imagen</div>
              </div>
            </div>
          </div>
        </div>
      </template>

      <template v-slot:item.name="props">
        <v-edit-dialog
          :return-value.sync="props.item.name"
          @save="save"
          @cancel="cancel"
          @open="open"
          @close="close"
        >
          {{ props.item.name }}
          <template v-slot:input>
            <v-text-field
              v-model="props.item.name"
              :rules="[max25chars]"
              label="Edit"
              single-line
              counter
            ></v-text-field>
          </template>
        </v-edit-dialog>
      </template>

      <template v-slot:item.amount="props">
        <v-edit-dialog
          :return-value.sync="props.item.amount"
          large
          persistent
          @save="save"
          @cancel="cancel"
          @open="open"
          @close="close"
        >
          <div>{{ props.item.amount }}</div>
          <template v-slot:input>
            <div class="mt-4 text-h6">Modificar cantidad</div>
            <v-text-field
              v-model="props.item.amount"
              :rules="[max25chars]"
              label="Edit"
              single-line
              counter
              autofocus
            ></v-text-field>
          </template>
        </v-edit-dialog>
      </template>
      <template v-slot:item.desc="props">
        <v-edit-dialog
          :return-value.sync="props.item.desc"
          large
          persistent
          @save="save"
          @cancel="cancel"
          @open="open"
          @close="close"
        >
          <div>{{ props.item.desc }}</div>
          <template v-slot:input>
            <div class="mt-4 text-h6">Modificar Descuento</div>
            <v-text-field
              v-model="props.item.desc"
              :rules="[max25chars]"
              label="Edit"
              single-line
              counter
              autofocus
            ></v-text-field>
          </template>
        </v-edit-dialog>
      </template>
      <template v-slot:item.actions="{ item }">
        <button
          type="button"
          class="btn btn-light btn-sm"
          style="border-radius: 20px"
        >
          Eliminar
        </button>
      </template>
      <template slot="body.append">
        <div class="container"></div>
      </template>
    </v-data-table>
    <div class="container row d-flex justify-content-end">
      <div class="col-5">
        <div class="d-flex justify-content-between">
          <div class="mr-5">Parcial</div>
          <div>$3.000</div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="mr-5">Descuento</div>
          <div>$3.000</div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="mr-5">Neto</div>
          <div>$3.000</div>
        </div>
        <br class="" />
        <div class="d-flex justify-content-between">
          <div class="mr-5 font-weight-bold">Total</div>
          <div>$3.000</div>
        </div>
      </div>
    </div>

    <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
      {{ snackText }}

      <template v-slot:action="{ attrs }">
        <v-btn v-bind="attrs" text @click="snack = false"> Close </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>
<script>
export default {
  props: ["products"],
  data: () => ({
    products: [],
    clients: [],
    items: ["foo", "bar", "fizz", "buzz"],
    values: ["foo", "bar"],
    value: null,
    snack: false,
    snackColor: "",
    snackText: "",
    max25chars: (v) => v.length <= 10 || "Input too long!",
    pagination: {},
    headers: [
      {
        text: "Imagen",
        align: "start",
        sortable: false,
        value: "img",
      },
      { text: "Descripción", value: "name" },
      { text: "Cantidad", value: "amount" },
      { text: "Pre. Unitario", value: "price" },
      { text: "Desc.", value: "desc" },
      { text: "Total", value: "total" },
      { text: "Acciones", value: "actions" },
    ],
  }),
  methods: {
    save() {
      this.snack = true;
      this.snackColor = "success";
      this.snackText = "Datos Guardados";
    },
    cancel() {
      this.snack = true;
      this.snackColor = "error";
      this.snackText = "Cancelado";
    },
    open() {},
    close() {
      console.log("Dialog closed");
    },
    deleteItem(item) {
      this.editedIndex = this.desserts.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },
  },
};
</script>

<style>
.image-product {
  background: gray;
  color: white;
  text-align: center;
  height: 3em;
  width: 3em;
  border-radius: 8%;
}
.shadow-product {
  box-shadow: 0px 1px 0px -2px rgb(0 0 0 / 20%), 0px 0px 0px 0 rgb(0 0 0 / 14%),
    0 1px 5px 0 rgb(0 0 0 / 12%);
}
.v-text-field.v-text-field--solo:not(.v-text-field--solo-flat)
  > .v-input__control
  > .v-input__slot {
  box-shadow: 0px 1px 0px -2px rgb(0 0 0 / 20%), 0px 0px 0px 0 rgb(0 0 0 / 14%),
    0 1px 5px 0 rgb(0 0 0 / 12%);
}

.no-image {
  width: 60px;
  height: 60px;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 4px;
  background: #1d34486e !important;
}

.text-no-imagen {
  font-size: 9px;
  color: white;
}
</style>