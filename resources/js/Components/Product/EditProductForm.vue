<template>
  <v-row justify="center">
    <v-dialog
        v-model="dialog"
        persistent
        width="1024"
    >
      <v-form ref="editProductForm">
        <v-card>
          <v-card-title>
            <span class="text-h5">Edit product</span>
          </v-card-title>
          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-text-field
                      v-model="product.name"
                      label="Name"
                      type="text"
                      :rules="rules"
                      required
                  ></v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                      v-model="product.description"
                      label="Description"
                      type="text"
                      :rules="rules"
                      required
                  ></v-textarea>
                </v-col>
                <v-col
                    cols="12"
                    sm="6"
                >
                  <v-text-field
                      prepend-icon="mdi-currency-usd"
                      label="Price"
                      v-model="product.price"
                      type="number"
                      min="0"
                      :rules="rules"
                      required
                  ></v-text-field>
                </v-col>
                <v-col
                    cols="12"
                    sm="6"
                >
                  <v-text-field
                      label="Quantity"
                      type="number"
                      v-model="product.quantity"
                      min="0"
                      :rules="rules"
                      required
                  ></v-text-field>
                </v-col>
              </v-row>
            </v-container>
            <small>*indicates required field</small>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
                color="blue-darken-1"
                variant="text"
                @click="dialog = false"
            >
              Close
            </v-btn>
            <v-btn
                color="blue-darken-1"
                variant="text"
                @click="editProduct"
            >
              Save
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-form>
    </v-dialog>
  </v-row>
</template>
<script>
import { useSnackbar } from "@/Components/Global/Snackbar.vue";
const { showSnackbar } = useSnackbar();

export default {
  data: () => ({
    dialog: false,
    rules: [
        value => {
          if (value) return true;

          return 'The field is required to fill.'
        },
    ]
  }),

  props: {
    product: {
      type: Object,
      required: true,
    },
  },

  methods: {
    openDialog() {
      this.dialog = !this.dialog;
    },

    async editProduct() {
      const isValid = (await this.$refs.editProductForm.validate())?.valid;
      if (!isValid) {
        return;
      }

      axios.put(route('admin.product.edit'), this.product)
          .then((response) => {
            this.dialog = false;
            this.$emit('productUpdated', response.data);
            showSnackbar('Product has been successfully updated');
          })
          .catch((error) => {
            console.log(error)
            showSnackbar(error.response.data.message, 'error');
          })
    },
  }
}
</script>
