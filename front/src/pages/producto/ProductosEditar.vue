<template>
   <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <span style="font-size: 24px; font-weight: bold;">Crear producto</span>
   </div>
 <p>Formulario para crear un nuevo producto</p>
 <form @submit.prevent="productoEditar">
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" v-model="producto.nombre" />
    </div>
    <div>
        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" v-model="producto.descripcion" />
    </div>
    <div>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" v-model="producto.precio" />
    </div>
    <div>
        <label for="lote">Lote:</label>
        <input type="text" id="lote" v-model="producto.lote" />
    </div>
    <div>
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" @change="handFileUpload" accept="image/" />
    </div>
    <div>
        <label for="fecha_vencimiento">Fecha de Vencimiento:</label>
        <input type="date" id="fecha_vencimiento" v-model="producto.fecha_vencimiento" />
    </div>
    <div>
        <label for="unidad_medida">Unidad de Medida:</label>
        <input type="text" id="unidad_medida" v-model="producto.unidad_medida" />
    </div>
    <div>
        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" v-model="producto.categoria_id" required>
            <option disable value=""> Seleccione una categoría </option>
            <option v-for="categoria in categorias" :key="categoria.id" :value="categoria.id">
                {{ categoria.nombre }}
            </option>
        </select>
    </div>
    <button type="submit">guardar Producto</button>
    </form>
<!-- <pre>
    {{ categorias }}
</pre> -->
</template>
<script>
import axios from 'axios';
export default {
    name: 'ProductosEditar',
  data(){
    return{ 
    producto:{ 
        nombre: '',
        descripcion:'',
        precio:'',
        lote:'',
        imagen:'',
        fecha_vencimiento:'',
        unidad_medida:'',
        categoria_id:'',
    },
    categorias:[],
  };
},
mounted(){ 
    this.categoriasGet();
    this.productoGet();
},

methods:{ 
    productoGet(){ 
        axios.get(`http://localhost:8000/api/productos/${this.$route.params.id}`)
        .then((response)=>{ 
            this.producto=response.data;
        })
        .catch((error)=>{ 
            console.error('Error al cargar el producto:',error);
        });
    },
    handFileUpload(event){ 
        const file=event.target.files[0];
        this.producto.imagen=file;  
    },
    async categoriasGet(){ 
       axios.get('http://localhost:8000/api/categorias')
        .then(response=>{ 
            this.categorias=response.data;
        })
        .catch(error=>{ 
            console.error('Error al cargar las categorias:',error);
        });
    },
        productoEditar(){ 
            const formData=new FormData();
            formData.append('nombre',this.producto.nombre); 
            formData.append('descripcion',this.producto.descripcion); 
            formData.append('precio',this.producto.precio); 
            formData.append('lote',this.producto.lote); 
            formData.append('imagen',this.producto.imagen); 
            formData.append('fecha_vencimiento',this.producto.fecha_vencimiento); 
            formData.append('unidad_medida',this.producto.unidad_medida);
            formData.append('categoria_id',this.producto.categoria_id);

            axios.post(`http://localhost:8000/api/productos/${this.$route.params.id}`,formData, { 
                headers:{ 
                    'Content-Type':'multipart/form-data',
                },
                })
                .then((response)=>{ 
                    console.log('Producto editado exitosamente:',response.data);
                    this.producto={
                        nombre: '',
                        descripcion:'',
                        precio:'',
                        lote:'',
                        imagen:'',
                        fecha_vencimiento:'',
                        unidad_medida:'',
                        categoria_id:'null',
                    };
                    this.$router.push('/productos');
                })
                .catch((error)=>{ 
                    console.error('Error al editar el producto:',error);
                });



        },
},
};
</script>