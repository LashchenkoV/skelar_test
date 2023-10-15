<script setup>

import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateProductForm from "@/Components/Product/CreateProductForm.vue";
import EditProductForm from "@/Components/Product/EditProductForm.vue";
</script>

<template>
  <Head title="Products"/>

  <AuthenticatedLayout>
    <v-row class="my-2">
      <v-col>
        <v-text-field
            v-model="name"
            hide-details
            placeholder="Search name..."
            density="compact"
        ></v-text-field>
      </v-col>
      <v-col>
        <v-text-field
            v-model="quantity"
            hide-details
            placeholder="Minimum quantity"
            type="number"
            min="0"
            density="compact"
        ></v-text-field>
      </v-col>
      <v-col class="d-flex justify-between">
        <v-btn
            @click="loadItems(this.tableOptions)"
            color="primary"
        >Filter</v-btn>
          <v-btn
              @click="openCreateForm"
              color="green"
          >New Product</v-btn>
      </v-col>
    </v-row>
    <v-data-table-server
        :headers="headers"
        :items="products?.data"
        :loading="loading"
        :items-per-page-options="[2, 5, 10, 50, 100]"
        :items-length="products?.meta?.pagination?.total ?? 1"
        server-pagination
        class="elevation-1"
        show-current-page
        @update:options="loadItems"
    >
      <template v-slot:item.description="{ item }">
        {{ truncateText(item.description) }}
      </template>
      <template v-slot:item.actions="{ item }">
        <v-row>
          <v-col style="padding: 10px 5px"><v-btn @click="edit(item)" color="primary" size="small">Edit</v-btn></v-col>
          <v-col style="padding: 10px 5px"><v-btn @click="remove(item)" color="red" size="small">Remove</v-btn></v-col>
        </v-row>
      </template>
    </v-data-table-server>

    <create-product-form
        @productCreated="handleProductCreated"
        ref="createFormOpened"
    ></create-product-form>

    <edit-product-form
        :product="editedProduct"
        @productUpdated="handleProductUpdated"
        ref="updateFormOpened"
    >
    </edit-product-form>

    <v-dialog v-model="dialogDelete" max-width="500px">
      <v-card>
        <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="closeDelete">Cancel</v-btn>
          <v-btn color="blue-darken-1" variant="text" @click="deleteItemConfirm">OK</v-btn>
          <v-spacer></v-spacer>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </AuthenticatedLayout>
</template>

<script>
import { VDataTableServer } from 'vuetify/labs/VDataTable'
import { useSnackbar } from "@/Components/Global/Snackbar.vue";
const { showSnackbar } = useSnackbar();

export default {
  components: { VDataTableServer },
  data: () => ({
    headers: [
      {
        title: 'Id',
        sortable: true,
        key: 'id',
      },
      {title: 'Name', key: 'name', sortable: false},
      {title: 'Price', key: 'price', align: 'end'},
      {title: 'Quantity', key: 'quantity', sortable: false},
      {title: 'Description', key: 'description', sortable: false},
      {title: 'Actions', key: 'actions', sortable: false},
    ],
    products: [],
    loading: true,
    name: '',
    quantity: '',
    dialogDelete: false,
    removeItem: {},
    editedProduct: {},
    tableOptions: {
      page: 1,
      itemsPerPage: 10,
      sortBy: []
    }
  }),

  methods: {
    truncateText(text) {
      if (text.length > 200) {
        return text.substring(0, 200) + '...';
      }
      return text;
    },

    deleteItemConfirm () {
      axios.delete(route('admin.product.delete', {id: this.removeItem.id}))
          .then((response) => {
            if (response.data.result) {
              this.loadItems(this.tableOptions);
              this.closeDelete()
              this.removeItem = {};

              return;
            }

            showSnackbar("Some error occurs while deleting the product.", 'error');
          })
          .catch((error) => {
            console.log(error)
            showSnackbar(error.response.data.message, 'error');
          })
    },

    closeDelete () {
      this.dialogDelete = false
    },

    openCreateForm() {
      this.$refs.createFormOpened.openDialog();
    },

    handleProductCreated() {
      this.loadItems(this.tableOptions);
    },

    handleProductUpdated() {
      this.loadItems(this.tableOptions);
    },

    loadItems(tableOptions) {
      this.tableOptions = { ...this.tableOptions, ...tableOptions };

      this.loading = true
      axios.get(route('admin.product.get'), {
        params: {
          name: this.name === '' ? null : this.name,
          quantity: this.quantity === '' ? null : this.quantity,
          ...this.tableOptions
        }
      })
          .then((response) => {
            this.products = response.data
          })
          .finally(() => this.loading = false)
    },

    edit(item) {
      this.editedProduct = item;
      this.$refs.updateFormOpened.openDialog();
    },

    remove(item) {
      this.removeItem = item;
      this.dialogDelete = true;
    },
  },
}
</script>
<style scoped>

</style>
