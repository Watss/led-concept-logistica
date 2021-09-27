<template>
  <div class="container pt-0">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 p-0">
        <div class="card p-3">
          <div class="card-body container">
            <div class="row">
              <div class="col">
                <h2>Cotización #223</h2>
                <div class="text-muted">Actualizado hace 5 min(dummy)</div>
              </div>
              <div class="col d-flex justify-content-end">
                <actions-budget></actions-budget>
              </div>
            </div>
            <div class="row">
              <v-col cols="12" class="pb-0">
                <v-autocomplete
                  v-model="client"
                  :items="clients"
                  solo
                  dense
                  label="Selección de Cliente"
                  class="form-control"
                  return-object
                  item-text="name"
                ></v-autocomplete>
                <a
                  role="button"
                  href="#"
                  class="text-primary"
                  @click="showModalCreateClient = true"
                  >Crear cliente</a
                >
                <br />
              </v-col>
            </div>
            <!-- <div class="row">
              <div class="col text-center p-4">
                No hay producto seleccionados.
              </div>
            </div> -->
            <div class="row">
              <div class="col">
                <v-autocomplete
                  v-model="product"
                  :items="products"
                  class="form-control"
                  solo
                  dense
                  item-text="name"
                  label="Buscador de producto"
                  return-object
                >
                  <!-- <template v-slot:item="{ parent, item }">
                    <v-list-tile-content>

                      <v-list-tile-title
                        v-html="`${parent.genFilteredText(item.name)}`"
                      ></v-list-tile-title>
                    </v-list-tile-content>
                  </template> -->
                </v-autocomplete>
              </div>
              <list-products
                v-bind:products="productsSelected"
                :totals="totals"
                v-on:change="handleChangeListProducts"
                v-on:delete="handleDeleteListProducts"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <modal-client
      :show="showModalCreateClient"
      v-on:close="showModalCreateClient = false"
    />
  </div>
</template>


<script>
import ActionsBudget from "./ActionsBudget.vue";
import ListProducts from "./ListProducts.vue";
import ModalClient from "./modalClient.vue";
export default {
  components: { ActionsBudget, ListProducts, ModalClient },
  data: () => ({
    showModalCreateClient: false,
    products: [],
    clients: [],
    client: {},
    product: null,
    productsSelected: [],
    totals: {
      partial: 0,
      desc: 0,
      total: 0,
      neto: 0,
    },
  }),
  mounted() {
    this.fetchProducts().then((products) => {
      console.log("load products.");
      this.products = products;
    });

    this.fetchClients().then((clients) => {
      console.log("load clients.");
      console.log(clients);
      this.clients = clients;
    });
  },
  watch: {
    product: function name(val) {
      this.productsSelected = [
        ...this.productsSelected,
        {
          img: val.image,
          amount: 1,
          description: val.description,
          price: val.price,
          desc: 0,
          total: val.price * 1,
          actions: "1%",
          name: val.name,
          total_desc: 0,
        },
      ];
      this.totals = this.setTotals(this.productsSelected);
    },
  },
  methods: {
    handleDeleteListProducts(payload) {
 
      this.productsSelected = this.productsSelected.filter((element, index) => index !== payload[1]);
      this.totals = this.setTotals(this.productsSelected);
      console.log("item deleted.");
    },
    handleChangeListProducts(arr, payload) {
      this.productsSelected = arr.map((el) => ({
        ...el,
        total: el.price * el.amount - el.total * (el.desc / 100),
        total_desc: el.total * (el.desc / 100),
      }));

      this.totals = this.setTotals(this.productsSelected);
      console.log("list amount or desc changend");
    },
    async fetchClients() {
      try {
        const res = await axios.get("/api/clients/search");
        return res.data.clients;
      } catch (error) {
        console.log("failed load clients.");
      }
    },
    async fetchProducts() {
      try {
        const res = await axios.get("/api/products/search");
        return res.data.products;
      } catch (error) {
        console.log("failed load products.");
      }
    },
    setTotals(arr) {
      return {
        partial: arr.reduce((sum, value) => sum + value.price, 0),
        desc: arr.reduce((sum, value) => sum + value.total_desc, 0),
        neto: arr.reduce((sum, value) => sum + value.total, 0),
        total: arr.reduce((sum, value) => sum + value.total, 0),
      };
    },
  },
};
</script>

<style >
.v-text-field.v-text-field--solo:not(.v-text-field--solo-flat)
  > .v-input__control
  > .v-input__slot {
  box-shadow: none;
  font-size: 14px;
}
.v-text-field.v-text-field--enclosed .v-text-field__details {
  display: none;
}
</style>


