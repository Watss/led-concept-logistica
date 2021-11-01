<template>
  <div>
    <v-data-table :headers="headers" :items="products" hide-default-footer>
      <template v-slot:no-data>
        <p>No hay productos seleccionados.</p>
      </template>
      <template v-slot:item.img="props">
        <div class="m-1">
          <div v-if="props.item.img">
            <img
              width="50"
              height="50"
              :src="'/'+props.item.img"
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

      <template v-slot:item.price="props">
        {{ formatPrice(props.item.price) }}
      </template>
      <template v-slot:item.total="props">
        {{ formatPrice(props.item.total) }}
      </template>
      <template v-slot:item.amount="props">
        <v-edit-dialog
          :return-value.sync="props.item.amount"
          large
          persistent
          cancel-text="Cerrar"
          save-text="Guardar"
          @save="save('amount')"
          @cancel="cancel"
          @open="open"
          @close="close"
        >
          <div>{{ props.item.amount }}</div>
          <template v-slot:input>
            <div class="mt-4 text-h6">Modificar cantidad</div>
            <v-text-field
              v-model="props.item.amount"
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
          cancel-text="Cerrar"
          save-text="Guardar"
          :return-value.sync="props.item.desc"
          large
          persistent
          @save="save('desc')"
          @cancel="cancel"
          @open="open"
          @close="close"
        >
          <div>{{ props.item.desc }}</div>
          <template v-slot:input>
            <div class="mt-4 text-h6">Modificar Descuento</div>
            <v-text-field
              :rules="[max90chars]"
              type="number"
              v-model="props.item.desc"
              label="Editar"
              single-line
              counter
              autofocus
            ></v-text-field>
          </template>
        </v-edit-dialog>
      </template>
      <template v-slot:item.actions="{ item, index }">
        <button
          type="button"
          class="btn btn-light btn-sm"
          style="border-radius: 20px"
          @click="deleteItem(item, index)"
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
          <div class="mr-5">Neto</div>
          <div>{{ this.formatPrice(totals.neto) }}</div>
        </div>
        <div class="d-flex justify-content-between">
          <div class="mr-5">IVA</div>
          <div>{{ this.formatPrice(totals.iva) }}</div>
        </div>
         <div class="d-flex justify-content-between">
          <div class="mr-5">Descuento</div>
          <div>-{{ this.formatPrice(totals.desc) }}</div>
        </div>
        <br class="" />
        <div class="d-flex justify-content-between">
          <div class="mr-5 font-weight-bold h4">Total</div>
          <div class="h4 fw-bold">{{ this.formatPrice(totals.total) }}</div>
        </div>
      </div>
    </div>

    <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
      {{ snackText }}

      <template v-slot:action="{ attrs }">
        <v-btn v-bind="attrs" text @click="snack = false"> Cerrar </v-btn>
      </template>
    </v-snackbar>
  </div>
</template>
<script>
export default {
  props: ["products", "totals"],
  data: () => ({
    clients: [],
    value: null,
    snack: false,
    snackColor: "",
    snackText: "",
    pagination: {},
    headers: [
      {
        text: "Imagen",
        align: "start",
        sortable: false,
        value: "img",
      },
      { text: "Descripción", value: "name", width: "27em" },
      { text: "Cantidad", value: "amount" },
      { text: "Pre. Uni.", value: "price" },
      { text: "Desc.", value: "desc" },
      { text: "Total", value: "total" },
      { text: "..", value: "actions" },
    ],
  }),

  methods: {
    max90chars: (v) => {
      return v > 90 ? "Excede el máximo" : true;
    },
    formatPrice(value) {
      var formatter = new Intl.NumberFormat("en-CL", {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 0
      });
      return formatter.format(value);
    },
    save(type) {
      this.snack = true;
      this.snackColor = "success";
      this.snackText = "Datos cambiados";
      this.$emit("change", this.products);
    },
    cancel() {
      this.snack = true;
      this.snackColor = "error";
      this.snackText = "Cancelado";
    },
    open() {},
    close() {
      console.log("Cambio cancelado");
    },
    deleteItem(item, index) {
      this.$emit("delete", [item, index]);
      this.editedIndex = this.products.indexOf(item);
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
  width: 50px;
  height: 50px;
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
