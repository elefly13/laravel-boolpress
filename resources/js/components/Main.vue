<template>
    <header>
        <h1>Sono Main</h1>
        <div class="row">
            <div class="col-12">
                <ul>
                    <li v-for="post in posts" :key="post.id">
                        {{ post.title }}
                    </li>
                </ul>
            </div>
        </div>
    </header>
</template>

<script>

export default {
    name: 'Main',

    data() {
        return {
            url: 'http://http://127.0.0.1:8001/api/posts',
            posts:[],
            api_token: 'to3s0JivFr2F3mWNuywCyreT2QuMygWSv1e0t7DpTBEKIn1mAdtxrO1faTTaT7fE5912ohiIBvY0cYu6'
        }
    },
    created() {
        this.getPosts();
    },
    methods: {
        getPosts() {
            // console.log('Chiamata api');
            const bodyParameters = {
                key: 'value'
            }

            const config = {
                headers: { Authorization: `Bearer ${this.api_token}`}
            };

            axios.post(this.url, bodyParameters, config)
                .then(response => {
                    // console.log(response.data.result);
                    this.posts = response.data.result;
                })
                .catch();

        }
    }
}
</script>
