<template>
<div id="layout">

  <nav>
    <RouterLink to="/">Principal</RouterLink>
    <RouterLink to="/productos">Productos</RouterLink>
  </nav>
  <main>
    <RouterView />
  </main>
  </div>
</template>
<style scoped>
layout {
  display: flex;        /* Dos columnas: nav y contenido */
  height: 100vh;        /* ocupa toda la pantalla */
  gap: 20px;            /* espacio entre nav y contenido */
  padding: 10px;
  box-sizing: border-box;
}

/* Columna 1: sidebar */
nav {
  display: flex;
  flex-direction: column;
  gap: 1rem;
  width: 200px;
  background-color: #42b983;
  padding: 1rem;
  height: 100%;
  border-radius: 10px;
}

nav a {
  color: white;
  text-decoration: none;
  font-weight: bold;
  padding: 8px;
  border-radius: 5px;
}

nav a:hover {
  background-color: #2e8b68;
  text-decoration: underline;
}

/* Columna 2: contenido */
main {
  flex: 1;              /* ocupa todo el espacio restante */
  padding: 20px;
  background-color: #f4f6f7;
  border-radius: 10px;
  overflow-y: auto;     /* si hay mucho contenido se hace scroll */
}
</style>
