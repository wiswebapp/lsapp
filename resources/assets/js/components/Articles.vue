<template>
    <div>
        <h2>Articles</h2>
    </div>
</template>

<script>
export default {
    data(){
        return {
            articles : [],
            article:{
                id:'',
                title:'',
                vBody:''
            },
            article_id:'',
            pagination: {},
            edit : false
        }
    },

    create(){
        this.fetchArticles();
    },

    methods:{
        fetchArticles(){
            fetch('api/articles')
                .then(res => res.json())
                .then(res => {
                    console.log("Data is 1011"+res.data);
                })
        }
    }
}
</script>