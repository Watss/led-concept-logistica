<template>
  <v-row justify="center">
    <v-dialog v-model="show" persistent max-width="600px">
      <v-card>
        <v-card-title>
          <span class="text-h5">Crear Producto Temporal</span>
        </v-card-title>
        <v-card-text>
          <form method="POST">
            <div class="row">
            <div class="col-md-12">
                <label for="form-label">Foto</label>
                <input type="file" class="form-control" name="image" @change="getImage" accept="image/*">
            </div>
              <div class="col-md-6">
                <label class="form-label">Nombre</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.name"
                  placeholder="nombre de producto"
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
                <label class="form-label">SKU</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.sku"
                  placeholder="SKU producto"
                />
                <span class="text-danger fs-11">{{
                  errors.sku && errors.sku[0]
                }}</span>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="form-label">Precio</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.price"
                  placeholder="ej: 2000"
                />
                <span class="text-danger fs-11">{{
                  errors.price && errors.price[0]
                }}</span>
              </div>
              <div class="col-md-6 justify-content-center">
                <img :src="imageView" alt="" class="rounded img-thumbnail text-center" width="200px" heigth="200px" v-if="imageView">
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
        imageView: null,
      form: {
        image: null,
        name: null,
        sku: null,
        price: null,
        type: 'TEMPORAL'
      },
      errors: [],
      dialog: false,
    };
  },
  methods: {
      getImage(e){
        let image = e.target.files[0];
        let reader = new FileReader();
        reader.readAsDataURL(image);
        reader.onload = e => {
            this.imageView = e.target.result;
            this.form.image = image;
        }
    },
    async handleSaveClient() {
      try {
        const formData = new FormData();
        Object.entries(this.form).forEach( ([key, value]) => {
            if(value){
                formData.append(key,value);
            }
        });
        const response = await axios.post("/product-store-json", formData);
        console.log(response);
        console.log("product saved.");
        this.$emit("close");
        this.$emit("saved");
      } catch (err) {
        if (err.response.status === 422) {
          this.errors = err.response.data.errors;
          console.log("Unprocessable Entity Client.", err);
        }
        console.log("Failed save product.", err);
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
