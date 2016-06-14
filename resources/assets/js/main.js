import Vue from 'Vue';
import Alerts from './components/Alerts.vue';
import Todo from './components/Todo.vue';

Vue.use(require('vue-resource'));
Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

// Global storage for the entire application
var alert_store = [];
var task_store = [];

new Vue ({
    el: 'body',

    // Global storable between components
    data: {
        alerts: alert_store,
        tasks: task_store
    },

    // HTML elements to replace on the page, case insensitive <alerts>
    components: {
        Alerts, Todo
    },

    // Action to perform globally, outsite of the components
    methods: {
    },

    // Events being dispached up
    events: {
        'new-task': function(message) {
            // Show an alert to the user
            this.alerts = [];
            this.alerts.push({
                body: 'New todo item added: "' + message + '"',
                type: 'info'
            });
        },
        'cleared-completed': function(count) {
            // Show an alert to the user
            this.alerts = [];
            this.alerts.push({
                body: count + ' items cleared',
                type: 'info'
            });
        },
        'error-alert': function(text) {
            this.alerts = [];
            this.alerts.push({
                body: text,
                type: 'danger'
            });
        }
    }
});
