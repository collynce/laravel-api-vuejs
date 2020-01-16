<template>
    <div class="container">
        <form @submit.prevent="addPost" class="mb-3">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Name" v-model="form.name">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Title" name="title" v-model="form.title"/>
            </div>
            <div class="form-group">
                <select class="form-control" id="exampleFormControlSelect1" name="category" v-model="form.category">
                    <option value="">Select</option>
                    <option v-for="post in posts" :value="post.category.category.id" :key="post.category.id">{{post.category.category}}</option>
                </select>
            </div>
            <div class="form-group">
                <textarea class="form-control" placeholder="Description" name="description" v-model="form.description"/>
            </div>
            <button type="submit" class="btn btn-light btn-block">Save</button>
        </form>
        <button @click="clearForm()" class="btn btn-danger btn-block mb-3">Cancel</button>
        <ul class="pagination">
            <li v-bind:class="[{disabled: !pagination.prev_url}]" class="page-item">
                <a class="page-link" href="#" @click="fetchPosts(pagination.prev_url)">Previous</a>
            </li>

            <li class="page-item disabled">
                <a
                    class="page-link text-dark"
                    href="#"
                >Page {{ pagination.current_page }} of {{ pagination.last_page }}</a>
            </li>

            <li v-bind:class="[{disabled: !pagination.next_url}]" class="page-item">
                <a class="page-link" href="#" @click="fetchPosts(pagination.next_url)">Next</a>
            </li>
        </ul>
        <div v-for="post in posts" class="card mb-4" :key="post.id">
            <div class="card-header">
                {{post.title}}
            </div>
            <div class="card-body">
                {{post.name}} - {{post.category.category}}
                <span>Author: {{post.user.name}}</span>
                <button @click="editPost(post)" class="btn btn-warning btn-md mb-2">Edit</button>
                <button @click="deletePost(post.id)" class="btn btn-danger btn-md">Delete</button>
            </div>

        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        name: "posts",
        data() {
            return {
                posts: [],
                form: {
                    id: '',
                    name: '',
                    title: '',
                    category: '',
                    description: ''
                },
                post_id: "",
                pagination: {},
                edit: false
            }
        },
        created() {
            this.fetchPosts();
        },
        methods: {
            fetchPosts(post_url) {
                post_url = post_url || 'api/postss';
                axios.get(post_url).then(res => res.data).then(posts => {
                    this.posts = posts.data;
                    this.makePagination(posts.meta, posts.links);
                }).catch(error => {
                    console.log('An error occurred' + error)
                })
            },
            makePagination(meta, links) {
                this.pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_url: links.next,
                    prev_url: links.prev
                };
            },
            editPost(post) {
                this.edit = true;
                this.form.id = post.id;
                this.form.name = post.name;
                this.form.title = post.title;
                this.form.category = post.category.category;
                this.form.description = post.description;
            },
            clearForm() {
                this.edit = false;
                this.form.id = '';
                this.form.name = '';
                this.form.title = '';
                this.form.category = '';
                this.form.description = '';
            }
        }
    }

</script>

<style scoped>

</style>
