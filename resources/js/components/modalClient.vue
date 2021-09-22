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
                  name="name"
                  placeholder="--"
                />
                <!-- @error('name')
                        @error('name') is-invalid @enderror
                        <div class="invalid-feedback">
                            <div class="alert alert-danger">{{ $message }}</div>
                        </div>
                        @enderror -->
              </div>
              <div class="col-md-6">
                <label class="form-label">Rut</label>
                <input
                  type="text"
                  class="form-control"
                  name="rut"
                  placeholder="--"
                />
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="form-label">Dirección</label>
                <input
                  type="text"
                  class="form-control"
                  name="address"
                  placeholder="--"
                />
              </div>
              <div class="col-md-6">
                <label class="form-label">Teléfono</label>
                <input type="text" class="form-control" />
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label class="form-label">Email</label>
                <input
                  type="text"
                  class="form-control"
                  name="email"
                  placeholder="--"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label">Giro (Opcional)</label>
                <input
                  type="text"
                  class="form-control"
                  name="draft"
                  placeholder="--"
                />
              </div>
              <div class="col-md-4">
                <label class="form-label" for="inputState">Tipo</label>
                <select
                  id="inputState"
                  name="type"
                  class="form-control"
                  placeholder="--"
                >
                  <option value="empresa">Empresa</option>
                  <option value="persona">Persona Natural</option>
                </select>
              </div>
            </div>
          </form>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" text @click="$emit('close')">
            Cerrar
          </v-btn>
          <v-btn color="blue darken-1" text @click="$emit('close')">
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
      dialog: false,
    };
  },
};
</script>