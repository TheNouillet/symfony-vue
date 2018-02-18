var ProductList = Vue.component("product-list", {
    template: "#product-list",
    delimiters: ['${', '}'],
    props: ["products", "minPrice", "maxPrice"],
    data: function() {
        return {
            productList: JSON.parse(this.products),
            busy: false,
            page: 1,
            hasMore: true,
            eventHub: basketEventHub
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

                    axios.get("/products.json", {params: params}).then(function(response) {
                        if(response.data.products.length == 0) {
                            that.hasMore = false;
                        } else {
                            that.productList = that.productList.concat(response.data.products);
                        }
                        that.busy = false;
                    });
                }, 1000);
            }
        },
        addToBasket: function(product) {
            this.eventHub.$emit("addToBasket", product);
        },
        removeFromBasket: function(product) {
            this.eventHub.$emit("removeFromBasket", product);
        }
    }
});