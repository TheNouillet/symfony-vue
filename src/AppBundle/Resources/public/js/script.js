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
            var that = this;
            if(this.hasMore) {
                that.busy = true;
                that.page++;
    
                // setTimeout pour simuler un long chargement
                setTimeout(function() {
                    var params = {
                        "page": that.page,
                        "product_search[minPrice]": that.minPrice,
                        "product_search[maxPrice]": that.maxPrice
                    };
                    var url = RequestHelper.buildHttpRequest("/products.json", params);

                    that.$http.get(url).then(function(response) {
                        response.json().then(function(data) {
                            if(data.products.length == 0) {
                                that.hasMore = false;
                            } else {
                                that.productList = that.productList.concat(data.products);
                            }
                            that.busy = false;
                        }, function(response) {
                            that.hasMore = false;
                            that.busy = false;
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
            var that = this;
            that.loading = true;
            that.$http.get('/comments/' + that.product.id).then(function(response) {
                response.json().then(function(data) {
                    that.commentCount = data.commentCount;
                    that.loading = false;
                });
            }, function(response) {
                that.commentCount = 0;
                that.loading = false;
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