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
                        <div class="col-xs-12 form-group">
                            <label class="label-controll">Title</label>
                            <input type="text" class="form-group" v-model="article.title">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="label-controll">Content</label>
                            <input type="text" class="form-group" v-model="article.content">
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
            articleId: null,
            article:{
                title: '',
                content:''
            }
        }
    },
    mounted(){
        let app = this;
        let id = app.$route.params.id;
        app.articleId = id;
        axios.get('/api/v1/articles/'+ id)
        .then(res =>{
            app.article = res.data;
        }).catch(error => {
            alert('Could not found article');
        });
    },
    methods:{
        saveForm(){
            event.preventDefault();
            var app = this;
            var newArticle = app.article;
            axios.patch('/api/v1/articles/' + app.articleId, newArticle)
                .then(res => {
                    app.$router.push({path: '/'});
                }).catch(error =>{
                    console.log(error);
                });
        }
    }
}
</script>
