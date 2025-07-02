<template>
  <div class="book-view" v-if="book">
    <button @click="goBack" class="back-button">← Back to Store</button>
    <div class="book-container">
      <div class="book-image">
        <img :src="book.cover_image" :alt="book.name" />
        <a class="price">${{ book.price }} - Add to Cart</a>
      </div>

      <div class="book-details">
        <h1>{{ book.name }}</h1>
        <p class="author">by {{ book.author }}</p>
        <p class="categories">
          Categories:
          <span class="category">{{ book.category }}</span>
        </p>
        <hr />
        <p class="summary">{{ book.summary }}</p>
      </div>
    </div>
  </div>

  <div v-else-if="loading" class="loading">Loading book details...</div>

  <div v-else class="error">Book not found</div>
</template>

<script setup>
import { useProductStore } from '@/stores/products'
import { useRoute, useRouter } from 'vue-router'
import { computed, onMounted } from 'vue'

const productStore = useProductStore()
const route = useRoute()
const router = useRouter()

const bookId = computed(() => parseInt(route.params.id))
const book = computed(() => productStore.products.find((p) => p.id === bookId.value))
const loading = computed(() => productStore.loading)

const goBack = () => {
  router.push('/store')
}

onMounted(async () => {
  if (productStore.products.length === 0) {
    await productStore.fetchProducts()
  }
})
</script>
