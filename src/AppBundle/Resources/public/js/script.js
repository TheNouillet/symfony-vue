Vue.component("product-list", {
    template: "#product-list",
    delimiters: ['${', '}'],
    props: ["products"],
    data: function() {
        return {
            productList: JSON.parse(this.products)
        };
    }
});

Vue.component("product-item", {
    template: "#product-item",
    delimiters: ['${', '}'],
    props: ['product'],
    data: function() {
        return {
            commentCount: null,
            loading: true
        };
    },
    methods: {
        setCommentCount: function() {
            this.$http.get('/comments/' + this.product.id).then((response) => {
                response.json().then((data) => {
                    this.commentCount = data.commentCount;
                    this.loading = false;
                })
            }, (response) => {
                this.commentCount = 0;
                this.loading = false;
            });
        }
    },
    created: function() {
        this.setCommentCount();
    }
});

var app = new Vue({
    el: "#app",
    delimiters: ['${', '}']
});