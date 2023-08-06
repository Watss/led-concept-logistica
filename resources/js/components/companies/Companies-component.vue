<template>
    <v-app>
        <v-container>
            <h3 class="mb-4">Listado de compañias</h3>
            <v-data-table
                attach
                :headers="headers"
                :items="companies"
                hide-default-footer
            >
                <template v-slot:item.actions="{ item }">
                    <v-menu offset-y offset-x offset-overflow attach>
                        <template v-slot:activator="{ on }">
                            <v-icon v-on="on">mdi-dots-vertical</v-icon>
                        </template>
                        <v-list>
                            <v-list-item>
                                <v-list-item-icon>
                                    <v-icon>mdi-pencil</v-icon>
                                </v-list-item-icon>

                                <v-list-item-title>Editar</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </template>
            </v-data-table>
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
            { text: "Acciones", align: "center", value: "actions" },
            { text: "Nombre", align: "center", value: "name" },
            { text: "Token", align: "center", value: "token" },
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
