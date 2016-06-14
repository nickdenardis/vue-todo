<template>
    <h2>
        My Tasks
        <span v-show="remaining">({{ remaining }})</span>
    </h2>
    <ul v-show="list.length" class="list-group">
        <li v-for="task in list"
            class="list-group-item"
            :class="{editing: task == editing}"
        >
            <strong @click="deleteTask(task)"><i class="fa fa-trash-o" aria-hidden="true"></i></strong>
            <strong @click="toggleCompleted(task)">
                <i class="fa fa-square-o" aria-hidden="true" v-show="!task.completed"></i>
                <i class="fa fa-check-square-o" aria-hidden="true" v-show="task.completed"></i>
            </strong>
            <span @dblClick="editTask(task)"
                :class="{ 'completed': task.completed }"
            >
                {{ task.body }}
            </span>
            <input class="edit" type="text"
				v-model="task.body"
                v-todo-focus="task == editing"
				@keyup.enter="doneEdit(task)"
				@keyup.esc="cancelEdit(task)">
        </li>
    </ul>
    <p>
        <input type="input" v-model="task" @keyup.enter="addTask" placeholder="Add a task" />
        <button v-show="task" @click="addTask">Add</button>
    </p>
    <button @click="clearCompleted">
        Clear completed
    </button>
</template>

<script>
export default {
    // Properties to allow in the custom element
    props: ['list'],

    // Ability to store this information from the form
    data: function() {
        return {
            task: '',
            editing: null
        };
    },

    // When this tag is ready on the page
    created: function(){
        // Resource for all actions https://github.com/vuejs/vue-resource/blob/master/docs/resource.md
        this.resource = this.$resource('api/tasks{/id}');

        // Get a list of all tasks and display
        this.resource.get({}).then(function (tasks) {
            this.list = tasks.data;
        }.bind(this), function (tasks) {
            // Tell the parent object there was a problem.
            this.$dispatch('error-alert', 'Error: could not pull tasks');
        });
    },

    // Available to all instances
    methods: {
        toggleCompleted: function(task) {
            // Eager change the status
            task.completed = ! task.completed;

            // Update the information in the database
            this.resource.update({id: task.id}, {completed: task.completed}).then(function (response) {
                // success callback
            }, function (response) {
                // Revert the status is it can't be samed in the DB
                task.completed = ! task.completed;
                this.$dispatch('error-alert', 'Error: could not toggle completed');
            });

        },
        deleteTask: function(task){
            // Delete the information in the database
            this.resource.delete({id: task.id}).then(function (response) {
                this.list.$remove(task);
                // Remove the task from the page
            }, function (response) {
                // Tell the parent object there was a problem.
                this.$dispatch('error-alert', 'Error deleting task.');
            });
        },
        addTask: function() {
            // Save the information in the database
            this.resource.save({}, {body: this.task}).then(function (response) {
                // Success callback
                this.list.push(response.data);
            }, function (response) {
                // Tell the parent object there was a problem.
                this.$dispatch('error-alert', 'Error adding task.');
            });

            // Tell anyone else who cares that a new task was added
            this.$dispatch('new-task', this.task);

            this.task = '';
        },
        editTask: function(task) {
            // Keep track of the original task information
            //this._beforeEditingCache = task.body;
            this._beforeEditingCache = Object.assign({}, task);

            // Put the task into edit mode (also changes the interface)
            this.editing = task;
        },
        doneEdit: function(task) {
            // Ensure we came from editor mode
            if (!this.editing) {
				return;
			}

            // Exit editing mode
            this.editing = null;

            // Trim whitespace
            task.body = task.body.trim();

            // If removed the whole title
			if (!task.body) {
                // Remove the item completely
				this.deleteTask(task);
                return;
			}

            // Save the information in the database
            this.resource.update({id: task.id}, {body: task.body}).then(function (response) {
                // Success callback
            }, function (response) {
                // Return the title back to it's previous state
                //task.body = this._beforeEditingCache;
                Object.assign(task, this._beforeEditingCache);

                // Tell the parent object there was a problem.
                this.$dispatch('error-alert', 'Error editing task.');
            });
        },
        cancelEdit: function(task) {
            // Return the title back to it's previous state
            //task.body = this._beforeEditingCache;
            Object.assign(task, this._beforeEditingCache);

            // Exit editing mode
            this.editing = this._beforeEditingCache = null;
        },
        isComplete: function(task) {
            return task.completed;
        },
        inProgress: function(task) {
            return ! task.completed;
        },
        clearCompleted: function() {
            let total = this.list.length;

            // Only keep the tasks that are in progress
            this.list = this.list.filter(this.inProgress);

            // Tell other areas of the app that the list was cleared
            this.$dispatch('cleared-completed', (total - this.list.length));
        }
    },

    // Based on the state of the list
    computed: {
        // Return the number of open tasks
        remaining: function() {
            return this.list.filter(this.inProgress).length;
        }
    },

    // This that do things when attached to DOM elements
    directives: {
		'todo-focus': function (value) {
            if (!value) {
				return;
			}
			var el = this.el;
			this.vm.$nextTick(function () {
				el.focus();
			});
		}
	}
};
</script>

<style>
.completed {
    text-decoration: line-through;
}
.list-group .editing span, .list-group input {
    display: none;
}
.list-group .editing input, .list-group span {
    display: inline;
}
</style>
