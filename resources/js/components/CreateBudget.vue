<template>
  <div class="container pt-0">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 p-0">
        <div class="card p-3">
          <div class="card-body container">
            <div class="row">
              <div class="col"><h2>Cotización #223</h2></div>
              <div class="col d-flex justify-content-end">
                <actions-budget></actions-budget>
              </div>
            </div>
            <!-- <div class="row">
              <v-col cols="12" class="pb-0">
                <v-autocomplete
                  v-model="values"
                  :items="clients"
                  outlined
                  dense
                  label="Selección de Cliente"
                ></v-autocomplete>
              </v-col>
            </div> -->
            <!-- <div class="row">
              <div class="col text-center p-4">
                No hay producto seleccionados.
              </div>
            </div> -->
            <div class="row">
              <div class="col">
                <v-autocomplete
                  v-model="value"
                  :items="products"
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
              />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
               

<script>
import ActionsBudget from "./ActionsBudget.vue";
import ListProducts from "./ListProducts.vue";
export default {
  components: { ActionsBudget, ListProducts },
  props: ["products"],
  data: () => ({
    products: [],
    clients: [],
    value: null,
    productsSelected: [],
    totals: {
      partial: 0,
      desc: 0,
      total: 0,
    },
  }),
  mounted() {
    console.log("load products.");
    this.fetchProducts().then((products) => {
      this.products = products;
    });
    console.log("load clients.");
    this.fetchClients((clients) => {
      this.clients = clients;
    });
  },
  watch: {
    value: function name(val) {
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
        },
      ];
      this.totals = this.setTotals(this.productsSelected);
    },
  },
  methods: {
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
        partial: null,
        desc: arr.reduce((sum, value) => sum + value.desc, 0),
        total: arr.reduce((sum, value) => sum + value.price, 0),
      };
    },
  },
};
</script>


