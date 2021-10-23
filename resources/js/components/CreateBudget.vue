<template>
  <div class="container pt-0">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-12 p-0">
        <div class="card p-3">
          <div class="card-body container">
            <div class="row">
              <div class="col">
                <h2>Cotización #{{ id }}</h2>
                <div class="text-muted">Actualizado {{ moment.fromNow() }}</div>
              </div>
              <div class="col d-flex justify-content-end">
                <actions-budget
                  v-on:save="handleSaveBudget"
                  v-on:copy="handleCopyBudget"
                  :saveDisabled="!client"
                ></actions-budget>
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
                  item-value="id"
                >
                </v-autocomplete>
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
                  :disabled="!client"
                >
                  <template slot="item" slot-scope="data">
                    <div class="m-1 mr-5">
                      <div v-if="data.item.image">
                        <img
                          width="50"
                          height="50"
                          :src="'/' + data.item.image"
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
                    <div style="margin-left: 15px">
                      <div>{{ data.item.name }}</div>
                      <div>${{ formatPrice(data.item.price) }}</div>
                    </div>
                  </template>
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
        <button class="btn btn-sm btn-outline-danger" @click="dialog = true">
          Eliminar cotización
        </button>
      </div>
    </div>
    <modal-client
      :show="showModalCreateClient"
      v-on:close="showModalCreateClient = false"
      v-on:saved="handlesCreateClient"
    />
    <v-snackbar v-model="snackbar.visible">
      {{ snackbar.text }}

      <template v-slot:action="{ attrs }">
        <v-btn
          color="pink"
          text
          v-bind="attrs"
          @click="snackbar.visible = false"
        >
          Close
        </v-btn>
      </template>
    </v-snackbar>
    <v-dialog v-model="dialog" max-width="290">
      <v-card>
        <v-card-title class="text-h5"> ¿Estás seguro? </v-card-title>

        <v-card-text>
          Esta acción no se puede deshacer. Esto eliminará permanentemente la
          cotización.
        </v-card-text>
        <v-card-text>
          <v-text-field filled dense v-model="confirm_delete"></v-text-field>
          Escriba {{ id }} para confirmar.
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="green darken-1" text @click="dialog = false">
            Cancelar
          </v-btn>

          <v-btn
            color="green darken-1"
            text
            @click="deleteBudget"
            :disabled="confirm_delete == id ? false : true"
          >
            Aceptar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>


<script>
import ActionsBudget from "./ActionsBudget.vue";
import ListProducts from "./ListProducts.vue";
import ModalClient from "./modalClient.vue";
import moment from "moment";
export default {
  props: ["id", "budgets_detail"],
  components: { ActionsBudget, ListProducts, ModalClient },
  data: () => ({
    snackbar: {
      visible: false,
      text: ``,
    },
    dialog: false,
    moment: moment(),
    budget: {},
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
    confirm_delete: null,
  }),
  mounted() {
    this.moment.locale("es");
    this.moment = moment(this.budgets_detail.updated_at);
    this.fetchProducts().then((products) => {
      console.log("load products.");
      this.products = products;
    });

    this.fetchClients().then((clients) => {
      console.log("load clients.");
      this.clients = clients;
    });

    this.fetchBudget().then((budget) => {
      console.log("load budget.");
      console.log(budget);

      this.moment = moment(budget.updated_at);
      this.moment.locale("es");
      this.budget = budget;
      this.productsSelected = budget.products.map((el) => ({
        id: el.product.id,
        img: el.product.image,
        sku: el.product.sku,
        amount: el.quantity ? el.quantity : 1,
        description: el.product.name,
        price: el.product_price,
        desc: 0,
        total: el.product_price * 1,
        actions: "1%",
        name: el.product.name,
        total_desc: 0,
      }));

      this.client = budget.client;

      this.totals = this.setTotals(this.productsSelected);


    });
  },
  watch: {
    product: function name(val) {
      this.productsSelected = [
        ...this.productsSelected,
        this.normalizeDatatable(val),
      ];

      this.totals = this.setTotals(this.productsSelected);
      this.product = null

      this.updateBudget().then((res) => {
        console.log("product added");
      });

      this.fetchBudget().then((res) => {
        console.log("products loaded");
      });
      
      
    },
  },
  methods: {
    handlesCreateClient() {
      this.snackbar.visible = true;
      this.snackbar.text = "Cliente guardado con éxito";
      this.fetchClients().then((clients) => {
        console.log("load clients.");
        this.clients = clients;
      });
    },
    async handleSaveBudget() {
      try {
        const updated = await this.updateBudget();

        await this.fetchBudget();

        this.snackbar.visible = true;
        this.snackbar.text = "Cotización guardada con éxito.";
      } catch (err) {
        console.log(err);
      }
    },
    handleDeleteListProducts(payload) {
      if (confirm("¿Esta seguro que desea eliminar este producto?")) {
        axios
          .delete("/api/budget/products/" + payload[0].id)
          .then((res) => {
            console.log(res);
            this.productsSelected = this.productsSelected.filter(
              (element, index) => index !== payload[1]
            );
            this.totals = this.setTotals(this.productsSelected);

            this.snackbar.text = "Producto eliminado con èxito.";
            this.snackbar.visible = true;
            console.log("item deleted.");
          })
          .catch((err) => {
            console.log("error item delete", err);
          });
      }
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
    async updateBudget() {
      try {
        const res = await axios.put(`/api/budgets/${this.id}`, {
          client_id: this.client.id,
          reference: "fd",
          user_id: 2,
          products: this.productsSelected.map((el) => ({
            product_id: el.id,
            product_price: el.price,
            product_sku: el.sku,
            quantity: el.amount,
            total: el.total,
          })),
          neto: this.totals.neto,
          total: this.totals.total,
        });
        return res;
      } catch (error) {
        console.log(error);
        console.log("failed update budget.");
      }
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
        console.log(res);
        return res.data.products;
      } catch (error) {
        console.log("failed load products.");
      }
    },
    async fetchBudget() {
      try {
        const res = await axios.get("/api/budget_get/" + this.id);
        return res.data.budget;
      } catch (error) {
        console.log("failed load budget.");
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
    normalizeDatatable(val) {
      return {
        id: val.id,
        img: val.image,
        sku: val.sku,
        amount: val.amount ? val.amount : 1,
        description: val.description,
        price: val.price,
        desc: 0,
        total: val.price * 1,
        actions: "1%",
        name: val.name,
        total_desc: 0,
      };
    },
    formatPrice(value) {
      var formatter = new Intl.NumberFormat("en-CL", {
        currency: "CLP",
        minimumFractionDigits: 0,
      });
      return formatter.format(value);
    },
    deleteBudget() {
      axios
        .delete("/api/budgets/" + this.id)
        .then((res) => {
          window.location.href = "../";
          console.log("budget deleted.");
        })
        .catch((err) => {
          console.log(err, "error delete budget");
        });
    },
    handleCopyBudget() {
      if (confirm("¿Desea duplicar esta cotización?")) {
        axios
          .get("/api/budget/copy/" + this.id)
          .then((res) => {
            console.log(res);
            console.log("budget copy.");
            setTimeout(() => {
              this.snackbar.visible = true;
              this.snackbar.text = "Cotización duplicada.";
              window.location.href = "../";
            }, 2000);
          })
          .catch((err) => {
            console.log(err, "error copy budget");
          });
      }
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
</style>


