<template>
    <div class="container pt-0">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 p-0">
                <div class="card p-3">
                    <div class="card-body container">
                        <div class="row">
                            <div class="col">
                                <h2>Cotización #{{ id ? id : "(Nueva)" }}</h2>
                                <div class="text-muted">
                                    Actualizado {{ moment.fromNow() }}
                                </div>
                            </div>
                            <div class="col d-flex justify-content-end">
                                <actions-budget
                                    :budget_id="budget.id"
                                    :statusId="budget.status"
                                    :statuses="statuses"
                                    :enablePrint="budget.status !== 2"
                                    :enableCopy="budget.status !== 2"
                                    v-on:save="handleSaveBudget"
                                    v-on:copy="handleCopyBudget"
                                    :saveDisabled="
                                        !client || productsSelected.length <= 0
                                    "
                                    :is_admin="is_admin"
                                    @handleChangeStatus="handleChangeStatus"
                                ></actions-budget>
                            </div>
                        </div>
                        <div class="row">
                            <v-col cols="6" class="pb-0">
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
                            <v-col cols="6" class="pb-0">
                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="contacto"
                                    v-model="reference"
                                    style="padding: 10px"
                                />
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
                                    ref="p_autocomplete"
                                    v-model="product"
                                    :items="productsCleanList"
                                    class="form-control"
                                    no-data-text="No hay productos para agregar"
                                    @change="reset()"
                                    solo
                                    dense
                                    item-text="name"
                                    label="Buscador de producto"
                                    return-object
                                    :disabled="
                                        !client ||
                                        (budget.status > 2 && !is_admin)
                                    "
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
                                                <div
                                                    class="bg-secondary no-image"
                                                >
                                                    <div class="text-no-imagen">
                                                        <div>Sin Imagen</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-left: 15px">
                                            <div>{{ data.item.name }}</div>
                                            <div>
                                                ${{
                                                    formatPrice(data.item.price)
                                                }}
                                            </div>
                                        </div>
                                    </template>
                                </v-autocomplete>
                                <a
                                    role="button"
                                    href="#"
                                    v-if="is_admin"
                                    class="text-primary"
                                    @click="showModalCreateProduct = true"
                                    >Crear producto</a
                                >
                                <br />
                            </div>
                            <list-products
                                :isAdmin="is_admin"
                                v-on:update-position="handleUpdateOrder"
                                :class="{
                                    'disabled-budget-style':
                                        budget.status > 2 && !is_admin,
                                }"
                                v-bind:products="productsSelected"
                                :totals="totals"
                                v-on:change="handleChangeListProducts"
                                v-on:delete="handleDeleteListProducts"
                            />
                        </div>
                    </div>
                </div>
                <!-- <button
                    class="btn btn-sm btn-outline-danger"
                    @click="dialog = true"
                >
                    Eliminar cotización
                </button> -->
            </div>
        </div>
        <modal-client
            :show="showModalCreateClient"
            v-on:close="showModalCreateClient = false"
            v-on:saved="handlesCreateClient"
        />
        <modal-product
            :show="showModalCreateProduct"
            v-on:close="showModalCreateProduct = false"
            v-on:saved="handleSaveProduct"
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
                    Esta acción no se puede deshacer. Esto eliminará
                    permanentemente la cotización.
                </v-card-text>
                <v-card-text>
                    <v-text-field
                        filled
                        dense
                        v-model="confirm_delete"
                    ></v-text-field>
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
import ModalProduct from "./modalProduct.vue";
import moment from "moment";
export default {
    props: ["id", "budgets_detail", "user", "is_admin", "statuses"],
    components: { ActionsBudget, ListProducts, ModalClient, ModalProduct },
    data: () => ({
        newId: "",
        created: false,
        updadeAt: "",
        snackbar: {
            visible: false,
            text: ``,
        },
        searchValueProduct: null,
        dialog: false,
        moment: moment(),
        budget: {},
        reference: "",
        showModalCreateClient: false,
        showModalCreateProduct: false,
        products: [],
        clients: [],
        client: null,
        product: null,
        productsSelected: [],
        finishOrderProducts: [],
        totals: {
            partial: 0,
            desc: 0,
            total: 0,
            neto: 0,
        },
        confirm_delete: null,
    }),
    mounted() {
        if (this.id) {
            this.moment.locale("es");
            this.moment = moment(
                this.budgets_detail && this.budgets_detail.updated_at
            );

            this.reference = this.budgets_detail
                ? this.budgets_detail.reference
                : "";

            this.fetchBudget().then((budget) => {
                console.log("load budget.");
                this.moment = moment(budget.updated_at);
                this.moment.locale("es");
                this.budget = budget;
                this.newId = budget.id;
                this.productsSelected = budget.products.map((el) => ({
                    id_reference: el.id,
                    id: el.product.id,
                    img: el.product.image,
                    sku: el.product.sku,
                    amount: el.quantity ? el.quantity : 1,
                    description: el.product.name,
                    price: el.product_price,
                    desc: el.discount,
                    prefix: el.prefix,
                    total: el.total,
                    actions: "--",
                    total_desc: el.discount_price,
                    name: el.product.name,
                }));

                this.client = budget.client;

                this.totals = this.setTotals(this.productsSelected);
                this.finishOrderProducts = this.productsSelected;
            });
        }

        this.fetchProducts().then((products) => {
            this.products = products;
        });

        this.reference = this.budgets_detail && this.budgets_detail.reference;

        this.fetchClients().then((clients) => {
            this.clients = clients;
        });
    },
    watch: {
        product: function name(val) {
            if (val) {
                this.productsSelected = [
                    ...this.productsSelected,
                    this.normalizeDatatable(val),
                ];

                this.totals = this.setTotals(this.productsSelected);

                this.finishOrderProducts = [
                    ...this.finishOrderProducts,
                    this.normalizeDatatable(val),
                ];
            }
        },
    },
    computed: {
        productsCleanList() {
            const clean = this.products;
            return clean;
        },
    },
    methods: {
        handleUpdateOrder(products) {
            this.finishOrderProducts = products;
        },
        reset() {
            this.$nextTick(() => {
                this.product = null;
            });
        },
        handleSaveProduct() {
            this.fetchProducts().then((products) => {
                this.products = products;
                this.snackbar.visible = true;
                this.snackbar.text = "Producto guardado !";
            });
        },
        handlesCreateClient() {
            this.snackbar.visible = true;
            this.snackbar.text = "Cliente guardado con éxito";
            this.fetchClients().then((clients) => {
                this.clients = clients;
            });
            this.fetchProducts().then((products) => {
                this.products = products;
            });
        },
        async handleSaveBudget() {
            try {
                if (this.id) {
                    const updated = await this.updateBudget();
                } else {
                    const store = await this.storeBudget();
                }

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
                    .delete("/api/budget/products/" + payload[0].id, {
                        params: { id_budget: this.budget.id },
                    })
                    .then((res) => {
                        this.finishOrderProducts =
                            this.finishOrderProducts.filter(
                                (element, index) => index !== payload[1]
                            );

                        this.productsSelected = this.finishOrderProducts;

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
            this.productsSelected = arr.map((el) => {
                console.log(el);
                const total = Math.round(el.price * el.amount);
                const discount = Math.round(
                    el.desc > 0 ? total * (el.desc / 100) : 0
                );

                return {
                    ...el,
                    total: Math.round(total - discount),
                    total_desc: Math.round(discount),
                };
            });

            this.finishOrderProducts = arr.map((el) => {
                console.log(el);
                const total = Math.round(el.price * el.amount);
                const discount = Math.round(
                    el.desc > 0 ? total * (el.desc / 100) : 0
                );

                return {
                    ...el,
                    total: Math.round(total - discount),
                    total_desc: Math.round(discount),
                };
            });

            this.totals = this.setTotals(this.productsSelected);
            console.log("list amount or desc changend");
        },
        async updateBudget() {
            try {
                const res = await axios.put(`/budgets/${this.id}`, {
                    client_id: this.client.id,
                    reference: this.reference,
                    user_id: this.user,
                    budget_statuses_id: this.budget.detail.budget_statuses_id,
                    products: this.finishOrderProducts.map((el, index) => ({
                        order: index,
                        id_reference: el.id_reference,
                        product_id: el.id,
                        product_price: el.price,
                        product_sku: el.sku,
                        quantity: el.amount,
                        prefix: el.prefix,
                        discount: el.desc,
                        discount_price: el.total_desc,
                        total: el.total,
                    })),
                    neto: Math.round(this.totals.neto),
                    total: Math.round(this.totals.total),
                    iva: Math.round(this.totals.iva),
                });
                window.location.href = "/budget/" + this.budget.id + "/edit";
                return res;
            } catch (error) {
                console.log(error);
                console.log("failed update budget.");
            }
        },
        async storeBudget() {
            try {
                const res = await axios.post(`/budgets`, {
                    client_id: this.client.id,
                    reference: this.reference ? this.reference : "",
                    user_id: this.user,
                    products: this.finishOrderProducts.map((el, index) => ({
                        order: index,
                        product_id: el.id,
                        product_price: el.price,
                        product_sku: el.sku,
                        quantity: el.amount,
                        discount: el.desc,
                        prefix: el.prefix,
                        discount_price: el.total_desc,
                        total: el.total,
                    })),
                    neto: Math.round(this.totals.neto),
                    total: Math.round(this.totals.total),
                    iva: Math.round(this.totals.iva),
                });
                const { budget } = res.data;

                window.location.href = "/budget/" + budget.id + "/edit";
                return res;
            } catch (error) {
                console.log(error);
                console.log("failed create budget.");
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
            const neto = Math.round(
                arr.reduce((sum, value) => sum + value.total, 0)
            );
            const bruto =
                Math.round(
                    arr.reduce((sum, value) => sum + value.total_desc, 0)
                ) + neto;
            const iva = Math.floor(neto * 0.19);
            const total = neto + iva;
            return {
                desc: Math.round(
                    arr.reduce((sum, value) => sum + value.total_desc, 0)
                ),
                neto: Math.round(neto),
                iva: Math.round(iva),
                bruto,
                total: total,
            };
        },
        normalizeDatatable(product) {
            const transformPrice = Math.round(product.price / (1 + 0.19));
            return {
                id: product.id,
                img: product.image,
                sku: product.sku,
                prefix: null,
                amount: product.amount ? product.amount : 1,
                description: product.description,
                price: transformPrice,
                desc: product.discount,
                total: transformPrice * 1,
                actions: "--",
                name: product.name,
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
                .delete("/budgets/" + this.id)
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
                    .get("/budget/copy/" + this.id)
                    .then((res) => {
                        console.log(res);
                        console.log("budget copy.");
                        this.snackbar.visible = true;
                        this.snackbar.text = "Cotización duplicada.";
                        setTimeout(() => {
                            window.location.href = "../";
                        }, 2000);
                    })
                    .catch((err) => {
                        console.log(err, "error copy budget");
                    });
            }
        },
        handleChangeStatus(status) {
            this.budget.detail.budget_statuses_id = parseInt(status);
        },
    },
};
</script>

<style>
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
.disabled-budget-style {
    pointer-events: none;
    cursor: default;
    opacity: 0.6;
}
</style>
