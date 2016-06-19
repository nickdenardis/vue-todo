<template>
    <input type="text" v-model="search" class="form-control" />

    <table class="table table-striped">

      <thead>
        <tr>
          <th v-for="column in columns">
            <a href="#"
               @click="sortBy(column)"
               :class="{active: sortKey == column}"
               >
              {{ column | capitalize }}
            </a>
          </th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="person in list
                    | filterBy search
                    | orderBy sortKey reverse">
          <td>{{ person.name }}</td>
          <td>{{ person.age }}</td>
        </tr>
      </tbody>
    </table>
</template>
<script>
export default {
    // Properties to allow in the custom element
    props: ['list'],

    data: function() {
        return {
            sortKey: '',
            search: '',
            reverse: 1,
            columns: ['name', 'age']
        };
    },

    created: function() {
        console.log('created');
    },

    methods: {
        sortBy: function(sortKey) {
          this.reverse = (this.sortKey == sortKey) ? ((this.reverse >= 0)?-1:1) : 1;
          this.sortKey = sortKey;
        }
    }
};
</script>
<style>
</style>
