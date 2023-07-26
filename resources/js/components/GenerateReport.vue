<template>
    <v-app>
        <v-container class="px-4">
            <v-alert
                :value="alert"
                color="green"
                dark
                border="top"
                icon="mdi-check"
                transition="scale-transition"
            >
                El reporte se está generando en segundo plano. Se enviará un
                correo electrónico a los correos seleccionados con el reporte
                adjunto al finalizar.
            </v-alert>
            <v-alert
                :value="!alert"
                border="bottom"
                colored-border
                class="p-4"
                type="warning"
                elevation="2"
            >
                <b>Atención !</b> Se generará el reporte en segundo plano, se
                enviará un correo electrónico a los correos seleccionados con el
                reporte adjunto.
            </v-alert>
            <v-row justify="center" class="mt-10">
                <v-col cols="6">
                    <v-text-field
                        v-model="fechaInicial"
                        label="Fecha inicial"
                        type="date"
                    ></v-text-field>
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        v-model="email"
                        label="Agregar correos electrónicos"
                        hint='Presione "Enter" para agregar un correo electrónico'
                        @keydown.enter="agregarCorreo"
                    ></v-text-field>
                    <div v-if="emails.length > 0" class="mb-2">
                        Correos seleccionados
                    </div>
                    <v-chip
                        class="mx-1"
                        v-for="(correo, index) in emails"
                        :key="index"
                        close
                        close-icon="mdi-delete"
                        @click:close="borrarCorreo(index)"
                    >
                        {{ correo }}
                    </v-chip>
                </v-col>
            </v-row>

            <v-col cols="6">
                <v-btn
                    class="text-white"
                    @click="generarReporte"
                    :loading="loadingGenerate"
                    color="green"
                    >Generar Reporte Excel</v-btn
                >
            </v-col>
            <h3 class="my-10">Historial de reportes generados</h3>
            <v-data-table
                attach
                :headers="headers"
                :items="reports"
                :loading="loadingReports"
                no-data-text="No se encontraron reportes"
                :footer-props="{
                    'items-per-page-text': 'Reportes por página',
                    'items-per-page-all-text': 'Todo',
                }"
            >
                <template v-slot:item.created_at="{ item }">
                    <div>{{ getDate(item.created_at, true) }}</div>
                </template>
                <template v-slot:item.start="{ item }">
                    <div>{{ getDate(item.start) }}</div>
                </template>
                <template v-slot:item.end="{ item }">
                    <div>{{ getDate(item.end) }}</div>
                </template>
                <template v-slot:item.status="{ item }">
                    <v-chip
                        :color="
                            item.generated
                                ? 'green'
                                : item.failed
                                ? 'red'
                                : 'yellow'
                        "
                        dark
                        small
                        >{{
                            item.generated
                                ? "Correo enviado"
                                : item.failed
                                ? "Fallido"
                                : "En proceso"
                        }}
                    </v-chip>
                </template>
                <template v-slot:item.actions="{ item }">
                    <v-menu offset-y offset-x offset-overflow attach>
                        <template v-slot:activator="{ on }">
                            <v-icon v-on="on">mdi-dots-vertical</v-icon>
                        </template>
                        <v-list>
                            <v-list-item @click="volverGenerar">
                                <v-list-item-icon>
                                    <v-icon>mdi-refresh</v-icon>
                                </v-list-item-icon>

                                <v-list-item-title
                                    >Volver a Generar</v-list-item-title
                                >
                            </v-list-item>
                            <v-list-item
                                @click="descargarArchivo"
                                v-if="item.generated && !item.failed"
                            >
                                <v-list-item-icon>
                                    <v-icon>mdi-file-excel</v-icon>
                                </v-list-item-icon>
                                <v-list-item-title
                                    >Descargar Archivo</v-list-item-title
                                >
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </template>
            </v-data-table>
        </v-container>
        <v-snackbar v-model="snackbar">
            "Se produjo un error al generar el reporte, intentelo denuevo en
            unos minutos"

            <template v-slot:action="{ attrs }">
                <v-btn
                    color="red"
                    text
                    v-bind="attrs"
                    @click="snackbar = false"
                >
                    Cerrar
                </v-btn>
            </template>
        </v-snackbar>
    </v-app>
</template>

<script>
import moment from "moment";
export default {
    name: "GenerateReport",
    props: ["companies"],
    data() {
        return {
            fechaInicial: null,
            emails: [],
            reports: [],
            loadingReports: false,
            email: null,
            alert: false,
            snackbar: false,
            loadingGenerate: false,
            search: "",
            headers: [
                { text: "Acciones", align: "center", value: "actions" },
                {
                    text: "Fecha de generación",
                    align: "start",
                    filterable: true,
                    value: "created_at",
                },
                { text: "Desde (fecha)", value: "start" },
                { text: "Hasta (fecha)", value: "end" },
                { text: "Generado por", value: "userName" },
                { text: "Estado", value: "status" },
            ],
        };
    },
    mounted() {
        this.getReports();
        setTimeout(
            () => this.getReports(), // 3 minutos
            180000
        );
    },
    methods: {
        getDate(d, withHour = false) {
            if (withHour) {
                return moment(d).format("DD-MM-YYYY HH:mm");
            } else {
                return moment(d).format("DD-MM-YYYY");
            }
        },
        generarReporte() {
            if (this.fechaInicial !== null) {
                this.loadingGenerate = true;
                axios
                    .get("/reporte/generar-excel", {
                        params: {
                            start: this.fechaInicial,
                            emails: this.emails,
                        },
                    })
                    .then((res) => {
                        this.loadingGenerate = false;
                        this.alert = true;

                        setTimeout(() => {
                            this.getReports();
                            this.alert = false;
                        }, 4000);
                    })
                    .catch((err) => {
                        console.error(err);
                        this.loadingGenerate = false;
                        this.snackbar = true;
                    });
            } else {
                this.$toast.error("Debe seleccionar una fecha");
            }
        },
        agregarCorreo() {
            const regexCorreo =
                /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (regexCorreo.test(this.email)) {
                this.emails.push(this.email);
                this.email = "";
            } else {
                this.$toast.error("No es un correo válido");
            }
        },
        borrarCorreo(index) {
            this.emails.splice(index, 1);
        },
        getReports() {
            axios
                .get("/get-reports")
                .then((res) => {
                    console.log(res);
                    this.reports = res.data;
                })
                .catch((err) => {
                    console.error(err);
                });
        },
        volverGenerar() {
            // Lógica para la opción "Volver a Generar"
            // ...
        },
        descargarArchivo() {
            // Lógica para la opción "Descargar Archivo"
            // ...
        },
        enviarCorreos() {
            // Aquí iría la lógica para enviar los correos electrónicos
            // Puedes utilizar alguna librería para enviar correos, como "nodemailer"
            console.log("Enviando correos...");
            console.log("Correos electrónicos:", this.emails);
        },
    },
};
</script>
<style>
.no-padding {
    padding: 10px;
}
</style>
