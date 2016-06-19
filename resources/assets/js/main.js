import Vue from 'Vue';
import Alerts from './components/Alerts.vue';
import Todo from './components/Todo.vue';
import Paging from './components/Paging.vue';
import VueRouter from 'vue-router';

Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

// Global storage for the entire application
var alert_store = [];
var task_store = [];
var sites_store = [
      {name: 'John', age: 50},
      {name: 'Jack', age: 35},
      {name: 'Keith', age: 28},
      {name: 'Alain', age: 17},
      {name: 'Neil', age: 1},
      {name: 'Mark', age: 72},
      {name: 'Don', age: 47},
      {name: 'Walter', age: 41},
      {name: 'Jessy', age: 33},
      {name: 'Henck', age: 22},
      {name: 'Sal', age: 9},
      {name: 'Skyler', age: 42},
      {name: 'Holly', age: 55},
    ];

new Vue ({
    el: 'body',

    // Global storable between components
    data: {
        alerts: alert_store,
        tasks: task_store,
        sites: sites_store
    },

    // HTML elements to replace on the page, case insensitive <alerts>
    components: {
        Alerts, Todo, Paging
    },

    // Action to perform globally, outsite of the components
    methods: {
        showAlert: function (message, type, clear) {
            // Remove all existing alerts
            if (clear) {
                this.alerts = [];
            }

            // Add this message to the list
            this.alerts.push({
                body: message,
                type: type
            });
        }
    },

    // Events being dispached up
    events: {
        'new-task': function(message) {
            this.showAlert('New todo item added: "' + message + '"', 'info');
        },
        'cleared-completed': function(count) {
            this.showAlert(count + ' items cleared', 'info', true);
        },
        'error-alert': function(text) {
            this.showAlert(text, 'danger', true);
        }
    }
});
