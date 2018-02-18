const basketEventHub = new Vue()

var Basket = Vue.component("basket", {
    template: "#basket",
    delimiters: ['${', '}'],
    data: function() {
        return {
            productList: [],
            eventHub: basketEventHub
        };
    },
    methods: {
        addProduct: function(product) {
            this.productList.push(product);
        },
        isProductInBasket(product) {
            return this.productList.findIndex(function(p) {
                return p.id == product.id;
            }) != -1;
        },
        removeProduct: function(product) {
            var productToRemoveIndex = this.productList.findIndex(function(p) {
                return p.id == product.id;
            });
            if(productToRemoveIndex != -1) {
                this.productList.splice(productToRemoveIndex, 1);
            }
        }
    },
    created: function() {
        var that = this;
        this.eventHub.$on("addToBasket", function(product){
            that.addProduct(product);
        });
        this.eventHub.$on("removeFromBasket", function(product){
            that.removeProduct(product);
        });
    }
});