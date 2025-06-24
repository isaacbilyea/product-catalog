import { defineStore } from 'pinia'
import axios from 'axios'

const API_BASE = 'http://localhost:8000/api'

export const useProductStore = defineStore('products', {
  state: () => ({
    products: [],
    loading: false,
    error: null,
  }),

  actions: {
    async fetchProducts() {
      this.loading = true
      try {
        const response = await axios.get(`${API_BASE}/products`)
        this.products = response.data
      } catch (error) {
        this.error = error.message
      } finally {
        this.loading = false
      }
    },

    async createProduct(product) {
      try {
        const response = await axios.post(`${API_BASE}/products`, product)
        this.products.push(response.data)
        return response.data
      } catch (error) {
        this.error = error.message
        throw error
      }
    },

    async updateProduct(id, product) {
      try {
        const response = await axios.put(`${API_BASE}/products/${id}`, product)
        const index = this.products.findIndex((p) => p.id === id)
        if (index !== -1) {
          this.products[index] = response.data
        }
        return response.data
      } catch (error) {
        this.error = error.message
        throw error
      }
    },

    async deleteProduct(id) {
      try {
        await axios.delete(`${API_BASE}/products/${id}`)
        this.products = this.products.filter((p) => p.id !== id)
      } catch (error) {
        this.error = error.message
        throw error
      }
    },
  },
})
