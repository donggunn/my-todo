<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Create Article</div>
            <div class="panel-body">
                <form v-on:submit="saveForm()">
                    <div class="row">
                        <div class="col-xs-12 form-group alert alert-danger" v-if="errors.length > 0">
                            <p v-for="(error, index) in errors" v-bind:key="index">*{{error}}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="label-control">Title</label>
                            <input type="text" class="form-control" v-model="article.title">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="label-control">Content</label>
                            <input type="text" class="form-control" v-model="article.content">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="label-control">
                                Cover
                            </label>
                            <input type="file" v-on:change="onImageChange" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data: function(){
        return {
            article:{
                title: '',
                content:'',
                thumb:''
            },
            errors: []
        }
    },
    methods:{
        onImageChange(e){
            let file = e.target.files || e.dataTransfer.files;
            let app = this;
            if(!file.length)
                return;
            app.article.thumb = file[0];
        },
        saveForm(){
            event.preventDefault();
            let app = this;
            let newArticle = new FormData();
            newArticle.set('title', app.article.title);
            newArticle.set('content', app.article.content);
            newArticle.set('thumb', app.article.thumb);
            axios.post('/api/v1/articles', newArticle).then(res => {
                    app.$router.push({path: '/'});
                }).catch(error =>{
                    app.errors = [];
                    if(error.response.data.title){
                      app.errors.push(error.response.data.title[0]);  
                    }
                    if(error.response.data.content){
                        app.errors.push(error.response.data.content[0]);
                    }
                    if(error.response.data.thumb){
                        app.errors.push(error.response.data.thumb[0]);
                    }
                });
        }
    }
}
</script>
