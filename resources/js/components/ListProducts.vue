<template>
    <div>
        <v-data-table
            :headers="headers"
            :items="products"
            hide-default-footer
            :items-per-page="-1"
            item-key="index"
        >
            <template v-slot:body>
                <draggable
                    @change="logDraggable"
                    v-model="productOrder"
                    tag="tbody"
                >
                    <tr v-for="(item, index) in productOrder" :key="index">
                        <td>
                            <v-icon small class="page__grab-icon">
                                mdi-arrow-all
                            </v-icon>
                        </td>
                        <td>
                            <v-edit-dialog
                                :return-value.sync="item.amount"
                                large
                                persistent
                                cancel-text="Cerrar"
                                save-text="Guardar"
                                @save="save('prefix')"
                                @cancel="cancel"
                                @open="open"
                                @close="close"
                            >
                                <div>
                                    {{ item.prefix ?? `Item ${index + 1}` }}
                                </div>
                                <template v-slot:input>
                                    <div class="mt-4 text-h6">
                                        Modificar prefijo
                                    </div>
                                    <v-text-field
                                        v-model="item.prefix"
                                        label="Edit"
                                        single-line
                                        counter
                                        autofocus
                                    ></v-text-field>
                                </template>
                            </v-edit-dialog>
                        </td>
                        <td>
                            <div class="m-1">
                                <div v-if="item.img">
                                    <img
                                        width="50"
                                        height="50"
                                        :src="'/' + item.img"
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
                        </td>
                        <td>{{ item.name }}</td>
                        <td>
                            <v-edit-dialog
                                :return-value.sync="item.amount"
                                large
                                persistent
                                cancel-text="Cerrar"
                                save-text="Guardar"
                                @save="save('amount')"
                                @cancel="cancel"
                                @open="open"
                                @close="close"
                            >
                                <div>{{ item.amount }}</div>
                                <template v-slot:input>
                                    <div class="mt-4 text-h6">
                                        Modificar cantidad
                                    </div>
                                    <v-text-field
                                        v-model="item.amount"
                                        label="Edit"
                                        single-line
                                        counter
                                        autofocus
                                    ></v-text-field>
                                </template>
                            </v-edit-dialog>
                        </td>
                        <td>
                            <v-edit-dialog
                                :return-value.sync="item.price"
                                large
                                persistent
                                cancel-text="Cerrar"
                                save-text="Guardar"
                                @save="save('amount')"
                                @cancel="cancel"
                                @open="open"
                                @close="close"
                            >
                                <div>${{ formatPrice(item.price) }}</div>
                                <template v-slot:input>
                                    <div class="mt-4 text-h6">
                                        Modificar precio
                                    </div>
                                    <v-text-field
                                        v-model="item.price"
                                        label="Edit"
                                        single-line
                                        counter
                                        autofocus
                                        :disabled="!isAdmin"
                                    ></v-text-field>
                                </template>
                            </v-edit-dialog>
                        </td>
                        <td>
                            <v-edit-dialog
                                cancel-text="Cerrar"
                                save-text="Guardar"
                                :return-value.sync="item.desc"
                                large
                                persistent
                                @save="save('desc')"
                                @cancel="cancel"
                                @open="open"
                                @close="close"
                            >
                                <div>{{ item.desc }}</div>
                                <template v-slot:input>
                                    <div class="mt-4 text-h6">
                                        Modificar Descuento
                                    </div>
                                    <v-text-field
                                        :rules="[max90chars]"
                                        type="number"
                                        v-model="item.desc"
                                        label="Editar"
                                        single-line
                                        counter
                                        autofocus
                                    ></v-text-field>
                                </template>
                            </v-edit-dialog>
                        </td>

                        <td>${{ formatPrice(item.total) }}</td>
                        <td>
                            <button
                                type="button"
                                class="btn btn-light btn-sm"
                                style="border-radius: 20px"
                                @click="deleteItem(item, index)"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                </draggable>
            </template>
            <template v-slot:no-data>
                <p>No hay productos seleccionados.</p>
            </template>
            <template slot="body.append">
                <div class="container"></div>
            </template>
        </v-data-table>
        <div class="container row d-flex justify-content-end">
            <div class="col-5">
                <div class="d-flex justify-content-between">
                    <div class="mr-5">Bruto</div>
                    <div>
                        ${{ formatPrice(totals.bruto ? totals.bruto : 0) }}
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mr-5">Descuento</div>
                    <div>-${{ formatPrice(totals.desc) }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mr-5">Neto</div>
                    <div>${{ formatPrice(totals.neto) }}</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="mr-5">IVA</div>
                    <div>${{ formatPrice(totals.iva ? totals.iva : 0) }}</div>
                </div>
                <br class="" />
                <div class="d-flex justify-content-between">
                    <div class="mr-5 font-weight-bold h4">Total</div>
                    <div class="h4 fw-bold">
                        ${{ formatPrice(totals.total) }}
                    </div>
                </div>
            </div>
        </div>

        <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
            {{ snackText }}

            <template v-slot:action="{ attrs }">
                <v-btn v-bind="attrs" text @click="snack = false">
                    Cerrar
                </v-btn>
            </template>
        </v-snackbar>
    </div>
</template>
<script>
import Draggable from "vuedraggable";

export default {
    props: ["products", "totals", "isAdmin"],
    components: { Draggable },
    data: () => ({
        clients: [],
        value: null,
        snack: false,
        snackColor: "",
        productOrder: [],
        snackText: "",
        pagination: {},
        headers: [
            {
                text: "Mover",
                align: "start",
                sortable: false,
            },
            {
                text: "Prefijo",
                align: "start",
                sortable: false,
                width: 120,
            },
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
    watch: {
        products(value) {
            console.log("cambio");
            this.productOrder = value;
        },
    },
    mounted() {
        this.productOrder = this.products;
    },
    methods: {
        logDraggable() {
            this.$emit("update-position", this.productOrder);
        },
        max90chars: (v) => {
            return v > 90 ? "Excede el máximo" : true;
        },
        formatPrice(value) {
            var formatter = new Intl.NumberFormat("en-CL");
            return formatter.format(value);
        },
        save(type) {
            this.snack = true;
            this.snackColor = "success";
            this.snackText = "Datos cambiados";
            this.$emit("change", this.productOrder);
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
            this.editedIndex = this.productOrder.indexOf(item);
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
    box-shadow: 0px 1px 0px -2px rgb(0 0 0 / 20%),
        0px 0px 0px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%);
}
.v-text-field.v-text-field--solo:not(.v-text-field--solo-flat)
    > .v-input__control
    > .v-input__slot {
    box-shadow: 0px 1px 0px -2px rgb(0 0 0 / 20%),
        0px 0px 0px 0 rgb(0 0 0 / 14%), 0 1px 5px 0 rgb(0 0 0 / 12%);
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
