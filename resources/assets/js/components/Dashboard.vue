<template>
    <div class="dashboard">
        <div class="row justify-content-center">
            <draggable element="div" class="col-md-12" v-model="categories" :option="dragOptions" @end="dragCategory">
                <transition-group class="row">
                <div class="col-md-3" v-for="(element, index) in categories" v-bind:key="element.id" v-bind:index="index" v-bind:item="element" v-bind:id="element.id">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{element.name}}</h4>
                        </div>
                        <div class="card-body card-body-dark">
                            <draggable :option="dragOptions" element="div" @end="changeOrder" v-model="element.tasks">
                                <transition-group :id="element.id">
                                    <div v-for="(task, index) in element.tasks" v-bind:index="index" v-bind:id="task.id" v-bind:key="task.category_id+','+task.order" class="transit-1">
                                        <div class="small-card" @dblclick="editTask(task)">
                                            <textarea v-if="task == editingTask" class="text-input" @keyup.enter="endEditing(task)" v-model="task.name"></textarea>
                                            <label for="checkbox" v-if="task != editingTask" >{{task.name}}</label>
                                        </div>
                                    </div>
                                </transition-group>
                            </draggable>
                            <div class="small-card">
                                <h5 class="text-center" @click="addNew(index)">Add Task</h5>
                            </div>
                        </div>
                    </div>
                </div>
                </transition-group>
            </draggable>
        </div>
    </div>
</template>
<style scoped>
    .dashboard{
        width: 100%;
        padding: 15px;
    }
    .card{
        border: 0;
        border-radius: 0.5rem;
    }
    .transit-1{
        transition: all 1s;
    }
    .small-card{
        background: #f5f8fa;
        border-radius: 0.25rem;
        padding: 1rem;
        margin-bottom: 5px;
    }
    .card-body-dark{
        background-color: #cccccc;
    }
    textarea{
        overflow: visible;
        outline: 1px dashed black;
        padding: 6px 0 2px 8px;
        border: 0;
        width: 100%;
        height: 100%;
        resize: none;
    }
</style>

<script>
import draggable from 'vuedraggable';
import axios from 'axios';

export default {
    components: {
        draggable
    },
    data: function(){
        return {
            categories: [],
            editingTask: null
        }
    },
    methods: {
        addNew(id){
            let user_id = 1;
            let name = 'New task';
            let category_id = this.categories[id].id;
            let order = this.categories[id].tasks.length;

            axios.post('api/v1/tasks', {user_id, name, category_id, order})
                .then(response =>{
                    this.categories[id].tasks.push(response.data);
                })
                .catch(error =>{
                    console.log(error);
                })
        },
        loadTasks(){
            let app = this;
            this.categories.map((category, index) =>{
                axios.get(`api/v1/categories/${category.id}/tasks`)
                    .then(response => { 
                        category.tasks = response.data.tasks;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            })
        },
        changeOrder(data){
            let toTask = data.to
            let fromTask = data.from
            let task_id = data.item.id
            let category_id = toTask.id
            let order = data.newIndex == data.oldIndex ? false : data.newIndex
            if (order !== false) {
                axios.post(`api/v1/tasks/sortable/${task_id}`, { order, category_id })
                    .then(response => {
                        console.log('done');
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        endEditing(task){
            this.editingTask = null;
            axios.patch(`api/v1/tasks/${task.id}`, {name: task.name})
                .then(response => {
                    console.log('success');
                })
                .catch(error => {
                    console.log(error);
                })
        },
        editTask(task){
            this.editingTask = task;
        },
        dragCategory(data){
            console.log(data);
        }
    },
    mounted(){
        let token = localStorage.getItem('jwt');
        let app = this;
        axios.defaults.headers.common['Content-Type'] = 'application/json';
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        axios.get('api/v1/categories')
            .then(response =>{
                response.data.map(data => {
                    app.categories.push({
                        id: data.id,
                        name: data.name,
                        tasks: []
                    })
                })
                app.loadTasks() 
            })
            .catch(error => { console.log(error) })
    },
    computed:{
        dragOptions() {
            return {
                animotion: 1,
                group: 'descriptiotn',
                ghostClass: 'ghost'
            }
        }
    },
    beforeRouteEnter (to, from, next){
        if(!localStorage.getItem('jwt')){
            return next('login');
        }
        next();
    }
}
</script>
