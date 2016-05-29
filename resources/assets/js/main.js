import Vue from 'Vue';
import Alerts from './components/Alerts.vue';

// Global storage for the entire application
var alert_store = [{
    body: 'Here is a message',
    type: 'info'
}];

new Vue ({
    el: 'body',

    // Global storable between components
    data: {
        alerts: alert_store
    },

    // HTML elements to replace on the page, case insensitive <alerts>
    components: {
        Alerts
    },

    // Action to perform globally, outsite of the components
    methods: {
        addAlert: function(message) {
            this.alerts.push(message);
        }
    }
});
