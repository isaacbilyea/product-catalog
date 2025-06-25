<template>
  <div class="store">
    <div v-if="productStore.loading" class="loading">
      <p>Loading products...</p>
    </div>

    <div v-else-if="productStore.error" class="error">
      <p>Error loading products: {{ productStore.error }}</p>
      <button @click="productStore.fetchProducts()" class="retry-btn">Try Again</button>
    </div>

    <div v-else class="products-container">
      <div v-if="productStore.products.length === 0" class="no-products">
        <p>No products available yet.</p>
      </div>

      <div v-else class="products-grid">
        <div v-for="product in productStore.products" :key="product.id" class="product-card">
          <div class="product-image">
            <img :src="product.cover_image" :alt="product.name" />
          </div>

          <div class="product-info">
            <h3 class="product-title">{{ product.name }}</h3>
            <p class="product-author" v-if="product.author">by {{ product.author }}</p>
            <p class="product-summary">{{ product.summary }}</p>
            <div class="product-footer">
              <span class="product-price">${{ product.price }}</span>
              <span class="product-category">{{ product.category }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import { useProductStore } from '@/stores/products'

const productStore = useProductStore()

onMounted(() => {
  productStore.fetchProducts()
})
</script>
