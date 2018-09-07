<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createArticle'}" class="btn btn-success">Create new Article</router-link>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                List Article
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(article, index) in articles" v-bind:item ="article" v-bind:index="index" v-bind:key="article.id">
                            <td>{{index}}</td>
                            <td><img :src="'/storage/' + article.thumb" :alt="article.title" width="100"></td>
                            <td>{{article.title}}</td>
                            <td>{{article.content}}</td>
                            <td>
                                <router-link :to="{ name:'editArticle', params: {id: article.id}}" class="btn btn-xs btn-default">Edit</router-link>
                                <a href="#" class="btn btn-xs btn-danger" v-on:click="deleteEntry(article.id, index)">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>
export default {
  data: function() {
    return {
      articles: []
    };
  },
  mounted() {
    var app = this;
    axios
      .get("/api/v1/articles")
      .then(res => {
        app.articles = res.data;
      })
      .catch(error => {
        console.log(error);
      });
  },
  methods: {
    deleteEntry(articleId, index) {
      if (confirm("Do you really delete it?")) {
        var app = this;
        axios
          .delete("/api/v1/articles/" + articleId)
          .then(res => {
            app.articles.splice(index, 1);
          })
          .catch(error => {
            alert("Could not delete article");
          });
      }
    }
  }
};
</script>

