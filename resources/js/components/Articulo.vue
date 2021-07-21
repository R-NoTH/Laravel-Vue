<template>
  <div>
    <h1 class="text-center">Hola Mundo</h1>
    <hr>
    <!-- Button trigger modal -->
    <button
      @click="
        modificar = false;
        mostrarModal();
      "
      type="button"
      class="btn btn-primary"
    >
      Nuevo articulo
    </button>
    <br>
    <hr>
    <table class="table table-dark table-borderless">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">Description</th>
          <th scope="col">Stock</th>
          <th scope="col" colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="articulo in articulos" :key="articulo.id">
          <th>{{ articulo.id }}</th>
          <td>{{ articulo.name }}</td>
          <td>{{ articulo.description }}</td>
          <td>{{ articulo.stock }}</td>
          <td>
            <button
              @click="
                modificar = true;
                mostrarModal();
              "
              class="btn btn-outline-info btn-sm"
            >
              Edit
            </button>
          </td>
          <td>
            <button
              @click="eliminar(articulo.id)"
              class="btn btn-outline-danger btn-sm"
            >
              Destroy
            </button>
          </td>
        </tr>
      </tbody>
    </table>
    <!-- Modal  -->

    <!-- Modal -->
    <div
      class="modal"
      :class="{ mostrar: statusModal }"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">
              {{ tituloModal }}
            </h5>
            <button
              @click="cerrarModal()"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label for="name">Name Article </label>
                <input v-model="articulo.name" type="text" id="name" class="form-control" placeholder="Enter a name">
                <small id="emailHelp" class="form-text text-muted">This is a message for a change.</small>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input v-model="articulo.description" type="text" id="description" class="form-control" placeholder="Enter a description">
            </div>
            <div class="form-group">
                <label for="stock">Stock</label>
                <input v-model="articulo.stock" type="number" id="stock" class="form-control" placeholder="Enter an amount">
            </div>
          </div>
          <div class="modal-footer">
            <button
              @click="cerrarModal()"
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
        articulo:{
            name:'neider orlando',
            description:'Desarrollo en Vue js',
            stock:'10000',
        },  
      modificar: true,
      tituloModal: "",
      statusModal: 0,
      articulos: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get("articulos");
      this.articulos = res.data;
    },
    async eliminar(id) {
      const res = await axios.delete("articulos/" + id);
      this.listar();
    },
    mostrarModal() {
      this.statusModal = 1;
      if (this.modificar) {
        this.modificarArticulo();
      } else {
        this.crearArticulo();
      }
    },
    cerrarModal() {
      this.statusModal = 0;
    },
    modificarArticulo() {
      this.tituloModal = "Editar Articulo";
    },
    crearArticulo() {
      this.tituloModal = "Crear Articulo";
    },
  },
  created() {
    this.listar();
  },
};
</script>
<style scoped>
.mostrar {
  display: list-item;
  opacity: 0.9;
  background: rgb(212, 243, 255);
}
</style>
