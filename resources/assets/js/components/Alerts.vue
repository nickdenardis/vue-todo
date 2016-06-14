<template>
    <div class="alert alert-{{ message.type }} alert-dismissible" role="alert" v-for="message in list">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="dismissMessage(message)">
            <span aria-hidden="true">&times;</span>
        </button>
        {{ message.body }}
    </div>
</template>

<script>
export default {
    // Variables to pull in from HTML or binded to the main Vue instance
    props: ['list'],

    // Each item in the template above has the ability to call this function
    methods: {
        dismissMessage: function(message){
            this.list.$remove(message);
        },
    }
};
</script>

<style>
</style>
