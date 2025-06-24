<template>
  <header id="page-header">
    <img src="@/assets/book.svg" alt="Isaac's Book Store Logo" class="logo" />
    <h1>Isaac's Book Store</h1>
    <nav>
      <RouterLink to="/">Catalog</RouterLink>
      <RouterLink to="/store">Store</RouterLink>
    </nav>
  </header>

  <RouterView />
</template>
