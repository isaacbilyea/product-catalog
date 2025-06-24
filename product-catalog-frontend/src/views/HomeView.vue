<template>
  <div class="product-catalog">
    <div class="header">
      <h1>Product Catalog</h1>
      <Button label="Add Product" icon="pi pi-plus" @click="showAddDialog = true" />
    </div>

    <DataTable
      :value="productStore.products"
      :loading="productStore.loading"
      paginator
      :rows="10"
      dataKey="id"
      filterDisplay="menu"
      :globalFilterFields="['name', 'category']"
    >
      <Column field="name" header="Name" sortable></Column>
      <Column field="description" header="Description"></Column>
      <Column field="price" header="Price" sortable>
        <template #body="slotProps"> ${{ slotProps.data.price }} </template>
      </Column>
      <Column field="category" header="Category" sortable></Column>
      <Column header="Actions">
        <template #body="slotProps">
          <Button icon="pi pi-pencil" class="p-button-text" @click="editProduct(slotProps.data)" />
          <Button
            icon="pi pi-trash"
            class="p-button-text p-button-danger"
            @click="deleteProduct(slotProps.data.id)"
          />
        </template>
      </Column>
    </DataTable>

    <!-- Add/Edit Dialog -->
    <Dialog
      v-model:visible="showAddDialog"
      :header="editingProduct ? 'Edit Product' : 'Add Product'"
      :modal="true"
      :style="{ width: '50vw' }"
    >
      <div class="product-form">
        <div class="field">
          <label for="name">Name</label>
          <InputText id="name" v-model="form.name" class="w-full" />
        </div>

        <div class="field">
          <label for="description">Description</label>
          <Textarea id="description" v-model="form.description" class="w-full" rows="3" />
        </div>

        <div class="field">
          <label for="price">Price</label>
          <InputText id="price" v-model="form.price" type="number" step="0.01" class="w-full" />
        </div>

        <div class="field">
          <label for="category">Category</label>
          <InputText id="category" v-model="form.category" class="w-full" />
        </div>
      </div>

      <template #footer>
        <Button label="Cancel" icon="pi pi-times" @click="closeDialog" class="p-button-text" />
        <Button
          :label="editingProduct ? 'Update' : 'Save'"
          icon="pi pi-check"
          @click="saveProduct"
          autofocus
        />
      </template>
    </Dialog>

    <Toast />
  </div>
</template>

<script>
import { useProductStore } from '@/stores/products'
import { useToast } from 'primevue/usetoast'

export default {
  name: 'ProductCatalog',
  setup() {
    const productStore = useProductStore()
    const toast = useToast()

    return { productStore, toast }
  },

  data() {
    return {
      showAddDialog: false,
      editingProduct: null,
      form: {
        name: '',
        description: '',
        price: '',
        category: '',
      },
    }
  },

  async mounted() {
    await this.productStore.fetchProducts()
  },

  methods: {
    editProduct(product) {
      this.editingProduct = product
      this.form = { ...product }
      this.showAddDialog = true
    },

    async saveProduct() {
      try {
        if (this.editingProduct) {
          await this.productStore.updateProduct(this.editingProduct.id, this.form)
          this.toast.add({
            severity: 'success',
            summary: 'Success',
            detail: 'Product updated successfully',
          })
        } else {
          await this.productStore.createProduct(this.form)
          this.toast.add({
            severity: 'success',
            summary: 'Success',
            detail: 'Product created successfully',
          })
        }
        this.closeDialog()
      } catch (error) {
        this.toast.add({ severity: 'error', summary: 'Error', detail: 'Failed to save product' })
      }
    },

    async deleteProduct(id) {
      if (confirm('Are you sure you want to delete this product?')) {
        try {
          await this.productStore.deleteProduct(id)
          this.toast.add({
            severity: 'success',
            summary: 'Success',
            detail: 'Product deleted successfully',
          })
        } catch (error) {
          this.toast.add({
            severity: 'error',
            summary: 'Error',
            detail: 'Failed to delete product',
          })
        }
      }
    },

    closeDialog() {
      this.showAddDialog = false
      this.editingProduct = null
      this.form = {
        name: '',
        description: '',
        price: '',
        category: '',
      }
    },
  },
}
</script>

<style scoped>
.product-catalog {
  padding: 2rem;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

.product-form .field {
  margin-bottom: 1rem;
}

.product-form label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
}

.w-full {
  width: 100%;
}
</style>
