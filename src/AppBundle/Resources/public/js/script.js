Vue.component("product-list", {
    template: "#product-list",
    delimiters: ['${', '}'],
    props: ["products", "minPrice", "maxPrice"],
    data: function() {
        return {
            productList: JSON.parse(this.products),
            busy: false,
            page: 1,
            hasMore: true
        };
    },
    methods: {
        loadMore: function() {
            if(this.hasMore) {
                this.busy = true;
                this.page++;
    
                // setTimeout pour simuler un long chargement
                setTimeout(() => {
                    var params = {
                        "page": this.page,
                        "product_search[minPrice]": this.minPrice,
                        "product_search[maxPrice]": this.maxPrice
                    };
                    var url = RequestHelper.buildHttpRequest("/products.json", params);

                    this.$http.get(url).then((response) => {
                        response.json().then((data) => {
                            if(data.products.length == 0) {
                                this.hasMore = false;
                            } else {
                                this.productList = this.productList.concat(data.products);
                            }
                            this.busy = false;
                        }, (response) => {
                            this.hasMore = false;
                            this.busy = false;
                        });
                    });
                }, 1000);
            }
        }
    }
});

Vue.component("product-item", {
    template: "#product-item",
    delimiters: ['${', '}'],
    props: ['product'],
    data: function() {
        return {
            commentCount: null,
            loading: false
        };
    },
    methods: {
        setCommentCount: function() {
            this.loading = true;
            this.$http.get('/comments/' + this.product.id).then((response) => {
                response.json().then((data) => {
                    this.commentCount = data.commentCount;
                    this.loading = false;
                });
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