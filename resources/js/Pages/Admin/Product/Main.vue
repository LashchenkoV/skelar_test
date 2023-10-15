<script setup>

import {Head} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import CreateProductForm from "@/Components/Product/CreateProductForm.vue";
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
            @click="loadItems"
            color="primary"
        >Filter</v-btn>
          <v-btn
              @click="openCreateForm"
              color="green"
          >New Product</v-btn>
      </v-col>
    </v-row>
    <v-data-table
        v-model:items-per-page="itemsPerPage"
        :headers="headers"
        :items-length="products?.meta?.pagination?.total ?? 0"
        :items="products?.data ?? []"
        :loading="loading"
        class="elevation-1"
        @update:options="loadItems"
    >
      <template v-slot:item.actions="{ value }">
        <v-row>
          <v-col style="padding: 10px 5px"><v-btn @click="edit(item.id)" color="primary" size="small">Edit</v-btn></v-col>
          <v-col style="padding: 10px 5px"><v-btn @click="remove(item.id)" color="red" size="small">Remove</v-btn></v-col>
        </v-row>
      </template>
    </v-data-table>

    <create-product-form
        @productCreated="handleProductCreated"
        ref="createFormOpened"
    ></create-product-form>
  </AuthenticatedLayout>
</template>

<script>
import { VDataTable } from 'vuetify/labs/VDataTable'

export default {
  components: { VDataTable },
  data: () => ({
    itemsPerPage: 15,
    headers: [
      {
        title: 'Id',
        align: 'start',
        sortable: false,
        key: 'id',
      },
      {title: 'Name', key: 'name', align: 'end'},
      {title: 'Price', key: 'price', align: 'end'},
      {title: 'Quantity', key: 'quantity', align: 'end'},
      {title: 'Description', key: 'description', align: 'end'},
      {title: 'Actions', key: 'actions', align: 'end'},
    ],
    products: [],
    loading: true,
    name: '',
    quantity: '',
  }),

  methods: {
    openCreateForm() {
      this.$refs.createFormOpened.openDialog();
    },

    handleProductCreated() {
      this.loadItems();
    },

    loadItems() {
      this.loading = true
      axios.get(route('admin.product.get'), {
        params: {
          name: this.name === '' ? null : this.name,
          quantity: this.quantity === '' ? null : this.quantity
        }
      })
          .then((response) => {
            this.products = response.data
          })
          .finally(() => this.loading = false)
    },

    edit(id) {

    },

    remove(id) {

    },
  },
}
</script>
<style scoped>

</style>
