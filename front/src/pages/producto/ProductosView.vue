<template>
 <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <span style="font-size: 24px; font-weight: bold;">Productos</span>
    <button @click="crearproducto" style="padding: 0.5rem 1rem; background-color:green;color: white; border:none; border-radius:4px; cursor:pointer;">Crear Producto</button>
 </div>
    
    <p>Lista de productos disponibles</p>
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th>Categoria</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <tr v-bind:data-allow-mismatch="true" v-for="producto in productos" :key="producto.id">
            <td>{{ producto.id }}</td>
           <td>
                <img :src="`http://localhost:8000/imagenes/${producto.imagen}`" alt="Imagen del producto" style="width: 50px; height: 50px; object-fit: cover;" />
           </td>
            <td>{{ producto.nombre }}</td>
            <td>{{ producto.descripcion }}</td>
            <td>{{ producto.precio }}</td>

            <td>{{ producto.categoria.nombre }}</td>
            <!-- <td>
                <button @click="editarProducto(producto.id)">Editar</button>
                
            </td> -->
        <button @click="eliminarProducto(producto.id)">Eliminar</button>
        </tr>
    </tbody>
    </table>

</template>
<script>
import axios from 'axios';
export default {
    name: 'ProductosView', 
    data() {
        return {
            productos: [],
        }
    },
    mounted() {
        this.productosGet();
    },
    methods: {
        async productosGet() {
            axios.get('http://localhost:8000/api/productos')
                .then(response => {
                    this.productos = response.data;
                    //console.log(this.productos);
                })
                .catch(error => {
                    console.error('Error al cargar los productos:', error);
                });
             },
        crearproducto() {
            this.$router.push('/productos/crear');
        },
        eliminarProducto(id) {
            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                axios.delete(`http://localhost:8000/api/productos/${id}`)
                    .then(() => {
                        alert('Producto eliminado exitosamente');
                        this.productosGet(); // Refrescar la lista de productos
                    })
                    .catch(error => {
                        console.error('Error al eliminar el producto:', error);                    
                    });
            }
        },
    },
 };
</script>
<style>

table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
}
th {
  background-color: #f2f2f2;
}
</style>
