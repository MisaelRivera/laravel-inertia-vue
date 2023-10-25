<template>
    <div>
      <!-- Your data rendering logic here -->
  
      <div class="pagination">
        <!-- First page -->
        <button @click="changePage(1)" class="mr-2">
            <i class="fas fa-chevron-left"></i>
            <i class="fas fa-chevron-left"></i>
        </button>
  
        <!-- Previous page -->
        <button
            class="mr-2" 
            @click="changePage(items.current_page - 1)" 
            :disabled="items.current_page === 1">
            <i class="fas fa-chevron-left"></i>
        </button>
  
        <!-- Page buttons for the first five pages -->
        <template v-for="page in pages">
          <button @click="changePage(page)" class="px-4 py-2 text-sm bg-slate-200 rounded mx-1" :class="{ 'bg-indigo-500': page === items.current_page }">{{ page }}</button>
        </template>
       ...
        <!-- Last two pages -->
        <template v-for="page in lastTwoPages">
          <button 
            @click="changePage(page)" 
            class="px-4 py-2 text-sm bg-slate-200 rounded mx-1" 
            :class="{ 'bg-indigo-500': page === items.current_page }"
            v-if="this.currentPage < items.last_page - 5">
            {{ page }}
        </button>
        </template>

        <!-- Next page -->
        <button 
            class="mx-1" @click="changePage(items.current_page + 1)" :disabled="items.current_page === items.last_page">
            <i class="fas fa-chevron-right"></i>
        </button>
  
      </div>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      items: Object, // Pagination data passed from Laravel
      page: String
    },

    data () {
        return {
            currentPage: this.page ? parseInt(this.page):1
        }
    },
    
    computed: {
      // Array of page numbers for the first five pages
      pages() {
        const firstFivePages = [];
        const start = this.currentPage > 5 ? this.currentPage - 5:1;
        const end  = this.currentPage > 5  ? this.currentPage + 5:5;
        for (let i = start; i <= end; i++) {
          if (i <= this.items.last_page) {
            firstFivePages.push(i);
          }
        }
        return firstFivePages;
      },
      // Array of page numbers for the last two pages
      lastTwoPages() {
        const lastPage = this.items.last_page;
        return lastPage >= 2 ? [ lastPage] : [];
      },
    },
    methods: {
      changePage(page) {
        this.currentPage = page;
        this.$inertia.visit(this.items.path + `?page=${page}`);
      },
    },
  };
  </script>
