<template>
  <v-row justify="center">
    <v-dialog v-model="show" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="text-h5">Crear cliente</span>
        </v-card-title>
        <v-card-text>
          <form method="POST">
            <div class="row">
              <div class="col-md-6">
                <label class="form-label">Nombre o Razón social</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.name"
                  placeholder="--"
                />
                <!-- @error('name')
                        @error('name') is-invalid @enderror
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror -->
                <span class="text-danger fs-11">{{
                  errors.name && errors.name[0]
                }}</span>
              </div>
              <div class="col-md-6">
                <label class="form-label">Rut</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.rut"
                  placeholder="--"
                />
                <span class="text-danger fs-11">{{
                  errors.rut && errors.rut[0]
                }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="form-label">Dirección</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.address"
                  placeholder="--"
                />
                <span class="text-danger fs-11">{{
                  errors.address && errors.address[0]
                }}</span>
              </div>
              <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input type="text" class="form-control" />
                <span class="text-danger fs-11">{{
                  errors.phone && errors.phone[0]
                }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.email"
                  placeholder="--"
                />
                <span class="text-danger fs-11">{{
                  errors.email && errors.email[0]
                }}</span>
              </div>
              <div class="col-md-4">
                <label class="form-label">Giro (Opcional)</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.draft"
                  placeholder="--"
                />
                <span class="text-danger fs-11">{{
                  errors.draft && errors.draft[0]
                }}</span>
              </div>
              <div class="col-md-4">
                <label class="form-label" for="inputState">Tipo</label>
                <select
                  id="inputState"
                  v-model="form.type"
                  class="form-control"
                  placeholder="--"
                >
                  <option value="empresa">Empresa</option>
                  <option value="persona">Persona Natural</option>
                </select>
                <span class="text-danger fs-11">{{
                  errors.type && errors.type[0]
                }}</span>
              </div>
            </div>
          </form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="$emit('close')">
            Cerrar
          </v-btn>
          <v-btn color="blue darken-1" text @click="handleSaveClient">
            Guardar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script>
export default {
  props: ["show"],
  data() {
    return {
      form: {
        name: null,
        rut: null,
        address: null,
        email: null,
        draft: null,
        type: null,
      },
      errors: [],
      dialog: false,
    };
  },
  methods: {
    async handleSaveClient() {
      try {
        const response = await axios.post("/clients", this.form);
        console.log("client saved.");
        this.$emit("close");
        this.$emit("saved");
      } catch (err) {
        if (err.response.status === 422) {
          this.errors = err.response.data.errors;
          console.log("Unprocessable Entity Client.", err);
        }
        console.log("Failed save client.", err);
      }
    },
  },
};
</script>

<style >
.fs-11 {
  font-size: 11px;
}
</style>