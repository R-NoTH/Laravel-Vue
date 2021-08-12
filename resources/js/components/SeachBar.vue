<template>
  <div>
    <h3>{{ title_page }}</h3>

    <input
      class="form-control mr-sm-2"
      type="search"
      placeholder="Search"
      aria-label="Search"
    />
    <br>
    <div class="container">
      <div class="row">
        <!-- aqui va el foreach -->
        <div v-for="book in books" :key="book.id" class="col">
          <div class="card" style="width: 18rem">
            <img
              class="card-img-top"
              width="300px"
              height="300px"
              src="https://olcovers2.blob.core.windows.net/coverswp/2017/02/javascript-inspirate-OpenLibra-300x425.gif"
              alt="Card image cap"
            />
            <div class="card-body">
              <h5 class="card-title"> Author: {{ book.author }}</h5>
              <h5 class="card-text">
                  Title {{ book.title }}
              </h5>
               <h5 class="card-text">
                  Description {{ book.description }}
              </h5>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
        <!-- qui cierra el foreach -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title_page: "Barra de busqueda",
      books:[], //contiene todos los libros
    };
  },
  methods: {
   async listar() {
      const res = await axios.get("/books/listar");
      this.books = res.data;
    },
  },
  created() {
      this.listar();
  },
};
</script>
<style>
</style>
