<template>
  <nav>
    <RouterLink to="/">Principal</RouterLink>
    <RouterLink to="/productos">ALMACENES</RouterLink>   
    <RouterLink to="/usuarios">USUARIOS</RouterLink>
    <RouterLink to="/login">LOGIN</RouterLink>
  </nav>
  <main>
    <RouterView />
  </main>
</template>

<style> 
nav {
  background-color: #333;
  padding: 1rem;
}
nav a {
  color: white;
  margin-right: 1rem;
  text-decoration: none;
}
nav a.router-link-exact-active {
  font-weight: bold;
  text-decoration: underline;
}

</style>