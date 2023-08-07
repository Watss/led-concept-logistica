<template>
    <v-app>
        <v-container>
            <slot v-for="company in companies">
                <h3 class="mb-4">
                    Listado de Documentos de {{ company.name }}
                </h3>
                <v-data-table
                    attach
                    :headers="headers"
                    :items="company.documents_types"
                    hide-default-footer
                    class="mb-5"
                >
                    <template v-slot:item.custom_type="{ item }">
                        <v-chip
                            :color="item.is_sum ? 'green' : 'blue'"
                            dark
                            small
                            >{{ item.is_sum ? "Suma Venta" : "Resta Venta" }}
                        </v-chip>
                    </template>
                    <!-- <template v-slot:item.actions="{ item }">
                        <v-menu offset-y offset-x offset-overflow attach>
                            <template v-slot:activator="{ on }">
                                <v-icon v-on="on">mdi-dots-vertical</v-icon>
                            </template>
                            <v-list>
                                <v-list-item>
                                    <v-list-item-icon>
                                        <v-icon>mdi-pencil</v-icon>
                                    </v-list-item-icon>

                                    <v-list-item-title
                                        >Editar</v-list-item-title
                                    >
                                </v-list-item>
                            </v-list>
                        </v-menu>
                    </template> -->
                </v-data-table>
            </slot>
        </v-container>
    </v-app>
</template>

<script>
export default {
    props: {
        companies: {
            type: Array,
            required: true,
        },
    },
    data: () => ({
        headers: [
            { text: "Nombre", align: "center", value: "name" },
            { text: "Id Bsale", align: "center", value: "id_bsale" },
            { text: "Tipo", align: "center", value: "custom_type" },
        ],
    }),
    methods: {
        //
    },
    mounted() {
        //
    },
};
</script>
